<?php

use Illuminate\Support\Facades\Route;
use Modules\Book\App\Http\Controllers\BookController;

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

Route::middleware('auth')->group(function () {
    Route::get('book/index', [BookController::class, 'index'])->name('book.index');
    Route::get('book/data', [BookController::class, 'getBooks'])->name('book.data');
    Route::resource('book', BookController::class);
});
