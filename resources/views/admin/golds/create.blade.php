@extends('layouts.app')

@section('title', 'Tambah Emas')

@section('content')
    <h1>Tambah Emas</h1>
    <form method="post" action="{{ route('admin.golds.store') }}" enctype="multipart/form-data" class="card" style="max-width:480px;">
        @csrf
        <label for="name">Nama</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required>

        <label for="image">Gambar (opsional, JPG/PNG/WebP, maks. 2 MB)</label>
        <input id="image" type="file" name="image" accept="image/*">

        <label for="price">Harga (Rp)</label>
        <input id="price" type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required>

        <label for="stock">Stok</label>
        <input id="stock" type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required>

        <div style="margin-top:1rem;">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.golds.index') }}" class="btn">Batal</a>
        </div>
    </form>
@endsection
