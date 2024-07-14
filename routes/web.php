<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;

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

Route::get('/', function () {
    return view('welcome');
});


//1. ADMIN
Route::prefix('admin')->name('admin.')->group(function(){
    //1.1 Banners
    Route::resource('banners', AdminBannerController::class);
});

//2. SITE
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
