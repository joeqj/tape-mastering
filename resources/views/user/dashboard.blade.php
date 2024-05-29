@extends('layouts.default')

@section('content')
  <section class="container py-10">
    <h2 class="text-4xl">Welcome {{ $user->name }}</h2>
  </section>
@stop
