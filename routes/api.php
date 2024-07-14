<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\BannersController;
use App\Http\Controllers\Api\PixController;
use App\Http\Controllers\Api\BilletController;
use App\Http\Controllers\Api\CreditCardController;
use App\Http\Controllers\Api\PaymentNotificatioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//B - Loja
//Categories
// Route::get('/categories/menu',[CategoriesController::class,'menu']);
// Route::get('/banners/show',[BannersController::class,'show']);

//PIX
Route::group(['prefix' => 'pix'], function () {
    Route::post('/generate-charge',[PixController::class,'generateCharge']);
    Route::get('/consult-charge/{txid}',[PixController::class,'consultCharge']);
    Route::get('/list-charges',[PixController::class, 'listCharges']);
    Route::post('/webhook',[PixController::class,'webhook']);
    Route::put("/webhook/config-webhook", [PixController::class, 'configWebhook']);
    Route::post('/webhook/pix',[PixController::class, 'pix']);
    Route::put('/{e2eid}/devolution/{id}',[PixController::class, 'devolution']);
});

//Boleto
Route::group(['prefix' => 'billet'], function () {
    Route::post('/generate-charge',[BilletController::class,'generateCharge']);
});

//Cartão de crédito
Route::group(['prefix' => 'creditCard'], function () {
    Route::post('/generate-charge',[CreditCardController::class,'generateCharge']);
});

//Notificações de Pagamento
Route::post('/efi/notification',[PaymentNotificatioController::class,'store']);