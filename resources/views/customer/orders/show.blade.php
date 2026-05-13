@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')
    <h1>Pesanan #{{ $order->id }}</h1>
    <p>Status: <strong>{{ $order->status }}</strong></p>
    @if($order->payment)
        <p>Pembayaran: <strong>{{ $order->payment->status }}</strong></p>
    @endif

    <h2>Item</h2>
    <table>
        <thead>
            <tr><th>Emas</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>
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

    @if($order->status === 'Tertunda')
        @php $p = $order->payment; @endphp
        @if(!$p || $p->status === 'rejected' || ($p->status === 'Tertunda' && !$p->payment_proof))
            <p><a class="btn btn-primary" href="{{ route('customer.payments.create', $order) }}">Unggah bukti pembayaran</a></p>
        @elseif($p->status === 'Tertunda' && $p->payment_proof)
            <p class="muted">Bukti sudah diunggah. Menunggu verifikasi admin.</p>
            <p><img class="proof" src="{{ asset('storage/'.$p->payment_proof) }}" alt="Bukti"></p>
        @endif
    @endif

    <p style="margin-top:1rem;"><a class="btn" href="{{ route('customer.orders.index') }}">Riwayat pesanan</a></p>
@endsection
