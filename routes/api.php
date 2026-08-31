<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\StatusController as AdminStatusController;
use App\Http\Controllers\Api\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Api\Admin\CouponController as AdminCouponController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ProductNotificationController;
use App\Http\Controllers\Api\ContactNewsletterController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\ContactAddressController;
use App\Http\Controllers\Api\BuyerInformationController;
use App\Http\Controllers\Api\PixController;
use App\Http\Controllers\Api\CouponController;

// A - ADMIN
Route::prefix('admin')->name('admin.')->group(function(){
    // 1- Status items
    Route::post('/status-change',[AdminStatusController::class,'change']);

    //Show Product Details
    Route::get('/products/{id}',[AdminProductController::class,'show']);

    //Generate Coupon Code
    Route::get('coupons/generate-code',[AdminCouponController::class, 'generateCode']);
});

Route::get('/cities/{stateId}',[CityController::class,'citiesByState']);
Route::post('/product-notification',[ProductNotificationController::class,'store']);
Route::post('/newsletters',[ContactNewsletterController::class,'store'])->name("newsletters");
Route::post('/shippings/calculate',[ShippingController::class,'calculate'])->name("shippings.calculate");
Route::post('/comments/rate',[CommentController::class,'rate'])->name("comments.rate");
Route::post('/comments/store',[CommentController::class,'store'])->name("comments.store");
Route::get('/carts/show-cart', [CartController::class,'showCart'])->name('carts.show-cart');
Route::get('/addresses/set-order-default/{addressId}', [ContactAddressController::class,'setOrderDefaultAddress'])->name('addresses.set-order-default');

Route::apiResource('/carts',CartController::class);

Route::get('customers/get-buyer-information', BuyerInformationController::class)->name('customers.get-buyer-information');
Route::get('pix/confirm-payment/{order}', [PixController::class,'confirmPayment'])->name('pix.confirm-payment');
Route::post('/coupons/apply', [CouponController::class, 'apply'])->name('coupons.apply');

