<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ImageController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    //Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('usuarios', UsuarioController::class);

    //  Rutas de la API 
    Route::get('imagenes', [ImageController::class, 'index'])->name('imagenes.index');
    Route::get('imagenes/{id}/detail-images', [ImageController::class, 'show'])->name('imagenes.detail');
    Route::post('imagenes/search', [ImageController::class, 'search'])->name('imagenes.search');
    Route::get('imagenes/{category}/category', [ImageController::class, 'category'])->name('imagenes.category');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
