<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocktailController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('cocktails.index')
        : view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cocktails', [CocktailController::class, 'index'])
        ->name('cocktails.index');
    Route::get('/cocktails/saved', [CocktailController::class, 'saved'])
        ->name('cocktails.saved');
    Route::delete('/cocktails/{cocktail}', [CocktailController::class, 'destroy'])
        ->name('cocktails.destroy');
    Route::get('/cocktails/{cocktail}/edit', [CocktailController::class, 'edit'])
        ->name('cocktails.edit');
    Route::put('/cocktails/{cocktail}', [CocktailController::class, 'update'])
        ->name('cocktails.update');
});

Route::post('/cocktails', [CocktailController::class, 'store'])
    ->name('cocktails.store')
    ->middleware('auth');

Route::get('/dashboard', [CocktailController::class, 'dashboard'])
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__.'/auth.php';
