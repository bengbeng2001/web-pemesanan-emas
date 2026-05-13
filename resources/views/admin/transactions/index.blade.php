@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')
    <h1>Riwayat Transaksi (Lunas)</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td><a class="btn btn-sm" href="{{ route('admin.orders.show', $order) }}">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Belum ada transaksi lunas.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $orders->links() }}</div>
@endsection
