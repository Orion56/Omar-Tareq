<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


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
Route::get('dashboard', [DashboardController::class, 'index'])->name('dash');
Route::get('dashboard/products', [ProductController::class, 'index'])->name('dash.products');
Route::get('dashboard/products/create', [ProductController::class, 'create'])->name('dash.products.create');
Route::get('dashboard/products/edit/{id}', [ProductController::class, 'edit'])->name('dash.products.edit');
Route::post('dashboard/products/store', [ProductController::class, 'store'])->name('dash.products.store');
Route::put('dashboard/products/update/{product}', [ProductController::class, 'update'])->name('dash.products.update');
