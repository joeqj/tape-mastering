@extends('layouts.default')

@section('content')
    <section class="mt-10">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl">
            Complete your upload
        </h1>

        <div class="max-w-3xl pt-5 space-y-4">
            <p>
                Add any details to your upload to help with the mastering process - a particular tone or style that you're
                looking for, or a link to a song that we can use as a reference to do our best to match.
            </p>
        </div>

        <form action="{{ url('/store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="user_upload" id="user_upload" value="{{ $path }}">

            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" name="title" id="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Your Song Title" value="{{ $fileName }}" required />
            </div>

            <div>

                <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comments</label>
                <textarea id="comment" name="comment" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Any useful information goes here"></textarea>

                <input type="hidden" name="status" id="status" value="pending">

            </div>

            <div class="max-w-sm border border-black border-opacity-15 shadow-sm p-4">
                <h3 class="text-2xl font-extrabold dark:text-white mb-5">Order Summary</h3>

                <div class="flex justify-between">
                    <p>1x Audio to tape mastering service</p>
                    <p>£8.00</p>
                </div>

                <div class="flex justify-between mt-4 pt-4 border-t border-black border-opacity-15">
                    <p>Order Total</p>
                    <p>£8.00</p>
                </div>
            </div>

            <p class="text-sm">Currency conversion will be taken care of in the next step</p>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit</button>
        </form>


    </section>

    <script>
        var isFormSubmitting = false;

        // Add an event listener to all forms to set the flag when a form is submitted
        document.querySelectorAll('form').forEach(function(form) {
            form.addEventListener('submit', function() {
                isFormSubmitting = true;
            });
        });

        window.addEventListener('beforeunload', function(e) {
            if (!isFormSubmitting) {
                // Cancel our submission and send this data to server
                var upload = document.getElementById('user_upload');

                var data = new FormData();
                data.append('upload_path', upload.value);
                data.append('_token', '{{ csrf_token() }}');

                navigator.sendBeacon('/cancel-upload', data);
            }
        });
    </script>
@stop
