@extends('layouts.default')

@section('content')

    <section class="py-section-sm">
        <div class="max-w-3xl format lg:format-lg mx-auto text-center">
            <h1>About Us</h1>
            <p class="lead">Founded in 2024 Reel Masters was born out of a love for the sound and textures of tape
                recordings and the
                desire to share this love with the world.</p>
            <p>We're not trying to compete with online AI powered mastering tools, our service isn't instant and it isn't
                perfect. We're doing our own thing, inspired by the ethos behind the original Revox tape machines we offer
                an
                honest service for people who know that real analog equipment will never be replaced.</p>
        </div>
    </section>


    <section class="pb-section border-b border-black border-opacity-15">
        <img src="{{ url('/images/bg-gradient.jpg') }}" alt="The Revox B77 used for mastering" />

        <div class="flex divide-x divide-black divide-opacity-15 mt-10">
            <div class="w-1/2 format lg:format-lg lg:pr-8">
                <h2>Revox B77</h2>
                <ul class="pt-2">
                    <li>
                        <p class="font-bold">Premium quality components</p>
                        <p>Including high-fidelity tape heads and amplifiers for sound quality.</p>
                    </li>
                    <li>
                        <p class="font-bold">Low Wow and Flutter</p>
                        <p>Ensuring a stable sound with minimal pitch variations.</p>
                    </li>
                    <li>
                        <p class="font-bold">Wide Frequency Response</p>
                        <p>With a wide and flat frequency response, the B77 captures the full spectrum of the audio signal
                            ensuring that both the low-end and high-end frequencies are accurately reproduced.</p>
                    </li>

                </ul>
            </div>
            <div class="w-1/2 format lg:format-lg lg:pl-8">
                <h2>Motu UltraLite Mk3</h2>
                <ul class="pt-2">
                    <li>
                        <p class="font-bold">Accurate AD/DA Conversion</p>
                        <p>Ensuring the analog signals from our tape recorders are digitised accurately.</p>
                    </li>
                    <li>
                        <p class="font-bold">Supports sample rates up to 192kHz</p>
                        <p>For high resolution audio recordings.</p>
                    </li>
                    <li>
                        <p class="font-bold">Transparent Sound Quality</p>
                        <p>MOTU are renowned for interfaces that do not come with a lot of character, leaving that job to
                            the audio source.</p>
                    </li>

                </ul>
            </div>
        </div>
    </section>

    <section class="py-section text-center format lg:format-lg mx-auto">
        <p class="lead">"Our goal is to create equipment that not only meets but exceeds the expectations of our users."
        </p>
        <p class="lead">"Customer satisfaction is the ultimate measure of success."</p>
        <p>- Willi Studer</p>
        <p class="text-sm">Founder of Revox</p>
    </section>
@stop
