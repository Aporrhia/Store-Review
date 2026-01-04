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
    // Show order page
    public function show($id)
    {
        if (!Auth::check()) {
            abort(404);
        }

        $order = Order::with(['items.listing.storeItem', 'user', 'seller', 'messages.user'])
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

    // Show checkout form with cart items for a specific seller
    public function showCheckoutForm(Request $request)
    {
        $sellerId = $request->query('seller_id');
        
        if (!$sellerId) {
            return redirect()->route('cart.index')->with('error', 'Please select a seller to checkout.');
        }

        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $sellerItems = $cart->items()->whereHas('listing', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->with(['listing.storeItem', 'listing.user'])->get();

        if ($sellerItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No items found for this seller.');
        }

        $seller = $sellerItems->first()->listing->user;
        $subtotal = $sellerItems->sum(function($item) {
            return $item->listing->price ?? 0;
        });

       return response()
            ->view('order.check-out-page', [
                'seller' => $seller,
                'items' => $sellerItems,
                'subtotal' => $subtotal,
            ])
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    // Process checkout and create order
    public function processCheckout(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:users,id',
            'shipping_address' => 'required|string|min:10',
        ]);

        $user = Auth::user();
        $sellerId = $request->seller_id;
        $shippingAddress = $request->shipping_address;

        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $sellerItems = $cart->items()->whereHas('listing', function($query) use ($sellerId) {
            $query->where('user_id', $sellerId);
        })->get();

        if ($sellerItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No items found for this seller.');
        }

        $subtotal = $sellerItems->sum(function($item) {
            return $item->listing->price ?? 0;
        });
        $shipping = 0;
        $total = $subtotal + $shipping;

        $order = new Order();
        $order->user_id = $user->id;
        $order->seller_id = $sellerId;
        $order->total_amount = $total;
        $order->status = 'invoice_sent';
        $order->shipping_address = $shippingAddress;
        $order->payment_method = 'pending';
        $order->save();

        foreach ($sellerItems as $cartItem) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->listing_id = $cartItem->listing_id;
            $orderItem->price = $cartItem->listing->price ?? 0;
            $orderItem->save();

            $listing = Listing::findOrFail($cartItem->listing_id);
            $listing->status = Listing::STATUS_PLACED;
            $listing->save();

            $cartItem->delete();
        }

        return redirect()->route('order.show', ['id' => $order->id])
                        ->with('success', 'Order placed successfully!');
    }

    // Buyer confirms payment
    public function payOrder($id)
    {
        $order = Order::findOrFail($id);

        if (Auth::id() != $order->user_id) {
            abort(403);
        }

        if (in_array($order->status, ['invoice_sent', 'pending'])) {
            $order->status = 'paid';
            $order->save();
            return redirect()->route('order.show', ['id' => $order->id])
                            ->with('success', 'Payment confirmed! Waiting for seller to ship.');
        }

        return redirect()->route('order.show', ['id' => $order->id])
                        ->with('error', 'This order cannot be paid.');
    }

    // Seller changes order status progressively
    public function changeStatus($id)
    {
        $order = Order::findOrFail($id);

        if (Auth::id() != $order->seller_id) {
            abort(403);
        }

        // Only allow status change if payment is received
        if ($order->status === 'paid') {
            $order->status = 'shipped';
            $order->save();
            return redirect()->route('order.show', ['id' => $order->id])
                            ->with('success', 'Order marked as shipped!');
        } elseif ($order->status === 'shipped') {
            $order->status = 'delivered';
            $order->save();
            return redirect()->route('order.show', ['id' => $order->id])
                            ->with('success', 'Order marked as delivered!');
        }

        return redirect()->route('order.show', ['id' => $order->id])
                        ->with('error', 'Cannot change order status at this time.');
    }

    // Send message in order
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $order = Order::findOrFail($id);

        // Check if user is buyer or seller
        if (Auth::id() != $order->user_id && Auth::id() != $order->seller_id) {
            abort(403, 'Unauthorized');
        }

        $message = new \App\Models\OrderMessage();
        $message->order_id = $order->id;
        $message->user_id = Auth::id();
        $message->message = $request->message;
        $message->save();

        return redirect()->route('order.show', ['id' => $order->id])
                        ->with('success', 'Message sent!');
    }

    // Get messages for an order (AJAX endpoint)
    public function getMessages($id)
    {
        $order = Order::findOrFail($id);

        // Check if user is buyer or seller
        if (Auth::id() != $order->user_id && Auth::id() != $order->seller_id) {
            abort(403, 'Unauthorized');
        }

        $messages = $order->messages()->with('user')->get();

        return response()->json([
            'messages' => $messages,
            'currentUserId' => Auth::id()
        ]);
    }
}
