<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\LikedItemsController;


Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'catalogView'])->name('catalog');

Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'me'])->middleware('auth')->name('profile.me');
Route::get('/profile/{id}', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
Route::post('/profile/{id}/comment', [\App\Http\Controllers\ProfileController::class, 'addComment'])->name('profile.comment');
Route::post('/profile/update', [\App\Http\Controllers\ProfileController::class, 'update'])->middleware('auth')->name('profile.update');    
    

Route::get('/liked-items', [LikedItemsController::class, 'listLikedItems'])->name('liked.items');
Route::get('/catalog/{id}', [\App\Http\Controllers\ListingDetailsController::class, 'show'])->name('listing.details');
Route::post('/listing/{id}/like', [App\Http\Controllers\ListingDetailsController::class, 'like'])->name('listing.like');
Route::get('/search-listings', [App\Http\Controllers\ListingDetailsController::class, 'searchListings'])->name('search.listings');

Route::get('/terms-and-conditions', [\App\Http\Controllers\FooterController::class, 'termsAndConditions'])->name('terms.conditions');
Route::get('/privacy-policy', [\App\Http\Controllers\FooterController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('/about-us', [\App\Http\Controllers\FooterController::class, 'aboutUs'])->name('about.us');
Route::get('/support', [\App\Http\Controllers\FooterController::class, 'support'])->name('support');
Route::get('/faq', [\App\Http\Controllers\FooterController::class, 'faq'])->name('faq');

// Listing creation routes
Route::middleware(['auth'])->group(function () {
	Route::get('/listing/create', [\App\Http\Controllers\ListingController::class, 'create'])->name('listing.create');
	Route::post('/listing', [\App\Http\Controllers\ListingController::class, 'store'])->name('listing.store');
	Route::get('/listing/success', [\App\Http\Controllers\ListingController::class, 'success'])->name('listing.success');
});

// API route for fetching category attributes
Route::get('/api/category/{id}/attributes', [\App\Http\Controllers\ListingController::class, 'getCategoryAttributes']);
Route::get('/api/model-suggestions', [\App\Http\Controllers\ListingController::class, 'getModelSuggestions']);
