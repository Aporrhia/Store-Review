@extends('layouts.app')

@section('title', 'My Account')

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
                        <a href="#dashboard" class="flex items-center gap-3 rounded-md bg-lime-100 px-3 py-2 text-sm font-semibold text-lime-700">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                        <a href="#orders" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                            <span class="material-symbols-outlined">receipt_long</span>
                            <span>My Orders</span>
                        </a>
                        <a href="#edit-profile" class="flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                            <span class="material-symbols-outlined">person</span>
                            <span>Edit Profile</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex w-full items-center gap-3 rounded-md px-3 py-2 text-sm font-medium text-gray-600 hover:bg-gray-100 hover:text-gray-900">
                                <span class="material-symbols-outlined">logout</span>
                                <span>Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="w-full md:w-2/3 lg:w-3/4">
                <!-- Dashboard Section -->
                <section id="dashboard" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Dashboard</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                            <p class="text-sm font-medium text-gray-500">Total Orders</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                            <p class="text-sm font-medium text-gray-500">Wishlist Items</p>
                            <p class="mt-1 text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                            <p class="text-sm font-medium text-gray-500">Account Since</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </section>

                <!-- My Orders Section -->
                <section id="orders" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">My Orders</h2>
                    <div class="text-center text-gray-500 py-12">
                        <span class="material-symbols-outlined text-6xl">inventory_2</span>
                        <p class="mt-4 text-lg font-medium">You have no past orders.</p>
                        <p class="mt-2 text-sm">When you place an order, it will appear here.</p>
                        <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-lime-500 px-6 py-2.5 text-sm font-bold text-gray-900 shadow-sm transition-transform hover:scale-105 hover:bg-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
                            Start Shopping
                        </a>
                    </div>
                </section>

                <!-- Edit Profile Section -->
                <section id="edit-profile" class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Edit Profile</h2>
                    <form action="#" method="POST">
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" disabled>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" disabled>
                            </div>
                        </div>
                        <div class="mt-8 text-right">
                            <button type="button" class="inline-flex items-center justify-center rounded-md bg-gray-300 px-5 py-2.5 text-sm font-bold text-gray-600 cursor-not-allowed">
                                Edit (Coming Soon)
                            </button>
                        </div>
                    </form>
                </section>
            </main>

        </div>
    </div>
</div>
@endsection
