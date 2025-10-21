@extends('layouts.app')

@section('title', '404 Not Found')

@section('content')
<style>
    .error-bg-404 {
        background: url('/images/404/404.webp') center center no-repeat;
        background-size: cover;
        min-height: 100vh;
        position: relative;
    }
    .error-overlay {
        background: rgba(255,255,255,0.75);
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        backdrop-filter: blur(2px);
    }
</style>
<div class="error-bg-404 flex items-center justify-center">
    <div class="error-overlay max-w-lg w-full mx-4 p-10 flex flex-col items-center text-center mt-24 mb-24">
        <h1 class="text-6xl font-extrabold text-lime-600 mb-4 drop-shadow">404</h1>
        <h2 class="text-2xl font-bold text-gray-900 mb-2">OUT! Page Not Found</h2>
        <p class="text-lg text-gray-700 mb-6">Looks like this page missed the line.<br>Just like a tennis ball called OUT by Hawk-Eye.</p>
        <a href="{{ route('home') }}" class="inline-block bg-lime-600 hover:bg-lime-700 text-white font-bold py-3 px-8 rounded-lg transition-colors duration-200 shadow-lg">
            Back to Home Court
        </a>
    </div>
</div>
@endsection
