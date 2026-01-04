@extends('profile.layout')

@section('profile-content')
<section class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8 lg:min-h-[415px] flex flex-col justify-between">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Dashboard</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @if (auth()->check() && $user->id == auth()->id())
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                <p class="text-sm font-medium text-gray-500">Total Orders</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">{{ $user->orders()->count() }}</p>
            </div>
            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                <p class="text-sm font-medium text-gray-500">Liked Items</p>
                <p class="mt-1 text-3xl font-bold text-gray-900">0</p>
            </div>
        @endif
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
            <p class="text-sm font-medium text-gray-500">Listed Items</p>
            <p class="mt-1 text-xl font-semibold text-gray-900">{{ $user->listings()->count() }}</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
            <p class="text-sm font-medium text-gray-500">Account Since</p>
            <p class="mt-1 text-xl font-semibold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 flex flex-col justify-center items-center">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Rating</h3>
            <div class="flex items-center mb-2">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="material-symbols-outlined text-yellow-400 text-3xl">star</span>
                @endfor
            </div>
            <p class="text-sm text-gray-500">Your current rating: 5.0</p>
        </div>
        <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 flex flex-col justify-center items-center">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Account Status</h3>
            <div class="flex items-center gap-2 mb-2">
                <span class="inline-block px-3 py-1 rounded-full {{ $user->getStatusColor() }} font-semibold">{{ $user->getUserStatus() }}</span>
            </div>
            <p class="text-sm text-gray-500">Status levels: Bronze, Silver, Gold, Diamond</p>
        </div>
    </div>
</section>
@endsection