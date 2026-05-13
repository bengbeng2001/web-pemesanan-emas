@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
    <center>
        <h1>Masuk</h1>
        <form method="post" action="{{ route('login') }}" class="card" style="max-width:420px;">
            @csrf
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>

            <label style="display:flex;align-items:center;gap:0.35rem;margin-top:0.75rem;">
                <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>

            <div style="margin-top:1rem;">
                <button type="submit" class="btn btn-primary">Masuk</button>
                <a href="{{ route('register') }}" class="btn">Daftar</a>
            </div>
        </form>
    </center>

@endsection