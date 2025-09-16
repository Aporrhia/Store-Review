<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\StoreItem;
use App\Models\Attribute;
use App\Models\StoreItemAttribute;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        return view('store-page.create-listing', compact('brands', 'categories'));
    }

    public function getCategoryAttributes($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $attributes = $category->attributes()->select('attributes.id', 'attributes.name', 'attributes.input_type')->get();
        return response()->json($attributes);
    }

    public function getModelSuggestions(Request $request)
    {
        $query = $request->get('q', '');
        $brandId = $request->get('brand_id');
        $categoryId = $request->get('category_id');

        $storeItems = StoreItem::query()
            ->select('title')
            ->where('title', 'LIKE', "%{$query}%")
            ->when($brandId, function ($q) use ($brandId) {
                $q->where('brand_id', $brandId);
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            })
            ->distinct()
            ->limit(10)
            ->pluck('title');

        return response()->json($storeItems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,used,refurbished',
            'attributes' => 'array',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create or find StoreItem
        $storeItem = StoreItem::firstOrCreate([
            'title' => $request->model,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
        ], [
            'description' => '',
            'sku' => strtoupper(uniqid('SKU-')),
        ]);

        // Handle image upload if provided and store item doesn't have image yet
        if ($request->hasFile('product_image') && !$storeItem->image_path) {
            $image = $request->file('product_image');
            $imageName = $storeItem->sku . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/products/' . $imageName;
            
            $image->move(public_path('images/products'), $imageName);
            
            $storeItem->update(['image_path' => $imagePath]);
        }

        // Save attributes
        if ($request->has('attributes')) {
            foreach ($request->attributes as $attrId => $value) {
                StoreItemAttribute::updateOrCreate([
                    'store_item_id' => $storeItem->id,
                    'attribute_id' => $attrId,
                ], [
                    'value' => $value,
                ]);
            }
        }

        // Create Listing
        $listing = Listing::create([
            'store_item_id' => $storeItem->id,
            'user_id' => Auth::id(),
            'price' => $request->price,
            'condition' => $request->condition,
            'comment' => $request->comment,
        ]);

        return redirect()->route('listing.details', $listing->id)->with('success', 'Listing created!');
    }
}
