<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FooterController extends Controller
{

    public function termsAndConditions()
    {
        return view('footer.terms-and-conditions');
    }

    public function privacyPolicy()
    {
        return view('footer.privacy-policy');
    }

    public function aboutUs()
    {
        return view('footer.Abous-us-page');
    }

    public function support()
    {
        return view('footer.Support-page');
    }

}
