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
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\ContactAddressController as AdminContactAddressController;
use App\Http\Controllers\Admin\ContactOrderController as AdminContactOrderController;
use App\Http\Controllers\Admin\ContactCommentController as AdminContactCommentController;
use App\Http\Controllers\Admin\ContactNewsletterController as AdminContactNewsletterController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CustomerController;

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

        //3. Vendas
        Route::resource('orders', AdminOrderController::class);

        //4. Catálogo
        //4.1 Categorias
        Route::resource('categories', AdminCategoryController::class);

        //4.2 Marcas
        Route::resource('brands', AdminBrandController::class);

        //4.3 Fornecedores
        Route::resource('suppliers', AdminSupplierController::class);

        //4.4 Parceiros
        Route::resource('partners', AdminPartnerController::class);

        //4.5 Produtos
        Route::resource('products', AdminProductController::class);
        Route::get('products/duplicate/{id}', [AdminProductController::class, 'duplicate'])->name('products.duplicate');

        //4.6 Avaliações
        Route::resource('comments', AdminCommentController::class);

        //5 Clientes
        //5.1 Clientes
        Route::resource('customers', AdminCustomerController::class);
        //5.2 Endereços
        Route::resource('customers/{contacId}/addresses', AdminContactAddressController::class);
        //5.3 Pedidos
        Route::resource('customers/{contacId}/orders', AdminContactOrderController::class)->names('customers.orders');
        //4.4 Gerenciar Avaliações
        Route::resource('customers/{contacId}/comments', AdminContactCommentController::class)->names('customers.comments');

        //6 Newsletter
        Route::resource('newsletters', AdminContactNewsletterController::class);
        Route::get('newsletters/export', [AdminContactNewsletterController::class, 'export'])->name("newsletters.export");

        //7. Conteúdo
        //7.1 Páginas
        Route::resource('pages', AdminPageController::class);
        //7.2 Banners
        Route::resource('banners', AdminBannerController::class);
        //7.3 Integradoras de pagamento
        Route::resource('payment-gateways', AdminPaymentGatewayController::class);
        //7.4 Formas de pagamento
        Route::resource('payment-methods', AdminPaymentMethodController::class);
        //7.5 Status do Pedido
        Route::resource('order-status', AdminOrderStatusController::class);
        //7.7 Perguntas Frequentes
        Route::resource('faqs', AdminFaqController::class);
        //7.7 Países
        Route::resource('countries', AdminCountryController::class);
        //7.8 Estados
        Route::resource('states', AdminStateController::class);
        //7.9 Cidades
        Route::resource('cities', AdminCityController::class);
        //7.10 Eventos
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
Route::get('/cadastro', [CustomerController::class,'create'])->name('register');
Route::post('/cadastro', [CustomerController::class,'store'])->name('register.store');
Route::get('/confirma-cadastro', [CustomerController::class,'confirm'])->name('register.confirm-store');

// Login
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'authenticate'])->name('login.authenticate');
Route::get('/esqueci-minha-senha', [ForgotPasswordController::class, 'passwordReset'])->name('password.forgot');
Route::post('/password/email', [ForgotPasswordController::class, 'passwordEmail'])->name('password.email');
Route::get('/resetar-senha/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'updatePassword'])->name('password.update');


Route::middleware(['auth'])->group(function() {
    Route::get('/meus-pedidos/{filter?}', function($filter = null) {
        $type = null;
        if ($filter) {
            $filters = explode(":", $filter);
            $type = $filters[1];
        }

        switch ($type) {
            case 'ultimos':
                $title = "Últimos pedidos";
                break;
            case 'abertos':
                $title = "Pedidos Abertos";
                break;
            case 'entregues':
                $title = "Pedidos Entregues";
                break;
            case "numero":
                $title = "Pedidos por número";
                break;
            case "data":
                $title = "Pedidos por data";
                break;
            default:
                $title = "Todos os pedidos";
        }

        return view('maintenance', compact('title'));
    })->name('orders.index');

    Route::get('/minha-conta', function(){
        $title = "Minha Conta";
        return view('maintenance', compact('title'));
    })->name('customer.index');

    Route::get('/minha-conta/alterar-email', function(){
        $title = "Alterar e-mail";
        return view('maintenance', compact('title'));
    });

    Route::get('/minha-conta/alterar-senha', function(){
        $title = "Alterar Senha";
        return view('maintenance', compact('title'));
    });

    Route::get('/minha-conta/alterar-dados-cadastrais', function(){
        $title = "Alterar Dados";
        return view('maintenance', compact('title'));
    });

    Route::get('/minha-conta/email-ofertas', function(){
        $title = "E-mail de ofertas";
        return view('maintenance', compact('title'));
    });

    Route::get('/minha-conta/meus-enderecos', function(){
        $title = "Meus Endereços";
        return view('maintenance', compact('title'));
    });

     Route::get('/meus-favoritos', function(){
        $title = "Meus Favoritos";
        return view('maintenance', compact('title'));
    })->name('customer.products.favorite');


    // Logout
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');
});
