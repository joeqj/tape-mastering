@extends('layouts.default')

@section('content')
    <section class="mt-10">
        <div class="flex justify-between items-center mb-9">
            <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl">
                Your Masters
            </h1>
            <p class="text-sm lg:text-md">Logged in as {{ $user->name }}</p>
        </div>

        <ul class="space-y-4">
            @foreach ($submissions as $entry)
                <li
                    class="grid items-center grid-cols-12 border border-b border-black border-opacity-15 rounded-md p-5 shadow-sm">
                    <p class="text-xl font-bold col-span-6 pr-16 truncate">{{ $entry->title }}</p>
                    <p class="col-span-2">{{ $entry->created_at->diffForHumans() }}</p>
                    <div class="col-span-2 text-center">
                        <span
                            class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-4 py-2 rounded-full dark:bg-gray-700 dark:text-gray-300">{{ $entry->status }}</span>
                    </div>
                    <div class="col-span-2 text-right">
                        @if ($entry->master_download)
                            <a role="link" href="{{ $entry->master_download }}"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Dark</a>
                        @else
                            <p class="text-sm">Your master is in progress</p>
                        @endif
                    </div>
                </li>
            @endforeach
        </ul>

        <h2 class="mt-10 mb-2 text-lg font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-2xl">
            Start a new master</h2>

        <p>Drop your audio to be mastered below to get started</p>

        <form action="{{ url('/upload') }}" method="POST" enctype="multipart/form-data"
            class="flex items-center justify-center w-full mt-9">
            @csrf
            <label for="upload"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">WAV, FLAC, AIFF, MP3 (Use WAV for best quality)</p>
                </div>
                <input id="upload" name="upload" onchange="this.form.submit()" type="file" class="hidden" />
            </label>
        </form>

    </section>
    <section class="mt-12">
        <h2 class="mb-4 text-lg font-extrabold leading-none tracking-tight text-gray-900 md:text-xl lg:text-2xl">FAQs</h2>
        @include('user.blocks.faq')
    </section>

    @if ($errors->any())
        <ul x-data="errorDialog" x-show="open" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="border bg-red-500 text-white rounded-md p-4 max-w-sm fixed bottom-4 left-4 z-50">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop
