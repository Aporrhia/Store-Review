<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Create order after user proceeds from cart
    public function checkout(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,user_id',
            'shipping_address' => 'required|string|min:10',
            'payment_method' => 'required|string',
            'shipping_cost' => 'required|numeric',
        ]);

        $user = Auth::user();
        $sellerId = $request->seller_id;
        $shippingAddress = $request->shipping_address ?: $user->address;
        if (empty($shippingAddress)) {
            return redirect()->route('cart')->with('error', 'Please provide a shipping address.');
        }

        $cart = Cart::where('user_id', $user->user_id)->first();
        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $sellerItems = $cart->items()->whereHas('listing', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->get();
        if ($sellerItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'No items found for this seller.');
        }

        $subtotal = $sellerItems->sum('price');
        $shipping = floatval($request->shipping_cost);
        $total = $subtotal + $shipping;

        $order = new Order();
        $order->user_id = $user->user_id;
        $order->seller_id = $sellerId;
        $order->total_amount = $total;
        $order->status = 'invoice_sent';
        $order->shipping_address = $shippingAddress;
        $order->payment_method = $request->payment_method;
        $order->save();

        foreach ($sellerItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->order_id;
            $orderItem->listing_id = $cartItem->listing_id;
            $orderItem->price = $cartItem->price;
            $orderItem->save();

            $listing = Listing::findOrFail($cartItem->listing_id);
            $listing->status = Listing::STATUS_PLACED;
            $listing->save();

            $cartItem->delete();
        }

        return redirect()->route('order.show', ['order_id' => $order->order_id])
                        ->with('success', 'Order placed successfully!');
    }

    // Show order page
    public function show($id)
    {
        if (!Auth::check()) {
            abort(404);
        }

        $order = Order::with(['items.listing.storeItem', 'user', 'seller'])
                    ->findOrFail($id);

        if (Auth::id() != $order->user_id && Auth::id() != $order->seller_id) {
            abort(404);
        }

        $isBuyer = Auth::id() == $order->user_id;
        $isSeller = Auth::id() == $order->seller_id;
        $subtotal = $order->items->sum('price');
        $shipping = $order->total_amount - $subtotal;

        return view('order.show', [
            'order' => $order,
            'isBuyer' => $isBuyer,
            'isSeller' => $isSeller,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
        ]);
    }

    public function showCheckoutForm()
    {
        // Example: get the latest order for the user (for placeholder)
        $order = \App\Models\Order::where('user_id', auth()->id())->latest()->first();
        return view('order.check-out-page', compact('order'));
    }
}
