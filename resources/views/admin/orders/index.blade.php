@extends('layouts.app')

@section('title', 'Semua Pesanan')

@section('content')
    <h1>Semua Pesanan</h1>
    <form method="get" class="card" style="display:flex;gap:0.5rem;align-items:center;flex-wrap:wrap;">
        <label for="status" class="muted" style="margin:0;">Status</label>
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="">Semua</option>
            <option value="Tertunda" @selected(request('status')==='Tertunda')>Tertunda</option>
            <option value="Dibayar" @selected(request('status')==='Dibayar')>Lunas</option>
            <option value="Dibatalkan" @selected(request('status')==='Dibatalkan')>Dibatalkan</option>
        </select>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Bukti</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        @if($order->payment?->payment_proof)
                            {{ $order->payment->status }}
                        @else
                            <span class="muted">—</span>
                        @endif
                    </td>
                    <td><a class="btn btn-sm" href="{{ route('admin.orders.show', $order) }}">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="6" class="muted">Tidak ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $orders->links() }}</div>
@endsection
