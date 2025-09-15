<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function termsAndConditions()
    {
        return view('footer.terms-and-conditions');
    }
}
