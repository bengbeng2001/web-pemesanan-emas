@extends('layouts.app')

@section('title', 'Buat Pesanan')

@section('content')
    <h1>Buat Pesanan</h1>
    <p class="muted">Isi jumlah per produk (0 = tidak dipesan).</p>
    <form method="post" action="{{ route('customer.orders.store') }}">
        @csrf
        <table>
            <thead>
                <tr><th>Produk</th><th>Harga</th><th>Stok</th><th>Jumlah</th></tr>
            </thead>
            <tbody>
                @foreach($golds as $gold)
                    <tr>
                        <td>
                            <div class="td-gold">
                                @if($gold->image)
                                    <img class="thumb-gold" src="{{ asset('storage/'.$gold->image) }}" alt="">
                                @endif
                                <span>{{ $gold->name }}</span>
                            </div>
                        </td>
                        <td>Rp {{ number_format($gold->price, 0, ',', '.') }}</td>
                        <td>{{ $gold->stock }}</td>
                        <td style="max-width:120px;">
                            <input type="number" name="quantities[{{ $gold->id }}]" min="0" max="{{ $gold->stock }}" value="{{ old('quantities.'.$gold->id, 0) }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if($golds->isEmpty())
            <p class="muted">Tidak ada stok untuk dipesan.</p>
        @else
            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Kirim pesanan</button>
            </div>
        @endif
    </form>
@endsection
