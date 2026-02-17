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
