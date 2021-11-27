<?php

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
Route::get("/categories/{categories}", [CategoriesController::class, 'singleCategory'])->name("category");

Route::get('/', function () {
    return view('welcome');
});
