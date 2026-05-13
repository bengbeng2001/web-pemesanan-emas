<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['order.user'])
            ->where('status', 'Tertunda')
            ->whereNotNull('payment_proof')
            ->latest()
            ->paginate(20);

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load(['order.user', 'order.orderItems.gold']);

        return view('admin.payments.show', compact('payment'));
    }

    public function verify(Request $request, Payment $payment)
    {
        $request->validate([
            'action' => ['required', 'in:approve,reject'],
        ]);

        if ($payment->status !== 'Tertunda') {
            return back()->withErrors(['action' => 'Pembayaran sudah diproses.']);
        }

        $order = $payment->order;

        // if ($request->input('action') === 'reject') {
        //     $payment->update(['status' => 'Dibatalkan']);
        //     $order->status === 'Dibatalkan';

        //     return redirect()->route('admin.payments.index')->with('success', 'Bukti pembayaran ditolak.');
        // }

        if ($request->input('action') === 'reject') {
            $payment->update(['status' => 'Dibatalkan']);
            $order->update(['status' => 'Dibatalkan']);

            return redirect()->route('admin.payments.index')
                ->with('success', 'Bukti pembayaran ditolak.');
        }


        if ($order->status === 'Dibayar') {
            return back()->withErrors(['action' => 'Pesanan sudah lunas.']);
        }

        $order->load('orderItems.gold');

        foreach ($order->orderItems as $item) {
            if ($item->gold->stock < $item->quantity) {
                return back()->withErrors([
                    'action' => 'Stok tidak cukup untuk ' . $item->gold->name . ' (tersisa ' . $item->gold->stock . ').',
                ]);
            }
        }

        DB::transaction(function () use ($payment, $order) {
            $payment->update(['status' => 'Terverifikasi']);
            $order->update(['status' => 'Dibayar']);

            foreach ($order->orderItems as $item) {
                $item->gold->decrement('stock', $item->quantity);
            }
        });

        return redirect()->route('admin.payments.index')->with('success', 'Pembayaran diverifikasi dan stok dikurangi.');
    }
}
