<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\PaymentCard;

class ProfileController extends Controller
{
    public function me()
    {
        $user = Auth::user();
        // Redirect to the user's dashboard
        return redirect()->route('profile.dashboard', $user->id);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('profile.sections.dashboard', compact('user'));
    }

    public function addComment(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        $request->validate([
            'title' => 'required|string|max:100',
            'comment' => 'nullable|string|max:200',
        
        ]);
        $comment = new \App\Models\Comment();
        $comment->user_id = Auth::user()->id;
        $comment->comment_writer_id = Auth::user()->id;
        $comment->comment_receiver_id = $request->input('recipient_id');
        $comment->title = $request->input('title');
        $comment->comment = $request->input('comment');
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
        ]);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();
        return back()->with('success', 'Profile updated successfully.');
    }
    public function replyToComment(Request $request, $commentId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to reply.');
        }

        $request->validate([
            'body' => 'required|string|max:200',
            'parent_id' => 'nullable|integer|exists:comment_replies,id',
        ]);

        $comment = \App\Models\Comment::findOrFail($commentId);

        // Check nesting level (max 5)
        $parentId = $request->input('parent_id');
        $level = 1;
        if ($parentId) {
            $parent = \App\Models\CommentReply::find($parentId);
            while ($parent && $parent->parent_id) {
                $level++;
                $parent = $parent->parent;
                if ($level >= 5) break;
            }
            if ($level >= 5) {
                return back()->with('error', 'Maximum reply nesting (5) reached.');
            }
        }

        $reply = new \App\Models\CommentReply();
        $reply->comment_id = $comment->id;
        $reply->user_id = Auth::id();
        $reply->body = $request->input('body');
        $reply->parent_id = $parentId;
        $reply->save();

        return back()->with('success', 'Reply added successfully.');
    }

    public function dashboard($id)
    {
        // Redirect to main profile page
        return redirect()->route('profile', $id);
    }

    public function orders($id)
    {
        // Check if user can access orders (only own orders)
        if (!Auth::check() || Auth::id() != $id) {
            return redirect()->route('profile.dashboard', $id);
        }
        
        $user = User::findOrFail($id);
        
        // Get orders where user is the buyer
        $buyerOrdersPending = $user->orders()
            ->with(['items.listing.storeItem', 'seller'])
            ->whereIn('status', ['invoice_sent', 'paid', 'in_progress', 'shipped'])
            ->orderByDesc('created_at')
            ->get();
            
        $buyerOrdersCompleted = $user->orders()
            ->with(['items.listing.storeItem', 'seller'])
            ->whereIn('status', ['delivered', 'cancelled'])
            ->orderByDesc('created_at')
            ->get();
        
        // Get orders where user is the seller
        $sellerOrdersPending = \App\Models\Order::where('seller_id', $user->id)
            ->with(['items.listing.storeItem', 'user'])
            ->whereIn('status', ['invoice_sent', 'paid', 'in_progress', 'shipped'])
            ->orderByDesc('created_at')
            ->get();
            
        $sellerOrdersCompleted = \App\Models\Order::where('seller_id', $user->id)
            ->with(['items.listing.storeItem', 'user'])
            ->whereIn('status', ['delivered', 'cancelled'])
            ->orderByDesc('created_at')
            ->get();
        
        return view('profile.sections.orders', compact(
            'user',
            'buyerOrdersPending',
            'buyerOrdersCompleted',
            'sellerOrdersPending',
            'sellerOrdersCompleted'
        ));
    }

    public function listings($id)
    {
        // Check if user can access listings (only own listings)
        if (!Auth::check() || Auth::id() != $id) {
            return redirect()->route('profile.dashboard', $id);
        }
        
        $user = User::findOrFail($id);
        return view('profile.sections.listings', compact('user'));
    }

    public function edit($id)
    {
        // Check if user can edit (only own profile)
        if (!Auth::check() || Auth::id() != $id) {
            return redirect()->route('profile.dashboard', $id);
        }
        
        $user = User::findOrFail($id);
        return view('profile.sections.edit', compact('user'));
    }

    public function comments($id)
    {
        $user = User::findOrFail($id);
        $comments = $user->commentReceiver()->with(['commentWriter', 'replies.user'])->orderByDesc('created_at')->get();
        return view('profile.sections.comments', compact('user', 'comments'));
    }

    public function paymentCards($id)
    {
        $user = User::findOrFail($id);
        $cards = PaymentCard::where('user_id', Auth::id())->get();
        return view('profile.sections.payment_cards', compact('user', 'cards'));
    }
}
