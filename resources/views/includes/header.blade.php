<header class="site-header" x-data="header" :class="isScrolled ? 'has-scrolled' : ''">
    <div class="container flex items-center font-mono text-lg font-medium">
        <div class="w-1/3 flex space-x-14">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/about') }}">About</a>
        </div>
        <div class="w-1/3 flex justify-center">
            <a href="{{ url('/') }}">
                <img src="{{ url('/images/logo.svg') }}" alt="Reel Masters Logo" class="site-header__logo" />
            </a>
        </div>
        <div class="w-1/3 flex justify-end space-x-14">
            @guest
                <a href="{{ url('login') }}">Login / Signup</a>
            @endguest
            @auth
                <a href="{{ url('dashboard') }}">Dashboard</a>
                <a href="{{ url('logout') }}">Logout</a>
            @endauth
        </div>
    </div>
</header>
