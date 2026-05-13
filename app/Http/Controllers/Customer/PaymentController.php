<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        $this->authorizeOrder($order);

        if ($order->status !== 'Tertunda') {
            return redirect()->route('customer.orders.show', $order)
                ->withErrors(['payment' => 'Pesanan ini tidak memerlukan bukti pembayaran.']);
        }

        $payment = $order->payment;

        if ($payment && $payment->status === 'Terverifikasi') {
            return redirect()->route('customer.orders.show', $order)
                ->withErrors(['payment' => 'Pembayaran sudah diverifikasi.']);
        }

        return view('customer.payments.create', compact('order', 'payment'));
    }

    public function store(Request $request, Order $order)
    {
        $this->authorizeOrder($order);

        if ($order->status !== 'Tertunda') {
            return redirect()->route('customer.orders.show', $order)
                ->withErrors(['payment' => 'Pesanan tidak dapat diunggah.']);
        }

        $request->validate([
            'payment_proof' => ['required', 'image', 'max:2048'],
        ]);

        $existing = $order->payment;

        if ($existing && $existing->status === 'Terverifikasi') {
            return redirect()->route('customer.orders.show', $order)
                ->withErrors(['payment' => 'Pembayaran sudah diverifikasi.']);
        }

        if ($existing && $existing->status === 'Tertunda' && $existing->payment_proof) {
            Storage::disk('public')->delete($existing->payment_proof);
        }

        $path = $request->file('payment_proof')->store('payments', 'public');

        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'payment_proof' => $path,
                'status' => 'Tertunda',
            ]
        );

        return redirect()->route('customer.orders.show', $order)->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

    private function authorizeOrder(Order $order): void
    {
        abort_unless($order->user_id === auth()->id(), 403);
    }
}
