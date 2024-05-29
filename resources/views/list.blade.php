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
  @vite("resources/scss/app.scss", "resources/js/app.js")
</head>

<body class="font-sans antialiased dark:bg-black dark:text-white/50">
  <section class="container mx-auto py-10">
    <h2 class="text-4xl mb-10">List of audio</h2>
    <ul>
      @foreach ($audio as $post)
      <li class="flex items-center mb-4">
        <div class="w-1/2">
          <p class="text-lg">{{ $post->title }}</p>
          <span>User: {{ $post->user->name }}</span>
        </div>
        <div class="w-1/2 flex justify-end space-x-2">
          <a href="{{ url('/audio/'.$post->id) }}" class="bg-slate-500 text-white px-4 py-2 rounded-lg">
            Update
          </a>

          <form action="{{ url('/audio/'.$post->id) }}" method="POST">
            @method('DELETE')
            @csrf

            <button type="submit" class="bg-slate-500 text-white px-4 py-2 rounded-lg">
              Delete
            </button>
          </form>
        </div>
      </li>
      @endforeach
    </ul>
  </section>

  <footer class="py-16 text-center text-sm text-black dark:text-white/70">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
  </footer>
</body>

</html>
