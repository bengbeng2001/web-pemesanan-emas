<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Gold;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['payment', 'orderItems.gold'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('customer.orders.index', compact('orders'));
    }

    public function create()
    {
        $golds = Gold::where('stock', '>', 0)->orderBy('name')->get();

        return view('customer.orders.create', compact('golds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantities' => ['required', 'array'],
            'quantities.*' => ['nullable', 'integer', 'min:0'],
        ]);

        $lines = [];
        foreach ($request->input('quantities', []) as $goldId => $qty) {
            $qty = (int) $qty;
            if ($qty > 0) {
                $lines[(int) $goldId] = $qty;
            }
        }

        if ($lines === []) {
            return back()->withErrors(['quantities' => 'Pilih minimal satu item dengan jumlah lebih dari 0.'])->withInput();
        }

        $goldIds = array_keys($lines);
        $golds = Gold::whereIn('id', $goldIds)->get()->keyBy('id');

        foreach ($lines as $goldId => $qty) {
            $gold = $golds->get($goldId);
            if (! $gold) {
                return back()->withErrors(['quantities' => 'Produk tidak valid.'])->withInput();
            }
            if ($gold->stock < $qty) {
                return back()->withErrors([
                    'quantities' => 'Stok '.$gold->name.' tidak mencukupi (tersisa '.$gold->stock.').',
                ])->withInput();
            }
        }

        $order = DB::transaction(function () use ($lines, $golds) {
            $total = 0;
            foreach ($lines as $goldId => $qty) {
                $gold = $golds->get($goldId);
                $total += (float) $gold->price * $qty;
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $total,
                'status' => 'Tertunda',
            ]);

            foreach ($lines as $goldId => $qty) {
                $gold = $golds->get($goldId);
                OrderItem::create([
                    'order_id' => $order->id,
                    'gold_id' => $gold->id,
                    'quantity' => $qty,
                    'price' => $gold->price,
                ]);
            }

            return $order;
        });

        return redirect()
            ->route('customer.orders.show', $order)
            ->with('success', 'Pesanan dibuat. Silakan unggah bukti pembayaran.');
    }

    public function show(Order $order)
    {
        $this->authorizeOrder($order);
        $order->load(['orderItems.gold', 'payment']);

        return view('customer.orders.show', compact('order'));
    }

    private function authorizeOrder(Order $order): void
    {
        abort_unless($order->user_id === auth()->id(), 403);
    }
}
