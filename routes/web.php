<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController as AdminResetPasswordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\SupplierController as AdminSupplierController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\PaymentGatewayController as AdminPaymentGatewayController;
use App\Http\Controllers\Admin\PaymentMethodController as AdminPaymentMethodController;
use App\Http\Controllers\Admin\OrderStatusController as AdminOrderStatusController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\StateController as AdminStateController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\WebsiteSearchController as AdminWebsiteSearchController;
use App\Http\Controllers\Admin\CepSearchController as AdminCepSearchController;
use App\Http\Controllers\Admin\UserGroupController as AdminUserGroupController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ModuleController as AdminModuleController;
use App\Http\Controllers\Admin\RoutineController as AdminRoutineController;
use App\Http\Controllers\Admin\LogController as AdminLogController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FaqController;

//1. ADMIN
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [AdminLoginController::class,'login'])->name("login");
    Route::post('/login', [AdminLoginController::class,'authenticate'])->name("authenticate");
    Route::get('/password/reset', [AdminForgotPasswordController::class, 'passwordReset'])->name('password.forgot');
    Route::post('/password/email', [AdminForgotPasswordController::class, 'passwordEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/reset', [AdminResetPassordController::class, 'updatePassword'])->name('password.update');

    Route::middleware(['auth:admin'])->group(function() {
        //1. Dashboard
        Route::get('/', [AdminDashboardController::class, 'index']);
        Route::post('/logout', [AdminLoginController::class,'logout'])->name('logout');

        //2. Profile
        Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');

        //3. Catálogo
        //3.1 Categorias
        Route::resource('categories', AdminCategoryController::class);

        //3.2 Marcas
        Route::resource('brands', AdminBrandController::class);

        //3.3 Fornecedores
        Route::resource('suppliers', AdminSupplierController::class);

        //3.3 Parceiros
        Route::resource('partners', AdminPartnerController::class);

        //3.3 Produtos
        Route::resource('products', AdminProductController::class);
        Route::get('products/duplicate/{id}', [AdminProductController::class, 'duplicate'])->name('products.duplicate');

        //3.4
        Route::resource('comments', AdminCommentController::class);

        //6. Conteúdo
        //6.1 Páginas
        Route::resource('pages', AdminPageController::class);
        //6.2 Banners
        Route::resource('banners', AdminBannerController::class);
        //6.3 Integradoras de pagamento
        Route::resource('payment-gateways', AdminPaymentGatewayController::class);
        //6.4 Formas de pagamento
        Route::resource('payment-methods', AdminPaymentMethodController::class);
        //6.5 Status do Pedido
        Route::resource('order-status', AdminOrderStatusController::class);
        //6.6 Perguntas Frequentes
        Route::resource('faqs', AdminFaqController::class);
        //6.7 Países
        Route::resource('countries', AdminCountryController::class);
        //6.8 Estados
        Route::resource('states', AdminStateController::class);
        //6.9 Cidades
        Route::resource('cities', AdminCityController::class);
        //6.10 Eventos
        Route::resource('events', AdminEventController::class);

        //8. Relatórios
        //8.1 Pesquisas no site
        Route::get("website-searches",[AdminWebsiteSearchController::class,'index'])->name("website-search.index");
         //8.2 Pesquisas de CEP
        Route::get("cep-searches",[AdminCepSearchController::class,'index'])->name("cep-search.index");

        //9. Sistema
        //9.1 Grupos
        Route::resource('user-groups', AdminUserGroupController::class);
        //9.2 Usuários
        Route::resource('users', AdminUserController::class);
        //9.3 Módulos
        Route::resource('modules', AdminModuleController::class);
        //9.4 Rotinas
        Route::resource('routines', AdminRoutineController::class);
        //9.5 Logs
        Route::get('logs', [AdminLogController::class, 'index'])->name("logs.index");
        Route::get('logs/search', [AdminLogController::class, 'search'])->name("logs.search");
        Route::get('logs/{id}', [AdminLogController::class, 'show'])->name("logs.show");

    });

});

//2. SITE
Route::get('/', [ProductController::class,'index'])->name('index');

//2.1 Pages
Route::get('/contato', [PagesController::class,'contact'])->name('pages.contact');
Route::post('/send-contact', [PagesController::class,'sendContact'])->name('pages.send-contact');
Route::get('/contato-formulario-enviado', [PagesController::class,'contactSent'])->name('pages.contact-sent');
Route::get('/mapa-site', [PagesController::class,'sitemap'])->name('pages.sitemap');
Route::get('/sobre', [PagesController::class, 'show'])->defaults('permalink', 'quem-somos');
Route::get('/pagina/{permalink}', [PagesController::class,'show'])->name('pages.show');

//2.2 Produtos,Categorias  e Marcas */
Route::post('/busca', [ProductController::class,'search'])->name('products.search');
Route::get('/resultado-busca/{keyword}', [ProductController::class,'result'])->name('products.result');
Route::get('/categorias/{permalink}', [ProductController::class, 'categories'])
    ->where('permalink', '.*')
    ->name('product.categories');
Route::get('/novidades', [ProductController::class,'news'])->name('products.news');
Route::get('/item/{categoriesAndSlug}', [ProductController::class, 'show'])
    ->where('categoriesAndSlug', '.*')
    ->name('product.show');

Route::get('/marcas', [BrandController::class, 'index'])->name('brand.index');
Route::get('/marca/{permalink}', [BrandController::class, 'show'])->name('brand.show');


// 2.3FAQ
Route::get('/faq', [FaqController::class,'index'])->name('faq.index');

// Minha Sacola
Route::get('/minha-sacola', function(){
    $title = "Minha Sacola";
    return view('maintenance', compact('title'));
});

// Cadastro
Route::get('/cadastro', function(){
    $title = "Cadastro";
    return view('maintenance', compact('title'));
});

// Cadastro
Route::get('/login', function(){
    $title = "Login";
    return view('maintenance', compact('title'));
});
