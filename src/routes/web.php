<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::prefix('products')->name('products.')->group(function () {
    // 商品一覧
    Route::get('/', [ProductController::class, 'index'])->name('index');

    // 商品登録
    Route::get('/register', [ProductController::class, 'create'])->name('create');
    Route::post('/register', [ProductController::class, 'store'])->name('store');

    // 商品詳細
    Route::get('/{productId}', [ProductController::class, 'edit'])->name('edit');

    // 商品更新
    Route::put('/{productId}/update', [ProductController::class, 'update'])->name('update');

    // 商品検索
    Route::get('/search', [ProductController::class, 'search'])->name('search');

    // 商品削除
    Route::delete('/{productId}/delete', [ProductController::class, 'destroy'])->name('destroy');
});