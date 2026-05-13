@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <div class="hero">
        <h1>Pemesanan Emas Online</h1>
        <p>Investasi emas kini lebih mudah. Pesan, bayar, dan upload bukti transfer langsung dari rumah.</p>

        @auth
            @if(auth()->user()->isAdmin())
                <a class="btn primary" href="{{ route('admin.dashboard') }}">Masuk ke Admin Panel</a>
            @else
                <a class="btn primary" href="{{ route('customer.shop.index') }}">Lihat Stok Emas</a>
            @endif
        @else
            <a class="btn primary" href="{{ route('login') }}">Masuk</a>
            <a class="btn secondary" href="{{ route('register') }}">Daftar</a>
        @endauth
    </div>

    <div class="features">
        <div class="card">
            <h3>🔒 Aman</h3>
            <p>Transaksi diverifikasi langsung oleh admin untuk keamanan maksimal.</p>
        </div>

        <div class="card">
            <h3>⚡ Cepat</h3>
            <p>Proses pemesanan dan konfirmasi hanya dalam beberapa langkah.</p>
        </div>

        <div class="card">
            <h3>📦 Transparan</h3>
            <p>Lihat riwayat pembelian dan status pesanan secara real-time.</p>
        </div>
    </div>
@endsection