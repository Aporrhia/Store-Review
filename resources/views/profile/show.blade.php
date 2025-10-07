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
                        <a href="#dashboard" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-semibold transition-colors" data-section="dashboard">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                        @if (auth()->check() && $user->id == auth()->id())
                            <a href="#orders" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors" data-section="orders">
                                <span class="material-symbols-outlined">receipt_long</span>
                                <span>My Orders</span>
                            </a>
                            <a href="#my-listings" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors" data-section="my-listings">
                                <span class="material-symbols-outlined">inventory</span>
                                <span>My Listings</span>
                            </a>
                            <a href="#edit-profile" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors" data-section="edit-profile">
                                <span class="material-symbols-outlined">person</span>
                                <span>Edit Profile</span>
                            </a>
                        @endif
                        <a href="#comments" class="profile-nav-link flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition-colors" data-section="comments">
                            <span class="material-symbols-outlined">comment</span>
                            <span>Comments</span>
                        </a>
                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            function setActiveSidebarLink() {
                                var hash = window.location.hash ? window.location.hash.substring(1) : 'dashboard';
                                document.querySelectorAll('.profile-nav-link').forEach(function(link) {
                                    if (link.getAttribute('data-section') === hash || (hash === '' && link.getAttribute('data-section') === 'dashboard')) {
                                        link.classList.add('bg-lime-100', 'text-lime-700');
                                        link.classList.remove('text-gray-600', 'hover:bg-gray-100', 'hover:text-gray-900');
                                    } else {
                                        link.classList.remove('bg-lime-100', 'text-lime-700');
                                        link.classList.add('text-gray-600', 'hover:bg-gray-100', 'hover:text-gray-900');
                                    }
                                });
                            }
                            setActiveSidebarLink();
                            window.addEventListener('hashchange', setActiveSidebarLink);
                        });
                        </script>
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
                <!-- Dashboard Section -->
                <section id="dashboard" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Dashboard</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @if (auth()->check() && $user->id == auth()->id())
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                                <p class="text-sm font-medium text-gray-500">Total Orders</p>
                                <p class="mt-1 text-3xl font-bold text-gray-900">0</p>
                            </div>
                            <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                                <p class="text-sm font-medium text-gray-500">Liked Items</p>
                                <p class="mt-1 text-3xl font-bold text-gray-900">0</p>
                            </div>
                        @endif
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                            <p class="text-sm font-medium text-gray-500">Listed Items</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900">999</p>
                        </div>
                        <div class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center">
                            <p class="text-sm font-medium text-gray-500">Account Since</p>
                            <p class="mt-1 text-xl font-semibold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </section>
                @if (auth()->check() && $user->id == auth()->id())
                    <!-- My Orders Section -->
                    <section id="orders" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                        <button id="toggle-orders" type="button" class="w-full flex items-center justify-between px-0 py-0 sm:px-0 bg-white focus:outline-none">
                            <span class="text-2xl font-bold tracking-tight text-gray-900">My Orders</span>
                            <span id="orders-chevron" class="material-symbols-outlined text-2xl transition-transform">expand_more</span>
                        </button>
                        <div id="orders-content" class="px-0 sm:px-0 pb-0" style="display: {{ $orders->isEmpty() ? 'none' : 'block' }};">
                            @if($orders->isEmpty())
                                <div class="text-center text-gray-500 py-12">
                                    <span class="material-symbols-outlined text-6xl">inventory_2</span>
                                    <p class="mt-4 text-lg font-medium">You have no past orders.</p>
                                    <p class="mt-2 text-sm">When you place an order, it will appear here.</p>
                                    <a href="{{ route('catalog') }}" class="mt-6 inline-flex items-center justify-center rounded-md bg-lime-500 px-6 py-2.5 text-sm font-bold text-gray-900 shadow-sm transition-transform hover:scale-105 hover:bg-lime-400 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
                                        Start Shopping
                                    </a>
                                </div>
                            @else
                                <div class="overflow-x-auto mt-4">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Code</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Brand</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seller</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-100">
                                            @foreach($orders as $order)
                                                <tr>
                                                    <td class="px-4 py-2 font-mono text-sm text-lime-700">{{ $order->order_code }}</td>
                                                    <td class="px-4 py-2 text-sm text-gray-700">{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                                    <td class="px-4 py-2 text-gray-900 font-semibold">{{ $order->storeItem->title ?? '-' }}</td>
                                                    <td class="px-4 py-2 text-gray-700">{{ $order->storeItem->brand->name ?? '-' }}</td>
                                                    <td class="px-4 py-2 text-gray-700">
                                                        @if($order->seller)
                                                            <a href="{{ route('profile', ['id' => $order->seller->id]) }}" class="text-lime-700 hover:underline font-medium">{{ $order->seller->name }}</a>
                                                        @else
                                                            <span class="text-gray-400">-</span>
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-2 text-gray-900">{{ $order->quantity ?? 1 }}</td>
                                                    <td class="px-4 py-2 text-gray-900 font-bold">${{ number_format($order->price ?? 0, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="mt-4">
                                        <div class="flex justify-center">
                                            {{ $orders->onEachSide(1)->links('vendor.pagination.custom') }}
                                        </div>
                                    </div>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const btn = document.getElementById('toggle-orders');
                            const content = document.getElementById('orders-content');
                            const chevron = document.getElementById('orders-chevron');
                            let open = content.style.display !== 'none';
                            btn.addEventListener('click', function() {
                                open = !open;
                                content.style.display = open ? 'block' : 'none';
                                chevron.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
                            });
                            chevron.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
                        });
                        </script>
                    </section>

                    <!-- My Listings Section -->
                    <section id="my-listings" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                        <button id="toggle-listings" type="button" class="w-full flex items-center justify-between px-0 py-0 sm:px-0 bg-white focus:outline-none">
                            <span class="text-2xl font-bold tracking-tight text-gray-900">My Listings</span>
                            <span id="listings-chevron" class="material-symbols-outlined text-2xl transition-transform">expand_more</span>
                        </button>
                        <div id="listings-content" class="px-0 sm:px-0 pb-0" style="display: none;">
                            <!-- Tab Navigation -->
                            <div class="border-b border-gray-200 mb-6 mt-6">
                                <nav class="-mb-px flex space-x-8">
                                    <button class="listings-tab-button active py-2 px-1 border-b-2 font-medium text-sm border-lime-500 text-lime-600" data-tab="approved">
                                        Approved
                                    </button>
                                    <button class="listings-tab-button py-2 px-1 border-b-2 font-medium text-sm border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="pending">
                                        Pending
                                    </button>
                                </nav>
                            </div>

                            <!-- Tab Content -->
                            <div class="tab-content">
                            <!-- Approved Listings Tab -->
                            <div id="approved-tab" class="listings-tab-content">
                                @php
                                    $approvedListings = $user->listings()->where('status', 'approved')->with(['storeItem.brand', 'storeItem.category'])->orderByDesc('created_at')->get();
                                @endphp
                                
                                @if($approvedListings->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        @foreach($approvedListings as $listing)
                                            <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                                <div class="aspect-square bg-white flex items-center justify-center">
                                                    <img src="{{ $listing->storeItem->getImageUrl() }}" 
                                                         alt="{{ $listing->storeItem->title }}" 
                                                         class="w-full h-full object-contain">
                                                </div>
                                                <div class="p-4">
                                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                                        <a href="{{ route('listing.details', $listing->id) }}" class="hover:text-lime-600 transition-colors">
                                                            {{ $listing->storeItem->brand->name ?? '' }} {{ $listing->storeItem->title }}
                                                        </a>
                                                    </h3>
                                                    <div class="space-y-1 text-sm text-gray-600">
                                                        <div>{{ $listing->storeItem->category->name ?? 'N/A' }}</div>
                                                        <div class="font-bold text-gray-900">${{ $listing->price }}</div>
                                                        <div class="text-xs text-gray-500">Listed {{ $listing->created_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-gray-500 py-12">
                                        <span class="material-symbols-outlined text-6xl mb-4 block">inventory</span>
                                        <p class="text-lg font-medium">No approved listings yet.</p>
                                        <p class="text-sm">Your approved listings will appear here.</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Pending Listings Tab -->
                            <div id="pending-tab" class="listings-tab-content hidden">
                                @php
                                    $pendingListings = $user->listings()->where('status', 'pending')->with(['storeItem.brand', 'storeItem.category'])->orderByDesc('created_at')->get();
                                @endphp
                                
                                @if($pendingListings->count() > 0)
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                        @foreach($pendingListings as $listing)
                                            <div class="border border-amber-200 rounded-lg overflow-hidden bg-amber-50">
                                                <div class="aspect-square bg-gray-50 flex items-center justify-center relative">
                                                    <img src="{{ $listing->storeItem->getImageUrl() }}" 
                                                         alt="{{ $listing->storeItem->title }}" 
                                                         class="w-full h-full object-contain opacity-75">
                                                    <div class="absolute top-2 right-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                                        Pending Review
                                                    </div>
                                                </div>
                                                <div class="p-4">
                                                    <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">
                                                        {{ $listing->storeItem->brand->name ?? '' }} {{ $listing->storeItem->title }}
                                                    </h3>
                                                    <div class="space-y-1 text-sm text-gray-600">
                                                        <div>{{ $listing->storeItem->category->name ?? 'N/A' }}</div>
                                                        <div class="font-bold text-gray-900">${{ $listing->price }}</div>
                                                        <div class="text-xs text-amber-600">Submitted {{ $listing->created_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center text-gray-500 py-12">
                                        <span class="material-symbols-outlined text-6xl mb-4 block">pending</span>
                                        <p class="text-lg font-medium">No pending listings.</p>
                                        <p class="text-sm">Listings awaiting review will appear here.</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                            </div>
                        </div>

                        <!-- JavaScript for Toggle and Tab Functionality -->
                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Toggle functionality
                            const btn = document.getElementById('toggle-listings');
                            const content = document.getElementById('listings-content');
                            const chevron = document.getElementById('listings-chevron');
                            let open = content.style.display !== 'none';
                            
                            btn.addEventListener('click', function() {
                                open = !open;
                                content.style.display = open ? 'block' : 'none';
                                chevron.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';
                            });
                            chevron.style.transform = open ? 'rotate(180deg)' : 'rotate(0deg)';

                            // Tab functionality
                            const tabButtons = document.querySelectorAll('.listings-tab-button');
                            const tabContents = document.querySelectorAll('.listings-tab-content');
                            
                            tabButtons.forEach(button => {
                                button.addEventListener('click', () => {
                                    const targetTab = button.getAttribute('data-tab');
                                    
                                    // Update button states
                                    tabButtons.forEach(btn => {
                                        btn.classList.remove('active', 'border-lime-500', 'text-lime-600');
                                        btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                                    });
                                    
                                    button.classList.add('active', 'border-lime-500', 'text-lime-600');
                                    button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
                                    
                                    // Update content visibility
                                    tabContents.forEach(content => {
                                        content.classList.add('hidden');
                                    });
                                    
                                    document.getElementById(targetTab + '-tab').classList.remove('hidden');
                                });
                            });
                        });
                        </script>
                    </section>

                    <!-- Edit Profile Section -->
                    <section id="edit-profile" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">Edit Profile</h2>
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="100">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-lime-500 focus:ring-lime-500 sm:text-sm" required maxlength="100">
                                </div>
                            </div>
                            @if ($errors->any())
                                <div class="mt-4 text-red-600">
                                    <ul class="list-disc pl-5">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="mt-4 text-green-600">{{ session('success') }}</div>
                            @endif
                            <div class="mt-8 text-right">
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-lime-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-lime-600">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </section>
                @endif
                <section id="comments" class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
                    @include('store-page.components.comment-block', [
                        'profileUser' => $user,
                        'comments' => $comments,
                        'listingUsers' => [],
                        'showForm' => true
                    ])
                </section>
            </main>

        </div>
    </div>
</div>
@endsection
