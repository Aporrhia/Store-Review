<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreItem;

class CatalogController extends Controller
{
    /**
     * Display the catalog page.
     */
    public function catalogView(Request $request)
    {
        $query = StoreItem::query();

        // Filter by category
        if ($request->has('category') && is_array($request->input('category')) && count($request->input('category')) > 0) {
            $query->whereIn('category', $request->input('category'));
        }

        // Filter by brand
        if ($request->has('brand') && is_array($request->input('brand')) && count($request->input('brand')) > 0) {
            $query->whereIn('brand', $request->input('brand'));
        }

        // Filter by price range
        $priceMin = $request->input('price_min');
        $priceMax = $request->input('price_max');
        if ($priceMin !== null && $priceMin !== '') {
            $query->where('price', '>=', $priceMin);
        }
        if ($priceMax !== null && $priceMax !== '') {
            $query->where('price', '<=', $priceMax);
        }

        // Sorting
        $sort = $request->input('sort');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort === 'title_asc') {
            $query->orderBy('title', 'asc');
        } elseif ($sort === 'title_desc') {
            $query->orderBy('title', 'desc');
        }

        $items = $query->get();

        // Calculate min and max price from filtered products
        $minPrice = $query->clone()->min('price');
        $maxPrice = $query->clone()->max('price');

        // Fallback if no items
        if ($minPrice === null) $minPrice = 0;
        if ($maxPrice === null) $maxPrice = 1000;

        return view('store-page.catalog', compact('items', 'minPrice', 'maxPrice'));
    }
}
