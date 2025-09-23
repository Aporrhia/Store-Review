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
        $query = Listing::with(['storeItem', 'user'])->where('status', 'approved');

        // Predefined attribute values per category + attribute (sync with StoreItemSeeder)
        $attributeValues = [
            'Rackets' => [
                'Head Size' => [98, 100],
                'Weight'    => [280, 300, 320],
                'Length'    => [27],
            ],
            'Balls' => [
                'Amount in Pack' => [3, 4, 12],
                'Material'       => ['Felt', 'Rubber'],
                'Color'          => ['Yellow', 'White'],
            ],
            'Dampeners' => [
                'Material' => ['Silicone', 'Rubber'],
                'Color'    => ['Black', 'White', 'Blue'],
                'Weight'   => [2, 3],
            ],
            'Overgrips' => [
                'Material' => ['Synthetic', 'Polyurethane'],
                'Length'   => [1100, 1200],
                'Color'    => ['White', 'Black', 'Green', 'Pink'],
            ],
            'Base Grips' => [
                'Length'   => [1100, 1200],
                'Material' => ['Synthetic', 'Leather'],
                'Color'    => ['Black', 'White', 'Brown'],
            ],
        ];

            // Get all categories with their attributes, and attach allowed_values for select fields
            $categories = Category::with('attributes')->get();
            foreach ($categories as $cat) {
                foreach ($cat->attributes as $attr) {
                    $catName = $cat->name;
                    $attrName = $attr->name;
                    $attr->allowed_values = $attributeValues[$catName][$attrName] ?? null;
                }
            }
            // Search by StoreItem title
            if ($request->has('q') && $request->input('q')) {
                $search = $request->input('q');
                $query->whereHas('storeItem', function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%");
                });
            }

            // Filter by category and attributes (OR logic per category)
            $selectedCategories = $request->input('category', []);
            $attributeFilters = $request->input('attribute', []);
            if (!empty($selectedCategories)) {
                $categoryIds = \App\Models\Category::whereIn('name', $selectedCategories)->pluck('id')->all();
                $query->where(function($mainQ) use ($categoryIds, $attributeFilters) {
                    foreach ($categoryIds as $catId) {
                        $mainQ->orWhereHas('storeItem', function($q) use ($catId, $attributeFilters) {
                            $q->where('category_id', $catId);
                            if (isset($attributeFilters[$catId]) && is_array($attributeFilters[$catId])) {
                                foreach ($attributeFilters[$catId] as $attrId => $value) {
                                    if ($value === null || $value === '') continue;
                                    $q->whereHas('attributes', function($qa) use ($attrId, $value) {
                                        $qa->where('attribute_id', $attrId)
                                        ->where('value', $value);
                                    });
                                }
                            }
                        });
                    }
                });
            }

            // Filter by brand (applies to all selected categories)
            if ($request->has('brand') && is_array($request->input('brand')) && count($request->input('brand')) > 0) {
                $brands = $request->input('brand');
                $brandIds = \App\Models\Brand::whereIn('name', $brands)->pluck('id');
                $query->whereHas('storeItem', function($q) use ($brandIds) {
                    $q->whereIn('brand_id', $brandIds);
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

        // Calculate min and max price from all approved listings (global, not filtered)
        $minPrice = Listing::query()->where('status', 'approved')->min('price');
        $maxPrice = Listing::query()->where('status', 'approved')->max('price');

        // Fallback if no items
        if ($minPrice === null) $minPrice = 0;
        if ($maxPrice === null) $maxPrice = 1000;

        return view('store-page.catalog', compact('items', 'minPrice', 'maxPrice', 'perPage', 'categories'));
    }
}
