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
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ShippingController as AdminShippingController;
use App\Http\Controllers\Admin\PromotionController as AdminPromotionController;
use App\Http\Controllers\Admin\CouponController as AdminCouponController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ContactAddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CartController;

//1. ADMIN
Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login', [AdminLoginController::class,'login'])->name("login");
    Route::post('/login', [AdminLoginController::class,'authenticate'])->name("authenticate");
    Route::get('/password/reset', [AdminForgotPasswordController::class, 'passwordReset'])->name('password.forgot');
    Route::post('/password/email', [AdminForgotPasswordController::class, 'passwordEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [AdminResetPasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/password/reset', [AdminResetPasswordController::class, 'updatePassword'])->name('password.update');

    Route::middleware(['auth:admin'])->group(function() {
        //1. Dashboard
        Route::get('/', [AdminDashboardController::class, 'index']);
        Route::post('/logout', [AdminLoginController::class,'logout'])->name('logout');

        //2. Profile
        Route::get('profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('profile.update');

        //3. Vendas
        //3.1 Pedidos
        Route::resource('orders', AdminOrderController::class);

        //3.2 Fretes
        Route::resource('shippings', AdminShippingController::class);

        //3.3 Promoções
        Route::resource('promotions', AdminPromotionController::class);

        //3.4 Cupons
        Route::resource('coupons', AdminCouponController::class);

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

// 2.3 FAQ
Route::get('/faq', [FaqController::class,'index'])->name('faq.index');

//3. Minha Sacola
Route::get('/minha-sacola',[CartController::class,'show'])->name('cart.show');
Route::put('/cart-update',[CartController::class,'update'])->name('cart.update');
Route::delete('/cart-delete/{id}',[CartController::class,'destroy'])->name('cart.destroy');

//4. Cadastro
Route::get('/cadastro', [CustomerController::class,'create'])->name('register');
Route::post('/cadastro', [CustomerController::class,'store'])->name('register.store');
Route::get('/confirma-cadastro', [CustomerController::class,'confirm'])->name('register.confirm-store');
Route::post('/verifica-cadastro', [CustomerController::class,'verify'])->name('register.verify');

//5. Login
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'authenticate'])->name('login.authenticate');
Route::get('/esqueci-minha-senha', [ForgotPasswordController::class, 'passwordReset'])->name('password.forgot');
Route::post('/password/email', [ForgotPasswordController::class, 'passwordEmail'])->name('password.email');
Route::get('/resetar-senha/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'updatePassword'])->name('password.update');

// Área Autenticada
Route::middleware(['auth'])->group(function() {
    // Logout
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');

    //1. Pedidos
    Route::get('/meus-pedidos/{filter?}', [OrderController::class,'index'])->name('orders.index');
    Route::get('/pedido/{id}', [OrderController::class,'show'])->name('orders.show');

    //2. Minha Conta
    Route::get('/minha-conta', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/minha-conta/alterar-email', [CustomerController::class, 'editEmail'])->name("customers.edit-email");
    Route::put('/minha-conta/alterar-email', [CustomerController::class, 'updateEmail'])->name("customers.update-email");
    Route::get('/minha-conta/alterar-senha', [CustomerController::class,'editPassword'])->name("customers.edit-password");
    Route::put('/minha-conta/alterar-senha', [CustomerController::class,'updatePassword'])->name("customers.update-password");
    Route::get('/minha-conta/alterar-dados-cadastrais', [CustomerController::class,'edit'])->name('customers.edit');
    Route::put('/minha-conta/alterar-dados-cadastrais', [CustomerController::class,'update'])->name('customers.update');
    Route::get('/minha-conta/email-ofertas', [CustomerController::class,"editEmailNewsletter"])->name("customers.edit-email-newsletter");
    Route::put('/minha-conta/email-ofertas', [CustomerController::class,"updateEmailNewsletter"])->name("customers.update-email-newsletter");

    //3. Meus Endereços
    Route::prefix('/minha-conta/meus-enderecos')->name('customers.addresses.')->group(function(){
        Route::get('/', [ContactAddressController::class,'index'])->name("index");
        Route::get('/cadastrar', [ContactAddressController::class,'create'])->name("create");
        Route::post('/cadastrar', [ContactAddressController::class,'store'])->name("store");
        Route::get('/editar/{id}', [ContactAddressController::class,'edit'])->name("edit");
        Route::put('/editar/{id}', [ContactAddressController::class,'update'])->name("update");
        Route::delete('/excluir/{id}', [ContactAddressController::class,'destroy'])->name("destroy");
    });

    //4. Meus Produtos Favoritos
    Route::get('/meus-favoritos', [FavoriteController::class,'index'])->name('customer.products.favorite');
    Route::post('/favoritar-produto', [FavoriteController::class,'store'])->name('customer.products.favorite.store');
});
