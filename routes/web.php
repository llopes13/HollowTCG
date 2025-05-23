<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;
use App\Http\Controllers\registerController;
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
Route::get('/cards', [PokemonCardController::class, 'index']);

Route::get('/fetch-cards', [PokemonCardController::class, 'fetchAndStore']);
Route::post('/custom-register', [registerController::class, 'store'])->name('custom.register');


require __DIR__.'/auth.php';
