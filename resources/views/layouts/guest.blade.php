<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin UMKM</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 2rem 2.5rem;
            width: 100%;
            max-width: 420px;
        }
        .logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 1.75rem;
        }
        .logo-wrap img { height: 64px; }
    </style>
</head>
<body>
    <h1 class="page-title">Dashboard Admin UMKM</h1>
    <div class="card">
        <div class="logo-wrap">
            <a href="/"><img src="{{ asset('images/Logo-kelurahan.png') }}" alt="Logo Mangunharjo"></a>
        </div>
        {{ $slot }}
    </div>
</body>
</html>