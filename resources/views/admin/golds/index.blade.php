@extends('layouts.app')

@section('title', 'Stok Emas')

@section('content')
    <h1>Stok Emas</h1>
    <p><a class="btn btn-primary" href="{{ route('admin.golds.create') }}">Tambah</a></p>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th></th>
            </tr>
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
                    <td>
                        <a class="btn btn-sm" href="{{ route('admin.golds.edit', $gold) }}">Edit</a>
                        <form class="inline" method="post" action="{{ route('admin.golds.destroy', $gold) }}" onsubmit="return confirm('Hapus data ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Belum ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div style="margin-top:1rem;">{{ $golds->links() }}</div>
@endsection
