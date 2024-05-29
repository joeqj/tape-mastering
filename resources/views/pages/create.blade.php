@extends('layouts.default')

@section('content')
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
@stop
