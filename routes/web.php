<?php

// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController , App\Http\Controllers\PostController;


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
    return view('products/welcome');
});


Route::resource('products', productController::class);




Route::get('products', [productController::class, 'index'])->name('products.index')->middleware('auth');

// Route::delete('products/{id}', [productController::class, 'delete'])->name('products.delete');i

Route::get('products/restore/restore-all' , [productController::class, 'restoreAll'])->name('products.restore-all');

Route::patch('products/{product}/restore', [productController::class, 'restore'])->name('products.restore');

// Route::get('products/restore_all', [productController::class, 'restore_all'])->name('products.restore_all');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
