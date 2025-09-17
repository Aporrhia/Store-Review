<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function me()
    {
        $user = auth()->user();
        $comments = $user->commentReceiver()->with('commentWriter')->orderByDesc('created_at')->get();
        $id = $user->id;
        // You can pass more data to the view, like recent orders
        return view('profile.show', compact('user', 'id', 'comments'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $comments = $user->commentReceiver()->with('commentWriter')->orderByDesc('created_at')->get();
        // You can pass more data to the view, like recent orders
        return view('profile.show', compact('user', 'id', 'comments'));
    }

    public function addComment(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to comment.');
        }

        $request->validate([
            'title' => 'required|string|max:100',
            'comment' => 'nullable|string|max:200',
        ]);

        $comment = new \App\Models\Comment();
        $comment->user_id = auth()->user()->id;
        $comment->comment_writer_id = auth()->user()->id;
        $comment->comment_receiver_id = $request->input('recipient_id');
        $comment->title = $request->input('title');
        $comment->comment = $request->input('comment');
        $comment->save();

        return back()->with('success', 'Comment added successfully.');
    }
}
