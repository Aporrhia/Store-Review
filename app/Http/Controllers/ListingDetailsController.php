<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingDetailsController extends Controller
{
    public function show($id)
    {
        $item = Listing::with(['storeItem.attributes.attribute', 'user'])
            ->where('status', 'approved')
            ->findOrFail($id);
        $otherListings = Listing::with(['storeItem', 'user'])
            ->where('store_item_id', $item->store_item_id)
            ->where('id', '!=', $item->id)
            ->where('status', 'approved')
            ->get();

        $isLiked = false;
        if (auth()->check()) {
            $isLiked = \DB::table('liked_items')
                ->where('user_id', auth()->user()->id)
                ->where('listing_id', $item->id)
                ->exists();
        }
        return view('store-page.listing-details', compact('item', 'otherListings', 'isLiked'));
    }

    public function like($id)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'You must be logged in to like listings.');
        }

        $userId = auth()->user()->id;
        $listing = \App\Models\Listing::findOrFail($id);

        $exists = \DB::table('liked_items')
            ->where('user_id', $userId)
            ->where('listing_id', $listing->id)
            ->exists();

        if ($exists) {
            // If already liked, remove from liked_items
            \DB::table('liked_items')
                ->where('user_id', $userId)
                ->where('listing_id', $listing->id)
                ->delete();
            return redirect()->back()->with('success', 'Listing removed from your likes.');
        } else {
            // If not liked, add to liked_items
            \DB::table('liked_items')->insert([
                'user_id' => $userId,
                'listing_id' => $listing->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('success', 'Listing added to your likes.');
        }
    }

    public function searchListings(Request $request)
    {
        $query = $request->input('q');
        if (!$query) {
            return response()->json(['results' => [], 'hasMore' => false]);
        }

        // Search by title (adjust field as needed)
        $items = \App\Models\StoreItem::where('title', 'like', "%{$query}%")
            ->orderBy('title')
            ->limit(6)
            ->get(['id', 'title']);

        $results = $items->take(5)->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
            ];
        })->values();
        $hasMore = $items->count() > 5;

        return response()->json(['results' => $results, 'hasMore' => $hasMore]);
    }
}
