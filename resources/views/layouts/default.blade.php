<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.html-head')

<body class="font-sans antialiased dark:bg-black dark:text-white/50">

    @include('includes.header')

    <main id="content" class="container">
        @yield('content')
    </main>

    @include('includes.footer')

</body>

</html>
