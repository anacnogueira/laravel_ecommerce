<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ContactAddressController;
use App\Http\Controllers\Admin\ContactOrderController;
use App\Http\Controllers\Admin\ContactCommentController;
use App\Http\Controllers\Admin\ContactNewsletterController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PaymentGatewayController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\WebsiteSearchController;
use App\Http\Controllers\Admin\CepSearchController;
use App\Http\Controllers\Admin\UserGroupController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\LogController;

Route::prefix('admin')->as('admin.')->group(function(){
    Route::get('/login', [LoginController::class,'login'])->name("login");
    Route::post('/login', [LoginController::class,'authenticate'])->name("authenticate");

    Route::get('/password/reset', [ForgotPasswordController::class, 'passwordReset'])->name('password.forgot');
    Route::post('/password/email', [ForgotPasswordController::class, 'passwordEmail'])->name('password.email');

    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

    Route::middleware(['auth:admin'])->group(function() {
        //1. Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [LoginController::class,'logout'])->name('logout');

        //2. Profile
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        //3. Vendas
        //3.1 Pedidos
        Route::resource('orders', OrderController::class);

        //3.2 Fretes
        Route::resource('shippings', ShippingController::class);

        //3.3 Promoções
        Route::resource('promotions', PromotionController::class);

        //3.4 Cupons
        Route::resource('coupons', CouponController::class);

        //4. Catálogo
        //4.1 Categorias
        Route::resource('categories', CategoryController::class);

        //4.2 Marcas
        Route::resource('brands', BrandController::class);

        //4.3 Fornecedores
        Route::resource('suppliers', SupplierController::class);

        //4.4 Parceiros
        Route::resource('partners', PartnerController::class);

        //4.5 Produtos
        Route::resource('products', ProductController::class);
        Route::get('products/duplicate/{id}', [ProductController::class, 'duplicate'])->name('products.duplicate');

        //4.6 Avaliações
        Route::resource('comments', CommentController::class);

        //5 Clientes
        //5.1 Clientes
        Route::resource('customers', CustomerController::class);

        //5.2 Endereços
        Route::resource('customers/{contacId}/addresses', ContactAddressController::class);

        //5.3 Pedidos
        Route::resource('customers/{contacId}/orders', ContactOrderController::class)->names('customers.orders');

        //4.4 Gerenciar Avaliações
        Route::resource('customers/{contacId}/comments', ContactCommentController::class)->names('customers.comments');

        //6 Newsletter
        Route::resource('newsletters', ContactNewsletterController::class);
        //Route::get('newsletters/export', [AdminContactNewsletterController::class, 'export'])->name("newsletters.export");

        //7. Conteúdo
        //7.1 Páginas
        Route::resource('pages', PageController::class);

        //7.2 Banners
        Route::resource('banners', BannerController::class);

        //7.3 Integradoras de pagamento
        Route::resource('payment-gateways', PaymentGatewayController::class);

        //7.4 Formas de pagamento
        Route::resource('payment-methods', PaymentMethodController::class);

        //7.5 Status do Pedido
        Route::resource('order-status', OrderStatusController::class);

        //7.7 Perguntas Frequentes
        Route::resource('faqs', FaqController::class);

        //7.7 Países
        Route::resource('countries', CountryController::class);

        //7.8 Estados
        Route::resource('states', StateController::class);

        //7.9 Cidades
        Route::resource('cities', CityController::class);

        //7.10 Eventos
        Route::resource('events', EventController::class);

        //8. Relatórios
        //8.1 Pesquisas no site
        Route::get("website-searches",[WebsiteSearchController::class,'index'])->name("website-search.index");

         //8.2 Pesquisas de CEP
        Route::get("cep-searches",[CepSearchController::class,'index'])->name("cep-search.index");

        //9. Sistema
        //9.1 Grupos
        Route::resource('user-groups', UserGroupController::class);

        //9.2 Usuários
        Route::resource('users', UserController::class);

        //9.3 Módulos
        Route::resource('modules', ModuleController::class);

        //9.4 Rotinas
        Route::resource('routines', RoutineController::class);

        //9.5 Logs
        Route::get('logs', [LogController::class, 'index'])->name("logs.index");
        Route::get('logs/search', [LogController::class, 'search'])->name("logs.search");
        Route::get('logs/{id}', [LogController::class, 'show'])->name("logs.show");
    });

});
