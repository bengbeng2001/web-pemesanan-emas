@extends('layouts.app')

@section('title', 'Unggah Bukti Bayar')

@section('content')
    <h1>Unggah bukti pembayaran</h1>
    <p class="muted">Pesanan #{{ $order->id }} — Total Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <p>Gambar JPG/PNG/WebP, maksimal 2 MB.</p>

    @if($payment && $payment->payment_proof && $payment->status === 'Tertunda')
        <p>Bukti saat ini:</p>
        <p><img class="proof" src="{{ asset('storage/'.$payment->payment_proof) }}" alt="Bukti"></p>
    @endif
    @if($payment && $payment->status === 'rejected')
        <p class="muted">Bukti sebelumnya ditolak. Unggah file baru.</p>
    @endif

    <form method="post" action="{{ route('customer.payments.store', $order) }}" enctype="multipart/form-data" class="card" style="max-width:480px;">
        @csrf
        <label for="payment_proof">File bukti</label>
        <input id="payment_proof" type="file" name="payment_proof" accept="image/*" required>

        <div style="margin-top:1rem;">
            <button type="submit" class="btn btn-primary">Kirim</button>
            <a href="{{ route('customer.orders.show', $order) }}" class="btn">Batal</a>
        </div>
    </form>
@endsection
