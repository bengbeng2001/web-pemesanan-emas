<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pemesanan Emas')</title>
    <style>
        :root {
            --bg: #f8f6f1;
            --card: #fff;
            --accent: #b8860b;
            --text: #1a1a1a;
            --muted: #5c5c5c;
            --border: #e5e0d8;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Georgia, 'Times New Roman', serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.5;
        }

        a {
            color: var(--accent);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        header {
            background: var(--card);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 1.25rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
        }

        header nav {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem 1rem;
            align-items: center;
        }

        header strong {
            font-size: 1.05rem;
        }

        main {
            max-width: 960px;
            margin: 0 auto;
            padding: 1.5rem 1rem 2.5rem;
        }

        .flash {
            padding: 0.65rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            border: 1px solid var(--border);
            background: var(--card);
        }

        .flash.success {
            border-color: #c8e6c9;
            background: #e8f5e9;
        }

        .flash.error {
            border-color: #ffcdd2;
            background: #ffebee;
        }

        .errors {
            color: #b71c1c;
            font-size: 0.9rem;
            margin: 0 0 1rem;
            padding-left: 1.1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
        }

        th,
        td {
            padding: 0.6rem 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
            font-size: 0.95rem;
        }

        th {
            background: #faf7f0;
            font-weight: 600;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .btn {
            display: inline-block;
            padding: 0.45rem 0.85rem;
            border-radius: 6px;
            border: 1px solid var(--border);
            background: var(--card);
            color: var(--text);
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            border-color: #9a7209;
        }

        .btn-primary:hover {
            filter: brightness(1.05);
            text-decoration: none;
        }

        .btn-danger {
            background: #c62828;
            color: #fff;
            border-color: #8e0000;
        }

        .btn-sm {
            font-size: 0.8rem;
            padding: 0.3rem 0.55rem;
        }

        form.inline {
            display: inline;
        }

        input[type=text],
        input[type=email],
        input[type=password],
        input[type=number],
        input[type=file],
        select,
        textarea {
            width: 100%;
            max-width: 420px;
            padding: 0.45rem 0.55rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 0.95rem;
        }

        label {
            display: block;
            margin-top: 0.75rem;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: flex-end;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1rem 1.1rem;
            margin-bottom: 1rem;
        }

        h1 {
            font-size: 1.35rem;
            margin: 0 0 1rem;
        }

        h2 {
            font-size: 1.1rem;
            margin: 1.25rem 0 0.5rem;
        }

        .muted {
            color: var(--muted);
            font-size: 0.9rem;
        }

        img.proof {
            max-width: 100%;
            max-height: 360px;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        img.thumb-gold {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--border);
            flex-shrink: 0;
        }

        .td-gold {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
    @stack('styles')
</head>

<body>
    <header>
        <strong><a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">UBS Lifestyle</a></strong>
        <nav>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    <a href="{{ route('admin.golds.index') }}">Stok Emas</a>
                    <a href="{{ route('admin.orders.index') }}">List Pesanan</a>
                    <a href="{{ route('admin.payments.index') }}">Verifikasi Pembayaran</a>
                    <a href="{{ route('admin.transactions.index') }}">Lunas</a>
                @else
                    <a href="{{ route('customer.shop.index') }}">Belanja</a>
                    <a href="{{ route('customer.orders.create') }}">Buat Pesanan</a>
                    <a href="{{ route('customer.orders.index') }}">Riwayat Pembelian</a>
                @endif
                <span class="muted">{{ auth()->user()->name }}</span>
                <form class="inline" method="post" action="{{ route('logout') }}">@csrf
                    <button type="submit" class="btn btn-sm">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            @endauth
        </nav>
    </header>
    <main>
        @if(session('success'))
            <div class="flash success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="flash error">
                <ul class="errors" style="margin:0;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>

</html>

<style>
    /* HERO */
    .hero {
        text-align: center;
        padding: 60px 20px;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-radius: 10px;
        margin-bottom: 30px;
    }

    .hero h1 {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .hero p {
        color: #555;
        margin-bottom: 20px;
    }

    /* BUTTON */
    .btn {
        padding: 10px 18px;
        border-radius: 6px;
        text-decoration: none;
        margin: 5px;
        display: inline-block;
    }

    .btn.primary {
        background: #d97706;
        color: white;
    }

    .btn.primary:hover {
        background: #b45309;
    }

    .btn.secondary {
        background: #eee;
        color: #333;
    }

    /* FEATURES */
    .features {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .card {
        background: white;
        padding: 20px;
        width: 250px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        text-align: center;
    }

    .card h3 {
        margin-bottom: 10px;
    }
</style>