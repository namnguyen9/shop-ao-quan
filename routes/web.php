<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\BrandController; 
use App\Http\Controllers\ProductController; 
use App\Http\Controllers\CartController; 
use App\Http\Controllers\PhotoLibraryController; 
use App\Http\Controllers\CheckoutController; 
use App\Http\Controllers\ShippingController; 
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\FavoriteProductController; 
use App\Http\Controllers\FacebookController; 
use App\Http\Controllers\GoogleController; 
use App\Http\Controllers\SeoMetaCategoryController; 
use App\Http\Controllers\SeoMetaBrandController; 

use App\Http\Middleware\CheckForValidUsers;
use App\Http\Middleware\CheckForValidAdmin;



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
//FrontEnd
    Route::get('', [HomeController::class, 'index'])->name('index');
    Route::get('/trang-chu', [HomeController::class, 'index'])->name('trang-chu');
    Route::get('/trang-chu/json-data', [HomeController::class, 'json_data']);
    Route::post('/trang-chu/search', [HomeController::class, 'search']);

//Checkout
Route::prefix('checkout')->group(function () {
    Route::middleware([CheckForValidUsers::class])->group(function () {
        Route::get('', [CheckoutController::class, 'index']);
        Route::get('/hand-cash', [CheckoutController::class, 'hand_cash']);
        Route::get('/online-payment', [CheckoutController::class, 'online_payment']);
        Route::post('/order-place', [CheckoutController::class, 'order_place']);
    });
});

Route::prefix('shipping')->group(function () {
    Route::middleware([CheckForValidUsers::class])->group(function () {
        Route::post('/create', [ShippingController::class, 'create']);
        Route::get('/get-byId', [ShippingController::class, 'get_byId']);
        Route::get('/details/{id}', [ShippingController::class, 'get_details']);
        Route::get('/data', [ShippingController::class, 'provinces_and_cities']);
        Route::post('/update/{id}', [ShippingController::class, 'update']);
        Route::delete('/delete/{id}', [ShippingController::class, 'delete']);
    });
});


Route::prefix('user')->group(function () {
    Route::get('/login', [CheckoutController::class, 'user_login'])->name('login');
    Route::get('/sign-up', [CheckoutController::class, 'sign_up']);
    Route::get('/logout', [CheckoutController::class, 'logout']);  
    Route::post('/sign-up', [CheckoutController::class, 'new_user_signup']);
    Route::post('/login', [CheckoutController::class, 'login']);

    Route::middleware([CheckForValidUsers::class])->group(function () {
        Route::get('/profile',[UserController::class, 'profile']);
        Route::get('/show',[UserController::class, 'show']);
        Route::post('/update',[UserController::class, 'update']);
        Route::post('/update-password',[UserController::class, 'update_password']);
    });
    Route::middleware([CheckForValidAdmin::class])->group(function () {
        Route::get('/data',[UserController::class, 'getData']);
        Route::get('/dashboard',[UserController::class, 'index']);
        Route::delete('/delete/{id}',[UserController::class, 'delete']);
        Route::post('/delete-multiple',[UserController::class, 'delete_multiple']);

    });

});
//Danh mục sản phẩm trang chủ
Route::prefix('cart')->group(function () {
    Route::get('', [CartController::class, 'index']);
    Route::get('/show', [CartController::class, 'show']);
    Route::middleware([CheckForValidUsers::class])->group(function () {
        Route::get('/total', [CartController::class, 'show_total_cart']);
        Route::post('/save', [CartController::class, 'save']);
        Route::post('/quantity-up/{rowId}', [CartController::class, 'cart_quantity_up']);
        Route::post('/quantity-down/{rowId}', [CartController::class, 'cart_quantity_down']);
        Route::post('/update-qty/{rowId}', [CartController::class, 'cart_update_qty']);
        Route::delete('/delete/{rowId}', [CartController::class, 'delete']);
    });
}); 


//BackEnd
//Admin
Route::middleware([CheckForValidAdmin::class])->group(function () {
    Route::get('/dashboard',[AdminController::class, 'index']);
    Route::get('/logout',[AdminController::class, 'logout'])->name('admin.logout');
});
//Category_Product
Route::prefix('category-product')->group(function () {
    Route::get('/json-data',[CategoryController::class, 'getData']);
    Route::get('/home/{id}', [CategoryController::class, 'show_category_home']);

    Route::middleware([CheckForValidAdmin::class])->group(function () {
        Route::get('/dashboard',[CategoryController::class, 'index']);
        Route::get('/{id}',[CategoryController::class, 'edit']);
        Route::post('/delete-multiple',[CategoryController::class, 'delete_multiple']);
        Route::post('/create',[CategoryController::class, 'create']);
        Route::put('/{id}',[CategoryController::class, 'update']);
        Route::put('/hide-category/{id}',[CategoryController::class, 'hide_category']);
        Route::put('/show-category/{id}',[CategoryController::class, 'show_category']);
        Route::delete('/{id}',[CategoryController::class, 'destroy']);
        //seo meta
        Route::get('/data-seo-meta/{id}',[SeoMetaCategoryController::class, 'getMetaById']);
        Route::get('/get-detail/{id}',[SeoMetaCategoryController::class, 'getDetail']);
        Route::post('/save-seo-meta',[SeoMetaCategoryController::class, 'create']);
        Route::put('/update-seo-meta/{id}',[SeoMetaCategoryController::class, 'update']);
        Route::delete('/delete-seo-meta/{id}',[SeoMetaCategoryController::class, 'delete']);

    });
});


