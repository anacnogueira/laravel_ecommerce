<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\StatusController as AdminStatusController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\ProductNotificationController;
use App\Http\Controllers\Api\ContactNewsletterController;

// A - ADMIN
Route::prefix('admin')->name('admin.')->group(function(){
    // 1- Status items
    Route::post('/status-change',[AdminStatusController::class,'change']);
});

Route::get('/cities/{stateId}',[CityController::class,'citiesByState']);
Route::post('/product-notification',[ProductNotificationController::class,'store']);
Route::post('/newsletters',[ContactNewsletterController::class,'store'])->name("newsletters");
