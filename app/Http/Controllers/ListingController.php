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
use Illuminate\Support\Str;

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

        $categoryName = $category->name;
        $attributes = $attributes->map(function ($attr) use ($attributeValues, $categoryName) {
            $allowed = $attributeValues[$categoryName][$attr->name] ?? null;
            $attr->allowed_values = $allowed;
            return $attr;
        });
        return response()->json($attributes);
    }

    public function getModelSuggestions(Request $request)
    {
        $brandId = $request->get('brand_id');
        $categoryId = $request->get('category_id');

        if (!$brandId || !$categoryId) {
            return response()->json([]);
        }

        $storeItems = StoreItem::query()
            ->select('title')
            ->where('brand_id', $brandId)
            ->where('category_id', $categoryId)
            ->distinct()
            ->orderBy('title')
            ->limit(50)
            ->pluck('title');

        return response()->json($storeItems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'model' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) use ($request) {
                    // Validate that the model exists in the database for the selected brand/category
                    $exists = StoreItem::where([
                        'title' => $value,
                        'brand_id' => $request->brand_id,
                        'category_id' => $request->category_id,
                    ])->exists();
                    
                    if (!$exists) {
                        $fail('The selected model is not available for this brand and category.');
                    }
                },
            ],
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:new,used,refurbished',
            'attributes' => 'array',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create or find StoreItem

        // Find existing StoreItem (it must exist due to validation)
        $storeItem = StoreItem::where([
            'title' => $request->model,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
        ])->first();

        // Handle image upload if provided and store item doesn't have image yet
        if ($request->hasFile('product_image') && !$storeItem->image_path) {
            $image = $request->file('product_image');
            $imageName = $storeItem->sku . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/products/' . $imageName;
            
            $image->move(public_path('images/products'), $imageName);
            
            $storeItem->update(['image_path' => $imagePath]);
        }

        // Save attributes
        // Get all category attributes and ensure they exist for this store item
        $category = Category::with('attributes')->find($request->category_id);
        foreach ($category->attributes as $attribute) {
            $value = $request->input("attributes.{$attribute->id}");
            
            if ($value !== null && $value !== '') {
                StoreItemAttribute::updateOrCreate([
                    'store_item_id' => $storeItem->id,
                    'attribute_id' => $attribute->id,
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
            'status' => 'pending',
        ]);

        return redirect()->route('listing.success')->with('success', 'Listing submitted for review!');
    }

    public function success()
    {
        return view('store-page.listing-success');
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        
        // Verify that the authenticated user owns this listing
        if ($listing->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $listing->delete();
        
        return redirect()->route('profile.listings', ['id' => Auth::id()])
            ->with('success', 'Listing deleted successfully.');
    }
}
