<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('images/Logo-kelurahan.png') }}" class="logo-img" alt="Logo Kelurahan">
    </div>
    
    <div class="nav-right">
        <div class="nav-links">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#produk">Produk</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
        <form action="{{ route('katalog') }}" method="GET" class="search-container">
            <input type="text" name="search" class="search-input" placeholder="Search Here..." value="{{ request('search') }}">
            <button type="submit" class="search-icon" style="background:none; border:none;">&#128269;</button>
        </form>
    </div>
</nav>