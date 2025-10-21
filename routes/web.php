<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LikedItemsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingDetailsController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentCardController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'catalogView'])->name('catalog');

// Profile routes
Route::get('/profile', [ProfileController::class, 'me'])->middleware('auth')->name('profile.me');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/{id}/dashboard', [ProfileController::class, 'dashboard'])->name('profile.dashboard');
Route::get('/profile/{id}/orders', [ProfileController::class, 'orders'])->middleware('auth')->name('profile.orders');
Route::get('/profile/{id}/listings', [ProfileController::class, 'listings'])->middleware('auth')->name('profile.listings');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::get('/profile/{id}/payment-cards', [ProfileController::class, 'paymentCards'])->middleware('auth')->name('profile.paymentCards');
Route::get('/profile/{id}/comments', [ProfileController::class, 'comments'])->name('profile.comments');
Route::post('/profile/{id}/comment', [ProfileController::class, 'addComment'])->name('profile.comment');
Route::post('/comment/{comment}/reply', [ProfileController::class, 'replyToComment'])->name('comment.reply');
Route::post('/profile/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');    
    

Route::get('/liked-items', [LikedItemsController::class, 'listLikedItems'])->name('liked.items');
Route::get('/catalog/{id}', [ListingDetailsController::class, 'show'])->name('listing.details');
Route::post('/listing/{id}/like', [App\Http\Controllers\ListingDetailsController::class, 'like'])->name('listing.like');
Route::get('/search-listings', [App\Http\Controllers\ListingDetailsController::class, 'searchListings'])->name('search.listings');

Route::get('/terms-and-conditions', [FooterController::class, 'termsAndConditions'])->name('terms.conditions');
Route::get('/privacy-policy', [FooterController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/about-us', [FooterController::class, 'aboutUs'])->name('about.us');
Route::get('/support', [FooterController::class, 'support'])->name('support');
Route::get('/faq', [FooterController::class, 'faq'])->name('faq');
Route::get('/media', [FooterController::class, 'media'])->name('media');
Route::get('/blog', [FooterController::class, 'blog'])->name('blog');

// Listing creation routes
Route::middleware(['auth'])->group(function () {
	Route::get('/listing/create', [ListingController::class, 'create'])->name('listing.create');
	Route::post('/listing', [ListingController::class, 'store'])->name('listing.store');
	Route::get('/listing/success', [ListingController::class, 'success'])->name('listing.success');
});

// API route for fetching category attributes
Route::get('/api/category/{id}/attributes', [ListingController::class, 'getCategoryAttributes']);
Route::get('/api/model-suggestions', [ListingController::class, 'getModelSuggestions']);

// Cart routes
Route::middleware(['auth'])->group(function () {
	Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
	Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
	Route::post('/cart/item/{id}/remove', [CartController::class, 'remove'])->name('cart.remove');
	Route::post('/cart/item/{id}/update', [CartController::class, 'update'])->name('cart.update');
	Route::post('/cart/buy/seller/{seller_id}', [CartController::class, 'buyFromSeller'])->name('cart.buy.seller');
	Route::post('/cart/buy/all', [CartController::class, 'buyAll'])->name('cart.buy.all');
	Route::get('/cart/buy/success', function() { return view('cart.buy-success'); })->name('cart.buy.success');
	Route::get('/cart/buy/error', function() { return view('cart.buy-error'); })->name('cart.buy.error');
});

// Order routes
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [OrderController::class, 'showCheckoutForm'])->name('checkout');
    Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
});

// Payment Card Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/payment-cards', [PaymentCardController::class, 'store'])->name('payment-cards.store');
    Route::get('/payment-cards/{paymentCard}/edit', [PaymentCardController::class, 'edit'])->name('payment-cards.edit');
    Route::put('/payment-cards/{paymentCard}', [PaymentCardController::class, 'update'])->name('payment-cards.update');
    Route::delete('/payment-cards/{paymentCard}', [PaymentCardController::class, 'destroy'])->name('payment-cards.destroy');
});
