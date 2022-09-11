<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\PostController as ClientPostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->prefix('/auth')->name('auth.')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister'])->name('processRegister');
});

Route::middleware('auth')->prefix('/profile')->name('profile.')->group(function(){
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/order/{id}/cancel', [ProfileController::class, 'cancelOrder'])->name('cancel-order');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.send');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

Route::post('/checkout', [CheckoutController::class, 'store'])->name('order');

Route::get('/track', [CheckoutController::class, 'track'])->name('track');

Route::get('/p/{slug}-{id}', [ProductController::class, 'index'])->where(['id' => '\d+', 'slug' => '.*'])->name('product');

Route::post('/p/{slug}-{id}/review', [ProductController::class, 'review'])->where(['id' => '\d+', 'slug' => '.*'])->name('product.review');

Route::get('/posts', [ClientPostController::class, 'index'])->name('post.list');

Route::get('/post/{slug}-{id}', [ClientPostController::class, 'show'])->where(['id' => '\d+', 'slug' => '.*'])->name('post.detail');

// Define Cart

Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.add');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::delete('/cart', [CartController::class, 'clearCart'])->name('cart.clear');

// Define Admin Auth

Route::middleware('guest')->prefix('/admin')->name('admin.auth.')->group(function(){
    Route::get('/auth/login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('/auth/login', [AdminAuthController::class, 'processLogin'])->name('processLogin');
});

// Define admin path

Route::middleware(['auth', 'role:super-admin'])->prefix('/admin')->name('admin.')->group(function(){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Categories
    Route::prefix('/categories')->name('category.')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('list');
        Route::get('/add', [CategoryController::class, 'create'])->name('add');
        Route::post('/add', [CategoryController::class, 'store'])->name('processCreate');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('{category}/delete', [CategoryController::class, 'destroy'])->name('delete');
    });

    // Admin Products
    Route::prefix('/products')->name('product.')->group(function(){
        Route::get('/', [AdminProductController::class, 'index'])->name('list');
        Route::get('/add', [AdminProductController::class, 'create'])->name('add');
        Route::post('/add', [AdminProductController::class, 'store'])->name('processCreate');
        Route::delete('/{product}/delete', [AdminProductController::class, 'destroy'])->name('delete');
        Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('edit');
    });

    // Admin Attributes
    Route::prefix('/attributes')->name('attribute.')->group(function(){
        Route::get('/', [AttributeController::class, 'index'])->name('list');
        Route::post('/', [AttributeController::class, 'store'])->name('processCreate');
        Route::get('/{attr}/edit', [AttributeController::class, 'edit'])->name('edit');
        Route::put('/{attr}/update', [AttributeController::class, 'update'])->name('update');
        Route::delete('/{attr}/delete', [AttributeController::class, 'destroy'])->name('delete');
    });

    // Admin Sliders
    Route::prefix('/sliders')->name('slider.')->group(function(){
        Route::get('/', [SliderController::class, 'index'])->name('list');
        Route::post('/', [SliderController::class, 'updateSort'])->name('sort');
        Route::get('/add', [SliderController::class, 'create'])->name('add');
        Route::post('/add', [SliderController::class, 'store'])->name('processCreate');
        Route::get('/{slider}/delete', [SliderController::class, 'destroy'])->name('delete');
        Route::get('/{slider}/edit', [SliderController::class, 'edit'])->name('edit');
        Route::put('/{slider}/update', [SliderController::class, 'update'])->name('update');
    });

    // Admin Orders
    Route::prefix('/orders')->name('order.')->group(function(){
        Route::get('/', [OrderController::class, 'index'])->name('list');
        Route::get('/{order}', [OrderController::class, 'detail'])->name('detail');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('delete');
    });

    // Admin Reviews
    Route::prefix('/reviews')->name('review.')->group(function(){
        Route::get('/', [ReviewController::class, 'index'])->name('list');
        Route::get('/{id}', [ReviewController::class, 'detail'])->name('detail');
        Route::delete('/{id}/delete', [ReviewController::class, 'destroy'])->name('delete');
    });

    // Admin Users
    Route::prefix('/users')->name('user.')->group(function(){
        Route::get('/', [UserController::class, 'index'])->name('list');
        Route::get('/add', [UserController::class, 'create'])->name('add');
        Route::post('/add', [UserController::class, 'store'])->name('processCreate');
        Route::patch('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('delete');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{user}/edit', [UserController::class, 'updateRoles'])->name('updateRoles');
    });

    // Admin Post Categories
    Route::prefix('/post-categories')->name('post-category.')->group(function(){
        Route::get('/', [PostCategoryController::class, 'index'])->name('list');
        Route::get('/add', [PostCategoryController::class, 'create'])->name('add');
        Route::post('/add', [PostCategoryController::class, 'store'])->name('processCreate');
        Route::get('{id}', [PostCategoryController::class, 'edit'])->name('edit');
        Route::put('{id}', [PostCategoryController::class, 'update'])->name('update');
        Route::delete('{id}', [PostCategoryController::class, 'destroy'])->name('delete');
    });

    // Admin Posts
    Route::prefix('/posts')->name('post.')->group(function(){
        Route::get('/', [PostController::class, 'index'])->name('list');
        Route::get('/add', [PostController::class, 'create'])->name('add');
        Route::post('/add', [PostController::class, 'store'])->name('processCreate');
        Route::get('/{id}', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('delete');
    });
    
    // Roles management
    Route::prefix('/roles')->name('role.')->group(function(){
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/', [RoleController::class, 'store'])->name('processCreate');
    });

    // Admin Contact
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contact.list');

});
