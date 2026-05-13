@extends('layouts.app')

@section('title', 'Verifikasi Pembayaran')

@section('content')
    <h1>Verifikasi Pembayaran</h1>
    <p class="muted">Menampilkan bukti yang menunggu verifikasi.</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pesanan</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
                <tr>
                    <td>#{{ $payment->id }}</td>
                    <td>#{{ $payment->order_id }}</td>
                    <td>{{ $payment->order->user->name }}</td>
                    <td>Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('admin.payments.show', $payment) }}">Tinjau</a></td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Tidak ada antrian verifikasi.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $payments->links() }}</div>
@endsection
