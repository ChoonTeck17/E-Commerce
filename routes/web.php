<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name(name: 'home.index');
Route::get('/shop', [ShopController::class, 'index'])->name(name: 'shop.index');
route::get('/product/{product_slug}', [ShopController::class, 'product_details'])->name('shop.product.details');

route::get('/cart', [CartController::class, 'index'])->name('cart.index');
route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::post('/cart/clear-session', [CartController::class, 'clear_session'])->name('cart.clear-session');
route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.increase-quantity');
route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease cart_quantity'])->name('cart.decrease-quantity');  
route::delete('/cart/remove/{rowId}', [CartController::class, 'empty_cart'])->name('cart.remove');
route::delete('/cart/clear', [CartController::class, 'empty_cart'])->name('cart.empty');

route::post('/wishlist/add', [WishlistController::class, 'add_to_wishlist'])->name('wishlist.add');
route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
route::delete('/wishlist/remove/{rowId}', [WishlistController::class, 'remove_from_wishlist'])->name('wishlist.remove');
route::delete('/wishlist/clear', [WishlistController::class, 'empty_wishlist'])->name('wishlist.empty');
route::post('/wishlist/move-to-cart/{rowId}', [WishlistController::class, 'move_to_cart'])->name('wishlist.move_to_cart');


Route::middleware( ['auth'])->group(function () {
Route::get('/account-dashboard', [UserController::class,'index'])->name('user.index');
});

Route::middleware( ['auth', AuthAdmin::class])->group(function () {
Route::get(uri: '/admin', action: [AdminController::class,'index'])->name('admin.index');
});

Route::middleware( ['auth', AuthAdmin::class])->group(function () {
Route::get('/admin', [AdminController::class,'index'])->name('admin.index');

Route::get('/admin/brands', [AdminController::class,'brands'])->name(name: 'admin.brands');
Route::get('/admin/brand/add', [AdminController::class,'add_brand'])->name('admin.brand.add');
Route::post('/admin/brand/store', [AdminController::class,'store_brand'])->name('admin.brand.store');
Route::get('/admin/brand/edit{id}', [AdminController::class,'edit_brand'])->name('admin.brand.edit');
Route::put('/admin/brand/update',[AdminController::class,'update_brand'])->name('admin.brand.update');
Route::delete('/admin/brand/{id}/delete',[AdminController::class,'delete_brand'])->name('admin.brand.delete');

Route::get('/admin/categories', [AdminController::class,'categories'])->name('admin.categories');
Route::get('/admin/category/add', [AdminController::class,'add_category'])->name('admin.category.add');
Route::post('/admin/category/store', [AdminController::class,'store_category'])->name('admin.category.store');
Route::get('/admin/category/edit{id}', [AdminController::class,'edit_category'])->name('admin.category.edit');
Route::put('/admin/category/update',[AdminController::class,'update_category'])->name('admin.category.update');
Route::delete('/admin/category/{id}/delete',[AdminController::class,'delete_category'])->name('admin.category.delete');

Route::get('/admin/products', [AdminController::class,'products'])->name('admin.products');
Route::get('/admin/product/add', [AdminController::class,'add_product'])->name('admin.product.add');
Route::post('/admin/product/store', [AdminController::class,'store_product'])->name('admin.product.store');
Route::get('/admin/product/{id}/edit', [AdminController::class,'edit_product'])->name('admin.product.edit');
Route::put('/admin/product/{id}',[AdminController::class,'update_product'])->name('admin.product.update');
Route::delete('/admin/product/{id}/delete',[AdminController::class,'delete_product'])->name('admin.product.delete');

route::get('admin/coupons', [AdminController::class, 'coupons'])->name('admin.coupons');
Route::get('admin/coupon/add', [AdminController::class, 'add_coupon'])->name('admin.coupon.add');
route::post('admin/coupon/store', [AdminController::class, 'store_coupon'])->name('admin.coupon.store');
route::get('admin/coupon/{id}/edit', [AdminController::class, 'edit_coupon'])->name('admin.coupon.edit');
route::put('admin/coupon/{id}', [AdminController::class, 'update_coupon'])->name('admin.coupon.update');
route::delete('admin/coupon/{id}/delete', [AdminController::class, 'delete_coupon'])->name('admin.coupon.delete');
});
    