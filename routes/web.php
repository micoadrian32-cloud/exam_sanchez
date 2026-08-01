<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use inertia\inertia;

Route::inertia('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ProductController::class, 'index'])->name('dashboard');
    Route::post('product', [ProductController::class, 'store'])->name('product.store');
    Route::put('product/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});

require __DIR__.'/settings.php';    
