@extends('layouts.app')

@section('title', 'Purchase Successful')

@section('content')
<div class="container mx-auto max-w-xl p-8 text-center">
    <span class="material-symbols-outlined text-6xl text-lime-500 mb-4">check_circle</span>
    <h1 class="text-2xl font-bold mb-4">Purchase Successful!</h1>
    <p class="text-gray-700 mb-6">Thank you for your purchase. Your order has been placed and you will receive a confirmation soon.</p>
    <a href="{{ route('home') }}" class="inline-block bg-lime-500 hover:bg-lime-600 text-white font-bold py-2 px-6 rounded-lg transition-colors">Back to Home</a>
</div>
@endsection