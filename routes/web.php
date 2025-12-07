<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
//Route::get('/', \App\Livewire\Items\Index::class)->name('items.index');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
    Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');




    Route::prefix('dashboard')->group(function () {

        Route::get('/', function () { return view('dashboard'); })->name('dashboard');

        Route::get('/items',[\App\Http\Controllers\ItemController::class,'index'])->name('items.index');
        Route::get('/items/create',[\App\Http\Controllers\ItemController::class,'create'])->name('items.create');
        Route::get('/items/{item}/edit', [\App\Http\Controllers\ItemController::class,'edit'])->name('items.edit');


    });

});

Route::get('/item/show/{item}', [\App\Http\Controllers\ItemController::class,'show'])->name('items.show');

require __DIR__.'/auth.php';
