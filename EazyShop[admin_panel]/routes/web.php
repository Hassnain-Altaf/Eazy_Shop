<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


Route::get('/', function(){
    return view('Pages.Index');
});

Route::post('/signup', [AuthController::class, 'Signup'])->name('signup');
Route::post('/signin', [AuthController::class, 'Signin'])->name('signin');
Route::post('/add-category', [ProductController::class, 'AddCategory'])->name('add-category');

Route::get('/', [ProductController::class, 'ShowProducts']);
Route::get('/add-product', [ProductController::class, 'ShowCategories']);
Route::post('/add-product', [ProductController::class, 'ListProduct'])->name('add-product');

Route::get('/product/{id}', [ProductController::class, 'ShowProductdetail'])->name('product.detail');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');



Route::get('/signup', function(){
    return view('Auth.Signup');
});

Route::get('/signin', function(){
    return view('Auth.Signin');
});

Route::get('/add-category', function(){
    return view('Admin.Addcategory');
});

// -------------------------------


Route::get('/cart-products', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/update-cart/{itemId}', [CartController::class, 'updateQuantity']);

Route::post('/remove-cart-item/{itemId}', [CartController::class, 'removeCartItem'])->name('cart.remove');
Route::get('/remove-cart-item/{itemId}', [CartController::class, 'removeCartItem'])->name('cart.remove');

Route::post('/checkout', [OrderController::class, 'storeOrders'])->name('order.store');
Route::get('/checkout', [OrderController::class, 'SeeCartProducts'])->name('cart-checkout.view');











// -------------------------------


Route::get('/header', function(){
    return view('Component.Header');
});

Route::get('/shop-detail', function(){
    return view('Pages.Shopdetail');
});

// Route::get('/checkout', function(){
//     return view('Pages.Checkout');
// });

// Route::get('/cart', function(){
//     return view('Pages.Shopingcart');
// });

Route::get('/brand-admin', function(){
    return view('Admin.Index');
});

Route::get('/list-product', function(){
    return view('Admin.Productlisting');
});

Route::get('/list-category', function(){
    return view('Admin.Addcategory');
});