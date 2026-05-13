@extends('layouts.app')

@section('title', 'Tinjau Pembayaran')

@section('content')
    <h1>Pembayaran #{{ $payment->id }}</h1>
    <p class="muted">Pesanan #{{ $payment->order_id }} — {{ $payment->order->user->name }}</p>
    <p>Total: <strong>Rp {{ number_format($payment->order->total_price, 0, ',', '.') }}</strong></p>
    <p>Status: <strong>{{ $payment->status }}</strong></p>

    <h2>Item pesanan</h2>
    <table>
        <thead>
            <tr><th>Emas</th><th>Qty</th><th>Harga</th></tr>
        </thead>
        <tbody>
            @foreach($payment->order->orderItems as $item)
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
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($payment->payment_proof)
        <h2>Bukti transfer</h2>
        <p><img class="proof" src="{{ asset('storage/'.$payment->payment_proof) }}" alt="Bukti"></p>
    @endif

    @if($payment->status === 'Tertunda')
        <div class="row" style="margin-top:1rem;">
            <form method="post" action="{{ route('admin.payments.verify', $payment) }}">
                @csrf
                <input type="hidden" name="action" value="approve">
                <button type="submit" class="btn btn-primary" onclick="return confirm('Setujui dan kurangi stok?');">Setujui</button>
            </form>
            <form method="post" action="{{ route('admin.payments.verify', $payment) }}">
                @csrf
                <input type="hidden" name="action" value="reject">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak bukti ini?');">Tolak</button>
            </form>
        </div>
    @endif

    <p style="margin-top:1.5rem;"><a class="btn" href="{{ route('admin.payments.index') }}">Kembali</a></p>
@endsection
