<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/add',  [App\Http\Controllers\ControllerFavoritos::class, 'add'])->name('add');
Route::get('/categorias',  [App\Http\Controllers\ControllerCategorias::class, 'Categorias'])->name('Categorias');
Route::POST('/addForm',  [App\Http\Controllers\ControllerFavoritos::class, 'addFavorito']);
Route::POST('/addCat',  [App\Http\Controllers\ControllerCategorias::class, 'addCategoria']);
Route::POST('/getCat',  [App\Http\Controllers\ControllerCategorias::class, 'getCat']);
Route::POST('/editCat',  [App\Http\Controllers\ControllerCategorias::class, 'editCat']);
Route::POST('/updateCat',  [App\Http\Controllers\ControllerCategorias::class, 'updateCat']);
Route::POST('/deletecat',  [App\Http\Controllers\ControllerCategorias::class, 'deletecat']);
Route::POST('/publico',  [App\Http\Controllers\ControllerCategorias::class, 'publico']);
Route::POST('/privado',  [App\Http\Controllers\ControllerCategorias::class, 'privado']);
Route::get('/verfav',  [App\Http\Controllers\ControllerFavoritos::class, 'verfav'])->name('VerFavorito');
Route::POST('/editForm',  [App\Http\Controllers\ControllerFavoritos::class, 'editForm']);
