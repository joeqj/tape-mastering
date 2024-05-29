<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
  <section class="container mx-auto py-10">
    <h2 class="text-4xl mb-10">Upload your audio</h2>
    <form action="{{ url('/create') }}" method="POST">
      @csrf

      <select name="user_id" class="block border border-slate-700  dark:bg-black dark:text-white/50 w-80 mb-3 p-2">
        @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
      </select>

      <input type="text" name="title" placeholder="Title" class="block border border-slate-700  dark:bg-black dark:text-white/50 w-80 mb-3 p-2">

      <button type="submit" class="bg-slate-500 text-white px-4 py-2 rounded-lg">
        Create
      </button>
    </form>
  </section>

  <footer class="py-16 text-center text-sm text-black dark:text-white/70">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
  </footer>
</body>

</html>
