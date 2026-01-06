<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class LikedItemsController extends Controller
{
    public function listLikedItems(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view liked items.');
        }
        $userId = auth()->user()->id;
        $likedIds = \DB::table('liked_items')
            ->where('user_id', $userId)
            ->distinct()
            ->pluck('listing_id')
            ->toArray();

        $items = Listing::whereIn('id', $likedIds)->get();

        return view('store-page.liked-items', compact('items'));
    }
}