Route::prefix('brand-product')->group(function () {
    Route::get('/json-data',[BrandController::class, 'getData']);
    Route::get('/home/{id}', [BrandController::class, 'show_brand_home']);

    Route::middleware([CheckForValidAdmin::class])->group(function () {
        Route::get('/dashboard',[BrandController::class, 'index']);
        Route::get('/{id}',[BrandController::class, 'edit']);
        Route::post('/delete-multiple',[BrandController::class, 'delete_multiple']);
        Route::post('/create',[BrandController::class, 'create']);
        Route::put('/{id}',[BrandController::class, 'update']);
        Route::put('/hide-brand/{id}',[BrandController::class, 'hide_brand']);
        Route::put('/show-brand/{id}',[BrandController::class, 'show_brand']);
        Route::delete('/{id}',[BrandController::class, 'destroy']);
        //seo meta
        Route::get('/data-seo-meta/{id}',[SeoMetaBrandController::class, 'getMetaById']);
        Route::get('/get-detail/{id}',[SeoMetaBrandController::class, 'getDetail']);
        Route::post('/save-seo-meta',[SeoMetaBrandController::class, 'create']);
        Route::put('/update-seo-meta/{id}',[SeoMetaBrandController::class, 'update']);
        Route::delete('/delete-seo-meta/{id}',[SeoMetaBrandController::class, 'delete']);
    
    });
});


Route::prefix('product')->group(function () {
    Route::get('/suggestions/{id}',[ProductController::class, 'get_product_suggestions']);
    Route::get('/detail/{id}',[ProductController::class, 'show_detail']);

    Route::middleware([CheckForValidAdmin::class])->group(function () {
        Route::get('/json-data',[ProductController::class, 'getData']);
        Route::get('/dashboard',[ProductController::class, 'index']);
        Route::get('/images/{id}',[PhotoLibraryController::class, 'getById_image']);
        Route::get('/{id}',[ProductController::class, 'edit']);
        Route::post('/create',[ProductController::class, 'create']);
        Route::post('/delete-multiple',[ProductController::class, 'delete_multiple']);
        Route::post('/{id}',[ProductController::class, 'update']);
        Route::put('/hide-product/{id}',[ProductController::class, 'hide_product']);
        Route::put('/show-product/{id}',[ProductController::class, 'show_product']);
        Route::delete('/{id}',[ProductController::class, 'destroy']);
    });

    Route::middleware([CheckForValidUsers::class])->group(function () {
        Route::post('/favorite/{id}',[FavoriteProductController::class, 'create']);
        Route::get('/favorite/getAll',[FavoriteProductController::class, 'getById']);
        Route::delete('/favorite/delete/{id}',[FavoriteProductController::class, 'delete']);
        Route::delete('/favorite/delete-multiple',[FavoriteProductController::class, 'delete_multiple']);
        
    });
});

Route::prefix('library')->group(function () {
    Route::middleware([CheckForValidAdmin::class])->group(function () {
        Route::get('/{id}',[PhotoLibraryController::class, 'getById_image']);
        Route::post('/create/{id}',[PhotoLibraryController::class, 'create']);
        Route::post('/update-name/{id}',[PhotoLibraryController::class, 'update_name']);
        Route::post('/update-file/{id}',[PhotoLibraryController::class, 'update_file']);
        Route::post('/delete-multiple',[PhotoLibraryController::class, 'delete_multiple']);
        Route::delete('/destroy/{id}',[PhotoLibraryController::class, 'destroy']);
    });
});


Route::prefix('order')->group(function () {
    Route::middleware([CheckForValidUsers::class])->group(function () {
        Route::get('/get-byId',[OrderController::class, 'get_order_byId']);
        Route::delete('/delete/{id}',[OrderController::class, 'delete_order_details']); 
        Route::delete('/delete-multiple',[OrderController::class, 'delete_multiple']);
    });
    Route::middleware([CheckForValidAdmin::class])->group(function () {
        Route::get('/json-data',[OrderController::class, 'getData']);
        Route::get('/dashboard',[OrderController::class, 'index']);
        Route::get('/details/{id}',[OrderController::class, 'view_order']);    
        Route::delete('/destroy/{id}',[OrderController::class, 'destroy']);
        Route::post('/delete-multiple',[OrderController::class, 'delete_multiple_order']);
    });
});


Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'facebookSignin']);


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'googleSignin']);

?>
