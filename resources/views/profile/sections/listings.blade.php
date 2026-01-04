@extends('profile.layout')

@section('profile-content')
<section class="bg-white p-6 sm:p-8 rounded-xl shadow-md mb-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-6">My Listings</h2>
    
    <!-- Tab Navigation -->
    <div class="border-b border-gray-200 mb-6">
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
                        <div class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow relative group">
                            <div class="aspect-square bg-white flex items-center justify-center relative">
                                <img src="{{ $listing->storeItem->getImageUrl() }}" 
                                     alt="{{ $listing->storeItem->title }}" 
                                     class="w-full h-full object-contain">
                                <button type="button" onclick="openDeleteModal({{ $listing->id }}, '{{ addslashes($listing->storeItem->brand->name ?? '') }} {{ addslashes($listing->storeItem->title) }}')" class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full opacity-100 lg:opacity-0 lg:group-hover:opacity-100 hover:bg-red-600 transition-all duration-200 shadow-lg z-10 w-10 h-10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
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
                        <div class="border border-amber-200 rounded-lg overflow-hidden bg-amber-50 relative group">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center relative">
                                <img src="{{ $listing->storeItem->getImageUrl() }}" 
                                     alt="{{ $listing->storeItem->title }}" 
                                     class="w-full h-full object-contain opacity-75">
                                <div class="absolute top-2 left-2 bg-amber-500 text-white text-xs px-2 py-1 rounded-full font-medium">
                                    Pending Review
                                </div>
                                <button type="button" onclick="openDeleteModal({{ $listing->id }}, '{{ addslashes($listing->storeItem->brand->name ?? '') }} {{ addslashes($listing->storeItem->title) }}')" class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full opacity-100 lg:opacity-0 lg:group-hover:opacity-100 hover:bg-red-600 transition-all duration-200 shadow-lg z-10 w-10 h-10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteListingModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900">Delete Listing</h3>
                <button type="button" onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="mb-6">
                <p class="text-gray-700 mb-2">Are you sure you want to delete this listing?</p>
                <p id="deleteListingName" class="font-semibold text-gray-900 mb-4"></p>
                <p class="text-sm text-red-600">This action cannot be undone.</p>
            </div>
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 font-medium transition-colors">
                    Cancel
                </button>
                <form id="deleteListingForm" method="POST" action="" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 font-medium transition-colors">
                        Delete Listing
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Tab Functionality and Delete Modal -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
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

    function openDeleteModal(listingId, listingName) {
        document.getElementById('deleteListingName').textContent = listingName;
        document.getElementById('deleteListingForm').action = '/listing/' + listingId;
        document.getElementById('deleteListingModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteListingModal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('deleteListingModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    </script>

    <style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    </style>
</section>
@endsection