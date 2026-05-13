@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <h1>Dashboard</h1>
    <div class="row">
        <div class="card" style="min-width:200px;">
            <div class="muted">Total Penjualan Yang Selesai (lunas)</div>
            <div style="font-size:1.5rem;font-weight:bold;">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
        </div>
        <div class="card" style="min-width:200px;">
            <div class="muted">Total pesanan</div>
            <div style="font-size:1.5rem;font-weight:bold;">{{ $totalOrders }}</div>
        </div>
    </div>
    <div class="row">
        <div class="card" style="min-width:200px;">
            <div class="muted">Penjualan Dibatalkan</div>
            <div style="font-size:1.5rem;font-weight:bold;color:red;">{{ $totalCancelledOrders }}</div>
        </div>
        <div class="card" style="min-width:200px;">
            <div class="muted">Penjualan Diselesaikan</div>
            <div style="font-size:1.5rem;font-weight:bold;color:green;">{{ $totalPaidOrders }}</div>
        </div>
        <div class="card" style="min-width:200px;">
            <div class="muted">Penjualan Tertunda</div>
            <div style="font-size:1.5rem;font-weight:bold;color:brown;">{{ $totalPendingOrders }}</div>
        </div>
    </div>
    <div class="row">
        <div class="card" style="min-width:200px;">
            <div class="muted">Penjualan Hari Ini</div>
            <div style="font-size:1.5rem;font-weight:bold;">Rp {{ number_format($todaySales, 0, ',', '.') }}</div>
        </div>

        <div class="card" style="min-width:200px;">
            <div class="muted">Penjualan Bulan Ini</div>
            <div style="font-size:1.5rem;font-weight:bold;">Rp {{ number_format($monthlySales, 0, ',', '.') }}</div>
        </div>
        <div class="card" style="min-width:200px;">
            <div class="muted">Conversion Rate - Pesanan yang berhasil jadi bayar</div>
            <div style="font-size:1.5rem;font-weight:bold;color:green;">{{ number_format($conversionRate, 2) }}%</div>
        </div>
    </div>
@endsection