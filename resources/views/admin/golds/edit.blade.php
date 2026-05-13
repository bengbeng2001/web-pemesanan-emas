@extends('layouts.app')

@section('title', 'Edit Emas')

@section('content')
    <h1>Edit Emas</h1>
    @if($gold->image)
        <p>Gambar saat ini:</p>
        <p><img class="proof" style="max-height:200px;" src="{{ asset('storage/'.$gold->image) }}" alt=""></p>
    @endif
    <form method="post" action="{{ route('admin.golds.update', $gold) }}" enctype="multipart/form-data" class="card" style="max-width:480px;">
        @csrf @method('PUT')
        <label for="name">Nama</label>
        <input id="name" type="text" name="name" value="{{ old('name', $gold->name) }}" required>

        <label for="image">Gambar baru (opsional; mengganti akan menghapus file lama)</label>
        <input id="image" type="file" name="image" accept="image/*">

        <label for="price">Harga (Rp)</label>
        <input id="price" type="number" name="price" step="0.01" min="0" value="{{ old('price', $gold->price) }}" required>

        <label for="stock">Stok</label>
        <input id="stock" type="number" name="stock" min="0" value="{{ old('stock', $gold->stock) }}" required>

        <div style="margin-top:1rem;">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.golds.index') }}" class="btn">Batal</a>
        </div>
    </form>
@endsection
