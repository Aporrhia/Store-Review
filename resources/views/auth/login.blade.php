@extends('layouts.app')
<title>Sign In</title>
@section('content')
<div class="flex min-h-screen items-center justify-center bg-white">
    <div class="w-full max-w-md p-8 rounded-lg shadow border border-gray-200 bg-white">
        <h2 class="text-2xl font-bold text-center text-[#141414] mb-6">Sign In</h2>
        <form method="POST" action="{{ route('login') }}">
            @if ($errors->any())
                <div class="mb-4">
                    <ul class="list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required autofocus class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#141414] focus:ring-[#141414]">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#141414] focus:ring-[#141414]">
            </div>
            <button type="submit" class="w-full py-2 px-4 rounded-md bg-[#141414] text-white font-bold hover:bg-gray-800 transition">Sign In</button>
        </form>
        <div class="mt-6 text-center text-sm text-gray-600">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-[#84cc16] font-bold hover:underline">Sign Up</a>
        </div>
    </div>
</div>
@endsection
