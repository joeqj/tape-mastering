@extends('layouts.default')

@section('content')
    <section class="mt-10 lg:w-3/4 lg:mx-auto space-y-8 text-center">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl mb-4">
            Your request has been submitted!
        </h1>

        <p>
            Thank your for your order, we'll be in touch via email when your master is ready. You can check the status of
            the master in your <a href="{{ url('/dashboard') }}">Dashboard.</a>
        </p>

        <p>- Reel Masters</p>
    </section>
@stop
