<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('product/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('category/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::get('category/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
