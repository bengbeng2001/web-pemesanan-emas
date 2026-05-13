@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
    <center>
        <h1>Daftar Pelanggan</h1>
        <form method="post" action="{{ route('register') }}" class="card" style="max-width:420px;">
            @csrf
            <label for="name">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <label for="password_confirmation">Konfirmasi password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>

            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Daftar</button>
                <a href="{{ route('login') }}" class="btn">Sudah punya akun</a>
            </div>
        </form>
    </center>
@endsection