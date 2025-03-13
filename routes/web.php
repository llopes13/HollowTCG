<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonCardController;

Route::get('/', function () {
    return view('main.main');
});
Route::get('/pepe', function () {
    return view('search');
});
Route::get('/login', function () {
    return view('auth.login') ;
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/cards', [PokemonCardController::class, 'index']);

Route::get('/fetch-cards', [PokemonCardController::class, 'fetchAndStore']);