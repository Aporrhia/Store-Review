<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;


Route::get('/', [HomeController::class, 'index']);

Route::get('/catalog', [CatalogController::class, 'catalogView'])->name('catalog');
// Removed POST /catalog/filter route; all filtering/sorting is handled by GET /catalog