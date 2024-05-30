<header class="py-5">
  <div class="container flex items-center">
    <div class="w-1/3">

    </div>
    <div class="w-1/3 text-center">
      <a href="{{ url('/') }}">Tape Masters</a>
    </div>
    <div class="w-1/3 flex justify-end space-x-4">
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
