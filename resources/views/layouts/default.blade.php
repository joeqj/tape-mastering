<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.html-head')

<body class="antialiased font-body mt-header overflow-x-hidden">

    @include('includes.header')

    <main id="content" class="container">
        @yield('content')
    </main>

    @include('includes.footer')

</body>

</html>
