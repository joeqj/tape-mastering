@extends('layouts.default')

@section('content')
    <section class="mt-10 lg:w-3/4 lg:mx-auto">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl">
            Describe your master
        </h1>

        <form action="{{ url('/store') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
            @csrf

            <input type="text" name="upload" value="{{ $path }}">
            <p>File: {{ $fileName }}</p>

            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" id="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Your Song Title" required />
            </div>

            <div>

                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comments</label>
                <textarea id="comment" name="comment" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Any useful information goes here"></textarea>

            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </form>


    </section>
@stop
