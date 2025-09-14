<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        // You can pass more data to the view, like recent orders
        return view('profile.show', compact('user'));
    }
}
