<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class TransactionController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'orderItems.gold', 'payment'])
            ->where('status', 'Dibayar')
            ->latest()
            ->paginate(25);

        return view('admin.transactions.index', compact('orders'));
    }
}
