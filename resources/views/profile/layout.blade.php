@extends('layouts.app')

@section('title', 'Profile - ' . $user->name)

@section('content')
<div class="bg-gray-50 font-sans">
    <div class="container mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">
        <div class="flex flex-col md:flex-row md:gap-x-8">

            <!-- Left Sidebar -->
            <aside class="w-full md:w-1/3 lg:w-1/4 mb-8 md:mb-0">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="size-16 rounded-full bg-cover bg-center" style="background-image: url('{{ $user->profile_photo_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuC93DKUUEzC7lkrBdfWtvmOrAoSa-kYRKKJmoBxVGU24JG6ZH1w_oaTNXsorUpAwYc8XjdpXG_2i0qmYwV2NbZTUH2wyf9lzECPRzvSwE4Pr3Q6_j9rVVcdXRbkkSfcVQH5iiuL2-Rg91CpPejmv7KWmesm3jw-kx6XBxYiv9pq_Y7jZayhLEGpYLdgVWohgy-2BTbCu31r7ayQwvaSPgD7XhbIyNQnIrtaPgYh7kUXgStmFTGBq2cV5oSrtpfwmKyvfTcgwk0SBVs' }}')"></div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <nav class="flex flex-col space-y-2">
                        <a href="{{ route('profile', $user->id) }}" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-semibold transition-colors {{ request()->routeIs('profile') && !request()->routeIs('profile.*') || request()->routeIs('profile.dashboard') ? 'bg-lime-100 text-lime-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                        @if (auth()->check() && $user->id == auth()->id())
                            <a href="{{ route('profile.orders', $user->id) }}" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('profile.orders') ? 'bg-lime-100 text-lime-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                <span class="material-symbols-outlined">receipt_long</span>
                                <span>My Orders</span>
                            </a>
                            <a href="{{ route('profile.listings', $user->id) }}" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('profile.listings') ? 'bg-lime-100 text-lime-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                <span class="material-symbols-outlined">inventory</span>
                                <span>My Listings</span>
                            </a>
                            <a href="{{ route('profile.edit', $user->id) }}" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('profile.edit') ? 'bg-lime-100 text-lime-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                                <span class="material-symbols-outlined">person</span>
                                <span>Edit Profile</span>
                            </a>
                        @endif
                        <a href="{{ route('profile.comments', $user->id) }}" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors {{ request()->routeIs('profile.comments') ? 'bg-lime-100 text-lime-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                            <span class="material-symbols-outlined">comment</span>
                            <span>Comments</span>
                        </a>
                        @if (auth()->check() && $user->id == auth()->id())
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        @endif
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="w-full md:w-2/3 lg:w-3/4">
                @yield('profile-content')
            </main>

        </div>
    </div>
</div>
@endsection