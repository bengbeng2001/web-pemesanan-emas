@extends('layouts.app')

@section('title', 'Belanja Emas')

@section('content')
    <h1>Stok Tersedia</h1>
    <p class="muted">Harga per unit. Untuk memesan, gunakan halaman buat pesanan.</p>
    <table>
        <thead>
            <tr><th>Gambar</th><th>Nama</th><th>Harga</th><th>Stok</th></tr>
        </thead>
        <tbody>
            @forelse($golds as $gold)
                <tr>
                    <td style="width:72px;">
                        @if($gold->image)
                            <img class="thumb-gold" src="{{ asset('storage/'.$gold->image) }}" alt="">
                        @else
                            <span class="muted">—</span>
                        @endif
                    </td>
                    <td>{{ $gold->name }}</td>
                    <td>Rp {{ number_format($gold->price, 0, ',', '.') }}</td>
                    <td>{{ $gold->stock }}</td>
                </tr>
            @empty
                <tr><td colspan="4" class="muted">Stok kosong. Cek lagi nanti.</td></tr>
            @endforelse
        </tbody>
    </table>
    <p style="margin-top:1rem;"><a class="btn btn-primary" href="{{ route('customer.orders.create') }}">Buat pesanan</a></p>
@endsection
