<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminPedidoController;
use App\Http\Controllers\Admin\AdminProdutoController;
use App\Http\Controllers\Admin\AdminRarityController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', function () {
    return view('main.main');
});
Route::get('/pepe', function () {
    return view('search');
});
Route::get('/shoppingCart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/cards', [PokemonCardController::class, 'index'])->name('cards.index');;

Route::get('/fetch-cards', [PokemonCardController::class, 'fetchAndStore']);
Route::post('/custom-register', [registerController::class, 'store'])->name('custom.register');

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Usuários
    Route::resource('usuarios', AdminUserController::class);

    // Categorias
    Route::resource('collections', CollectionController::class);

    // Subcategorias
    Route::resource('rarities', AdminRarityController::class);

    // Produtos (com parâmetro correto)
    Route::resource('productos', AdminProdutoController::class)->parameters([
        'productos' => 'produto'
    ]);

    // Pedidos
    Route::resource('pedidos', AdminPedidoController::class);

    //Datos
    Route::get('/vendas', [AdminDashboardController::class, 'vendas'])->name('vendas');


});



//user
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [App\Http\Controllers\ProfileController::class, 'index'])->name('perfil.index');
    Route::match(['patch', 'put'], '/profile', [ProfileController::class, 'update'])->name('profile.update');

});


//Pago

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
Route::get('/checkout/success', function () {
    return view('checkout.success');
})->name('checkout.success');

Route::middleware('auth')->group(function () {

    Route::post('/cart/import', [CartController::class, 'import'])->name('cart.import');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/{id}', [CartController::class, 'removeItem'])->name('cart.remove');
});
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');




require __DIR__.'/auth.php';
