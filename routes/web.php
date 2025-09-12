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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::get('/liked-items', [LikedItemsController::class, 'listLikedItems'])->name('liked.items');
    Route::post('/listing/{id}/like', [App\Http\Controllers\ListingDetailsController::class, 'like'])->name('listing.like');
});

Route::get('/catalog/{id}', [\App\Http\Controllers\ListingDetailsController::class, 'show'])->name('listing.details');