<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalCancelledOrders = Order::where('status', 'Dibatalkan')->count();
        $totalPaidOrders = Order::where('status', 'Dibayar')->count();
        $totalPendingOrders = Order::where('status', 'Tertunda')->count();
        $totalSales = (float) Order::where('status', 'Dibayar')->sum('total_price');

        $todaySales = Order::where('status', 'Dibayar')
            ->whereDate('created_at', today())
            ->sum('total_price');

        $monthlySales = Order::where('status', 'Dibayar')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        $conversionRate = $totalOrders > 0
            ? ($totalPaidOrders / $totalOrders) * 100
            : 0;

        return view('admin.dashboard', compact('totalOrders', 'totalSales', 'totalCancelledOrders', 'totalPaidOrders', 'totalPendingOrders', 'todaySales', 'monthlySales', 'conversionRate'));
    }
}
