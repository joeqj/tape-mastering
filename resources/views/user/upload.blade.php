@extends('layouts.default')

@section('content')
    <section class="mt-10">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl">
            Complete your upload
        </h1>

        <div class="max-w-3xl pt-5 space-y-4">
            <p>
                Add any details to your master before you are taken to our secure payment gateway.
            </p>
        </div>

        <form action="{{ url('/store') }}" method="POST" enctype="multipart/form-data" class="space-y-8"
            x-data="orderForm">
            @csrf

            <input type="hidden" name="user_upload" id="user_upload" value="{{ $path }}">

            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" name="title" id="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Your Song Title" value="{{ $fileName }}" required />
            </div>

            <div>
                @include('user.blocks.comment-label')
                <textarea id="comment" name="comment" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Any useful information goes here"></textarea>

                <input type="hidden" name="status" id="status" value="pending">

            </div>

            <div class="max-w-sm border border-black border-opacity-15 rounded-lg shadow-sm p-4">
                <h3 class="text-2xl font-extrabold dark:text-white mb-5">Order Summary</h3>

                <div class="flex justify-between">
                    <p>1x Audio to tape mastering service</p>
                    <p>£8.00</p>
                </div>

                <div x-show="hasDiscount" x-cloak class="flex justify-between mt-2">
                    <p class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                            <path
                                d="M11.707 2.293A.997.997 0 0 0 11 2H6a.997.997 0 0 0-.707.293l-3 3A.996.996 0 0 0 2 6v5c0 .266.105.52.293.707l10 10a.997.997 0 0 0 1.414 0l8-8a.999.999 0 0 0 0-1.414l-10-10zM13 19.586l-9-9V6.414L6.414 4h4.172l9 9L13 19.586z">
                            </path>
                            <circle cx="8.353" cy="8.353" r="1.647"></circle>
                        </svg>
                        <span x-text="coupon"></span>
                    </p>
                    <p>- £<span x-text="discount"></span></p>
                </div>

                <div class="flex justify-between mt-4 pt-4 border-t border-black border-opacity-15">
                    <p>Order Total</p>
                    <p id="total" x-ref="total" x-text="displayedTotal">£8.00</p>
                </div>
            </div>

            <div class="max-w-xs">
                <label for="coupon" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Coupon</label>
                <div class="relative">
                    <input type="text" id="coupon" name="coupon" x-ref="coupon"
                        class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    <button @click.prevent="checkCoupon()"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apply</button>
                </div>
                <p x-show="hasError" x-text="error" class="text-red-500 mt-2" x-cloak></p>
            </div>

            <p>Currency conversion will be taken care of in the next step</p>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Go
                to Payment</button>
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
