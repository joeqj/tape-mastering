@extends('layouts.default')

@section('content')
  <section class="container py-10">
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
@stop
