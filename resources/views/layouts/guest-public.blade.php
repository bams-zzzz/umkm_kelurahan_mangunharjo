<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog UMKM Desa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <nav class="p-4 bg-white shadow">
        <a href="{{ route('katalog.index') }}" class="font-bold">Katalog UMKM Desa</a>
        @auth
            <a href="{{ route('dashboard') }}" class="ml-4">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="ml-4">Login Admin</a>
        @endauth
    </nav>

    <main class="p-4">
        @yield('content')
    </main>
</body>
</html>