<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\StateController as AdminStateController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PaymentGatewayController as AdminPaymentGatewayController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;

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
    //1. Dashboard
    Route::get('/', [AdminDashboardController::class, 'index']);
    //2. Vendas
    //3. Catálogo
    //3.1 Categorias
    Route::resource('categories', AdminCategoryController::class);
    //3.2 Marcas
    Route::resource('brands', AdminBrandController::class);

    //6. Conteúdo
    //6.1 Páginas
    Route::resource('pages', AdminPageController::class);
    //6.2 Banners
    Route::resource('banners', AdminBannerController::class);
    //6.3 Eventos
    Route::resource('events', AdminEventController::class);
    //6.4 Integradoras de pagamento
    Route::resource('payment-gateways', AdminPaymentGatewayController::class);
    //6.5 Formas de pagamento
    Route::resource('payment-methods', AdminPaymentMethodController::class);
    //6.6 Países
    Route::resource('countries', AdminCountryController::class);
    //6.7 Estados
    Route::resource('states', AdminStateController::class);
    //6.8 Cidades
    Route::resource('cities', AdminCityController::class);
    //7. Ferramentas
    //8. Relatórios
    //9. Sistema  
});

//2. SITE
Auth::routes();
//2.1 Banners
Route::get('/banners', [App\Http\Controllers\BannerController::class, 'index'])->name('banner.index');

//2.2 Brands
Route::get('/marcas', [App\Http\Controllers\BrandController::class, 'index'])->name('brand.index');
Route::get('/marca/{permalink}', [App\Http\Controllers\BrandController::class, 'show'])->name('brand.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
