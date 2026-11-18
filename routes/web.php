<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;




// --- 1. GUEST & PUBLIC ROUTES ---
Route::get("/", [ProductController::class, "index"]);
Route::get("detail/{id}", [ProductController::class, "detail"]);
Route::get("search", [ProductController::class, "search"]);

// Auth Views
Route::get("/login", function () { return view('login'); })->name('login');
Route::get("/register", function () { return view('register'); });
Route::get("/forgot-password", function () { return view('forgot-password'); });

// Auth Actions
Route::post("/login", [UserController::class, "login"]);
Route::post("/register", [UserController::class, "register"]);
Route::get("/logout", [UserController::class, "logout"]);

// Cart Actions
Route::post("add_to_cart", [ProductController::class, "addToCart"]);
Route::post("buy_now", [ProductController::class, "buyNow"]);
Route::get('removecart/{id}', [ProductController::class, "removeCart"]);


// --- 2. CLIENT PROTECTED ROUTES (UserAuth) ---
Route::group(['middleware' => 'userAuth'], function () {
    Route::get("cartlist", [ProductController::class, "cartList"]);
    Route::get('ordernow', [ProductController::class, 'orderNow']);
    Route::post('orderplace', [ProductController::class, 'orderplace']);
    Route::get('myorders', [ProductController::class, 'myOrders']);
    
    Route::view('/about-us', 'about')->name('about');
    Route::view('/services', 'services')->name('services');
});


// --- 3. ADMIN PANEL ROUTES ---
// I added the product routes here so they stop giving 404 errors
Route::middleware(['admin'])->group(function () {
    
    // Order Management
    Route::get('/admin/orders', [AdminController::class, 'index']);
    Route::post('/update-order-status', [AdminController::class, 'updateStatus']);
    Route::post('/delete-order', [AdminController::class, 'deleteOrder']);

    // Product Management (Added these!)
    Route::get('/admin/products', [AdminController::class, 'showProducts']);
    Route::post('/add-product', [AdminController::class, 'addProduct']);
    Route::post('/delete-product', [AdminController::class, 'deleteProduct']);
    Route::get('/admin/edit-product/{id}', [AdminController::class, 'editProduct']);
    Route::post('/update-product', [AdminController::class, 'updateProduct']);
    
    
    Route::get('/admin/dashboard', function() { return "Welcome!"; });

    


// Find your product route and add the name at the end
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

