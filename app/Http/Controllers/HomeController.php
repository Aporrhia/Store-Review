<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class HomeController extends Controller
{
    public function index()
    {
        // Get the last 4 approved listings
        $latestListings = Listing::with(['storeItem.brand', 'storeItem.category', 'user'])
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('home', compact('latestListings'));
    }
}
