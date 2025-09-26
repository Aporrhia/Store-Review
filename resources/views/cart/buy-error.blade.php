@extends('layouts.app')

@section('title', 'Purchase Error')

@section('content')
<div class="container mx-auto max-w-xl p-8 text-center">
    <span class="material-symbols-outlined text-6xl text-red-500 mb-4">error</span>
    <h1 class="text-2xl font-bold mb-4">Purchase Failed</h1>
    <p class="text-gray-700 mb-6">Sorry, there was a problem processing your purchase. Please try again or contact support.</p>
    <a href="{{ route('cart.index') }}" class="inline-block bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-6 rounded-lg transition-colors">Back to Cart</a>
</div>
@endsection