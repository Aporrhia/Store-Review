<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $cartCount = 0;
            if (auth()->check()) {
                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                if ($cart) {
                    $cartCount = $cart->items()->sum('quantity');
                }
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
