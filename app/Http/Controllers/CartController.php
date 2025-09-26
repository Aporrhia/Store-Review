<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\StoreItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with(['listing.user', 'listing.storeItem.brand'])->get();

        // Group items by seller (listing->user_id)
        $grouped = $items->groupBy(function($item) {
            return optional($item->listing->user)->id;
        });

        // Prepare seller info for each group
        $sellers = [];
        foreach ($grouped as $sellerId => $sellerItems) {
            $seller = $sellerItems->first()->listing->user ?? null;
            $sellers[] = [
                'seller' => $seller,
                'items' => $sellerItems
            ];
        }

        return view('cart.cart', compact('cart', 'sellers'));
    }

    // ...existing code...

    // Buy all items from a specific seller
    public function buyFromSeller($seller_id)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('listing')->get();
        $sellerItems = $items->filter(function($item) use ($seller_id) {
            return optional($item->listing->user)->id == $seller_id;
        });
        if ($sellerItems->isEmpty()) {
            return redirect()->route('cart.buy.error');
        }
        // Create an order for each item
        foreach ($sellerItems as $item) {
            if ($item->listing && $item->listing->store_item_id) {
                \App\Models\Order::create([
                    'user_id' => \Illuminate\Support\Facades\Auth::id(),
                    'seller_id' => $item->listing->user_id,
                    'store_item_id' => $item->listing->store_item_id,
                    'price' => ($item->listing->price ?? 0) * $item->quantity,
                    'quantity' => $item->quantity,
                ]);
            }
            $item->delete();
        }
        return redirect()->route('cart.buy.success');
    }

    // Buy all items from all sellers
    public function buyAll()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('listing')->get();
        if ($items->isEmpty()) {
            return redirect()->route('cart.buy.error');
        }
        // Create an order for each item
        foreach ($items as $item) {
            if ($item->listing && $item->listing->store_item_id) {
                \App\Models\Order::create([
                    'user_id' => \Illuminate\Support\Facades\Auth::id(),
                    'seller_id' => $item->listing->user_id,
                    'store_item_id' => $item->listing->store_item_id,
                    'price' => ($item->listing->price ?? 0) * $item->quantity,
                    'quantity' => $item->quantity,
                ]);
            }
            $item->delete();
        }
        return redirect()->route('cart.buy.success');
    }
    // ...existing code...

    public function add(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:store_items,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $item = $cart->items()->where('listing_id', $request->listing_id)->first();
        if ($item) {
            $item->quantity += $request->input('quantity', 1);
            $item->save();
        } else {
            $cart->items()->create([
                'listing_id' => $request->listing_id,
                'quantity' => $request->input('quantity', 1),
            ]);
        }
        return back()->with('success', 'Item added to cart.');
    }

    public function remove($id)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cart->items()->where('id', $id)->delete();
        return back()->with('success', 'Item removed from cart.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $item = $cart->items()->where('id', $id)->firstOrFail();
        $item->quantity = $request->quantity;
        $item->save();
        return back()->with('success', 'Cart updated.');
    }
}
