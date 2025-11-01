<?php

use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Products Routes
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', function () {
        return view('pages.products.index');
    })->name('index');
    
    Route::get('/search', function () {
        return view('pages.products.search');
    })->name('search');
    
    Route::get('/{slug}', function ($slug) {
        return view('pages.products.show', compact('slug'));
    })->name('show');
});

// Categories Routes
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', function () {
        return view('pages.categories.index');
    })->name('index');
    
    Route::get('/{slug}', function ($slug) {
        return view('pages.categories.show', compact('slug'));
    })->name('show');
});

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', function () {
        return view('pages.blog.index');
    })->name('index');
    
    Route::get('/{slug}', function ($slug) {
        return view('pages.blog.show', compact('slug'));
    })->name('show');
});

// Static Pages
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/privacy', function () {
    return view('pages.privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('pages.terms');
})->name('terms');

// Cart & Wishlist Routes
Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');

// User Routes (requires authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('profile');
    
    Route::get('/orders', function () {
        return view('pages.orders.index');
    })->name('orders.index');
});

// Locale Switcher
Route::get('/locale/{locale}', function ($locale) {
    $locale = in_array($locale, ['en', 'ar']) ? $locale : 'en';
    session(['locale' => $locale]);
    app()->setLocale($locale);
    return redirect()->back();
})->name('locale');
