@extends('layouts.default')

@section('content')
  <section class="container py-10">
    @if ($errors->any())
      <ul class="border border-red-500 text-red-500 rounded-sm p-4">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif

    <form action="{{ url('login') }}" method="POST">
      @csrf

      <div class="mb-4">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="bg-transparent border border-slate-400">
      </div>
      <div class="mb-4">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="bg-transparent border border-slate-400">
      </div>
      <div class="mb-4">
        <label for="remember">
          <input type="checkbox" name="remember" id="remember">
          Remember Me
        </label>
      </div>

      <button type="submit">
        Log in
      </button>
    </form>
  </section>
@stop
