<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        dd($user);
        $comments = $user->commentReceiver()->with('commentWriter')->orderByDesc('created_at')->get();
        // dd($comments);
        return view('store-page.user-profile', compact('user', 'comments'));
    }


}
