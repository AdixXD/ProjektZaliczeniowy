<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DebtorController;
use App\Http\Controllers\HomeController;
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
})->name('index');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/comments',[CommentsController::class,'index'])->name('comments');

Route::get('/create1',[CommentsController::class,'create'])->name('create1');
Route::post('/create1',[CommentsController::class,'store'])->name('store1');
Route::get('/delete1/{id}',[CommentsController::class,'destroy'])->name('delete1');
Route::get('/edit1/{id}', [CommentsController::class,'edit'])->name('edit1');
Route::put('/update1/{id}', [CommentsController::class,'update'])->name('update1');

Route::get('/debtor',[DebtorController::class,'index'])->name('debtor');
Route::get('/create',[DebtorController::class,'create'])->name('create');
Route::post('/create',[DebtorController::class,'store'])->name('store');
Route::get('/delete/{id}',[DebtorController::class,'destroy'])->name('delete');
Route::get('/edit/{id}', [DebtorController::class,'edit'])->name('edit');
Route::put('{id}', [DebtorController::class,'update'])->name('update');



/* mialem tak wczesniej i tez bylo git
 * Route::get('/comments','App\Http\Controllers\CommentsController@index')->name('comments');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 */

Auth::routes();
