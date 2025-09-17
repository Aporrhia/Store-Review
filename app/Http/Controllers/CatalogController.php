<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\StoreItem;
use App\Models\Category;

class CatalogController extends Controller
{
    /**
     * Display the catalog page.
     */
    public function catalogView(Request $request)
    {
    $query = Listing::with(['storeItem', 'user']);

    // Get all categories with their attributes
    $categories = Category::with('attributes')->get();
        // Search by StoreItem title
        if ($request->has('q') && $request->input('q')) {
            $search = $request->input('q');
            $query->whereHas('storeItem', function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%");
            });
        }

        // Filter by category
        $selectedCategories = $request->input('category', []);
        if (!empty($selectedCategories)) {
            $query->whereHas('storeItem', function($q) use ($selectedCategories) {
                $q->whereIn('category', $selectedCategories);
            });
        }

        // Filter by brand
        if ($request->has('brand') && is_array($request->input('brand')) && count($request->input('brand')) > 0) {
            $query->whereHas('storeItem', function($q) use ($request) {
                $q->whereIn('brand', $request->input('brand'));
            });
        }

        // Filter by attributes (nested per category)
        $attributeFilters = $request->input('attribute', []);
        if (!empty($selectedCategories) && !empty($attributeFilters)) {
            $query->whereHas('storeItem', function($q) use ($attributeFilters, $selectedCategories) {
                foreach ($attributeFilters as $catId => $attrs) {
                    if (!in_array(optional(Category::find($catId))->name, $selectedCategories)) continue;
                    foreach ($attrs as $attrId => $value) {
                        if ($value === null || $value === '') continue;
                        $q->whereHas('attributes', function($qa) use ($attrId, $value) {
                            $qa->where('attribute_id', $attrId)
                               ->where('value', $value);
                        });
                    }
                }
            });
        }

        // Filter by price range (on listings)
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
            $query->orderBy(
                StoreItem::select('title')
                    ->whereColumn('store_items.id', 'listings.store_item_id'),
                'asc'
            );
        } elseif ($sort === 'title_desc') {
            $query->orderBy(
                StoreItem::select('title')
                    ->whereColumn('store_items.id', 'listings.store_item_id'),
                'desc'
            );
        }

    // Per-page option
    $perPage = $request->input('per_page', 12); // default 12
    $items = $query->paginate($perPage)->withQueryString();

    // Calculate min and max price from all listings (filtered)
    $minPrice = Listing::min('price');
    $maxPrice = Listing::max('price');

    // Fallback if no items
    if ($minPrice === null) $minPrice = 0;
    if ($maxPrice === null) $maxPrice = 1000;

    return view('store-page.catalog', compact('items', 'minPrice', 'maxPrice', 'perPage', 'categories'));
    }
}
