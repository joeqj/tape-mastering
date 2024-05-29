@extends('layouts.default')

@section('content')
  <section class="container py-10">
    <h2 class="text-4xl mb-10">Edit your audio - {{ $post->title }}</h2>
    <form action="{{ url('/audio/'.$post->id) }}" method="POST">
      @csrf

      <input type="text" name="title" value="{{ $post->title }}" class="block border border-slate-700  dark:bg-black dark:text-white/50 w-80 mb-3 p-2">

      <button type="submit" class="bg-slate-500 text-white px-4 py-2 rounded-lg">
        Edit
      </button>
    </form>
  </section>
@stop
