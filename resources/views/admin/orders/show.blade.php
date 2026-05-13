@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <h1>Pesanan #{{ $order->id }}</h1>
    <p class="muted">Pelanggan: {{ $order->user->name }} ({{ $order->user->email }})</p>
    <p>Status pesanan: <strong>{{ $order->status }}</strong></p>
    @if($order->payment)
        <p>Status pembayaran: <strong>{{ $order->payment->status }}</strong>
            @if($order->payment->payment_proof)
                — <a href="{{ route('admin.payments.show', $order->payment) }}">Lihat bukti</a>
            @endif
        </p>
    @endif

    <h2>Item</h2>
    <table>
        <thead>
            <tr><th>Emas</th><th>Qty</th><th>Harga satuan</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td>
                        <div class="td-gold">
                            @if($item->gold->image)
                                <img class="thumb-gold" src="{{ asset('storage/'.$item->gold->image) }}" alt="">
                            @endif
                            <span>{{ $item->gold->name }}</span>
                        </div>
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><strong>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
    <p><a class="btn" href="{{ route('admin.orders.index') }}">Kembali</a></p>
@endsection
