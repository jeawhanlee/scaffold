<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;

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
Route::get("/categories", [CategoriesController::class, 'index'])->name("categories");
Route::get("/categories/{categories}", [ProductController::class, 'getProduct'])->name("category");
Route::get("/subcategories/{categories}", [CategoriesController::class, 'getSubCategory'])->name("subcat");
Route::get("/products/{product}", [ProductController::class, 'productView'])->name("product");

Route::get('/', function () {
    return view('welcome');
});
