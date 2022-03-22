<?php

// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController , App\Http\Controllers\PostController,  App\Http\Controllers\AdminController;


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


// Route::get('/', function () {
//     return redirect()->route('login'); // return view('Auth/login');
// });


Route::resource('products', ProductController::class);




Route::get('products', [ProductController::class, 'index'])->name('products.index')->middleware('auth');

// Route::delete('products/{id}', [productController::class, 'delete'])->name('products.delete');i

Route::patch('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

Route::get('products/restore/restore-all' , [ProductController::class, 'restoreAll'])->name('products.restore-all');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'adminIndex'])->name('admin.adminIndex');