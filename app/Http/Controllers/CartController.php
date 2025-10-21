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

    // Buy all items from a specific seller
    public function buyFromSeller($seller_id, Request $request)
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('listing')->get();
        $sellerItems = $items->filter(function($item) use ($seller_id) {
            return optional($item->listing->user)->id == $seller_id;
        });
        if ($sellerItems->isEmpty()) {
            return redirect()->route('cart.buy.error');
        }
        // Calculate subtotal
        $subtotal = $sellerItems->sum(function($item) {
            return $item->listing->price ?? 0;
        });
        $shipping = $request->input('shipping_cost', 0);
        $total = $subtotal + $shipping;
        // Create order
        $order = \App\Models\Order::create([
            'user_id' => Auth::id(),
            'seller_id' => $seller_id,
            'total_amount' => $total,
            'status' => 'invoice_sent',
            'shipping_address' => $request->input('shipping_address', ''),
            'payment_method' => $request->input('payment_method', 'unknown'),
        ]);
        foreach ($sellerItems as $item) {
            $order->items()->create([
                'listing_id' => $item->listing->id,
                'price' => $item->listing->price ?? 0,
            ]);
            $item->delete();
        }
        return redirect()->route('order.show', ['id' => $order->id]);
    }

    // Remove buyAll functionality

    public function add(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:store_items,id',
        ]);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $item = $cart->items()->where('listing_id', $request->listing_id)->first();
        if (!$item) {
            $cart->items()->create([
                'listing_id' => $request->listing_id,
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
        // Quantity adjustment not supported
        return back()->with('success', 'Cart updated.');
    }
}
