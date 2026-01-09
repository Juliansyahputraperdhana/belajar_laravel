<?php

use Illuminate\Support\Facades\Route;

Route::resource('product', \App\Http\Controllers\ProductController::class);
Route::get('/', function () {
    return view('welcome');
});
