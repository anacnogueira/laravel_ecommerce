<?php

use Illuminate\Support\Facades\Route;

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
    //1. Logout
    Route::post('/logout', [LoginController::class,'logout'])->name('logout');

    //2. Checkout
    Route::get('/checkout', [OrderController::class,'checkout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class,'store'])->name('orders.store');

    //3. Pedidos
    Route::get('/meus-pedidos/{filter?}', [OrderController::class,'index'])->name('orders.index');
    Route::get('/pedido/{id}', [OrderController::class,'show'])->name('orders.show');

    //4. Minha Conta
    Route::get('/minha-conta', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/minha-conta/alterar-email', [CustomerController::class, 'editEmail'])->name("customers.edit-email");
    Route::put('/minha-conta/alterar-email', [CustomerController::class, 'updateEmail'])->name("customers.update-email");
    Route::get('/minha-conta/alterar-senha', [CustomerController::class,'editPassword'])->name("customers.edit-password");
    Route::put('/minha-conta/alterar-senha', [CustomerController::class,'updatePassword'])->name("customers.update-password");
    Route::get('/minha-conta/alterar-dados-cadastrais', [CustomerController::class,'edit'])->name('customers.edit');
    Route::put('/minha-conta/alterar-dados-cadastrais', [CustomerController::class,'update'])->name('customers.update');
    Route::get('/minha-conta/email-ofertas', [CustomerController::class,"editEmailNewsletter"])->name("customers.edit-email-newsletter");
    Route::put('/minha-conta/email-ofertas', [CustomerController::class,"updateEmailNewsletter"])->name("customers.update-email-newsletter");

    //4. Meus Endereços
    Route::prefix('/minha-conta/meus-enderecos')->name('customers.addresses.')->group(function(){
        Route::get('/', [ContactAddressController::class,'index'])->name("index");
        Route::get('/cadastrar', [ContactAddressController::class,'create'])->name("create");
        Route::post('/cadastrar', [ContactAddressController::class,'store'])->name("store");
        Route::get('/editar/{id}', [ContactAddressController::class,'edit'])->name("edit");
        Route::put('/editar/{id}', [ContactAddressController::class,'update'])->name("update");
        Route::delete('/excluir/{id}', [ContactAddressController::class,'destroy'])->name("destroy");
    });

    //6. Meus Produtos Favoritos
    Route::get('/meus-favoritos', [FavoriteController::class,'index'])->name('customer.products.favorite');
    Route::post('/favoritar-produto', [FavoriteController::class,'store'])->name('customer.products.favorite.store');
});
