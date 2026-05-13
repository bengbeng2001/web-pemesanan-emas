@extends('layouts.app')

@section('title', 'Riwayat Pembelian')

@section('content')
    <h1>Riwayat Pembelian</h1>
    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Total Harga Pembelian</th>
                <th>Status Pembayaran</th>
                <th>Status Pemesanan</th>
                <th>Detail Pemesanan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->payment?->status ?? '—' }}</td>
                    <td><a class="btn btn-sm" href="{{ route('customer.orders.show', $order) }}">Klik Disini</a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Belum ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $orders->links() }}</div>
@endsection
