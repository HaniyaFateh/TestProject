<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\SuggestionController;

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


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sentRequest', [RequestController::class, 'index'])->name('sentRequest');
Route::get('/receiveRequest', [RequestController::class, 'receiveRequest'])->name('receiveRequest');

Route::put('/edit/{id}', [RequestController::class, 'edit'])->name('edit');
Route::delete('/delete/{id}', [RequestController::class, 'destroy'])->name('delete');

Route::get('/getConnection', [ConnectionController::class, 'index'])->name('getConnection');
Route::get('/getConnectionByID/{id}', [ConnectionController::class, 'show'])->name('getConnectionByID');
Route::delete('/deleteConnection/{id}', [ConnectionController::class, 'destroy'])->name('deleteConnection');


Route::get('/getSuggestion', [SuggestionController::class, 'index'])->name('getSuggestion');
Route::put('/connect/{id}', [SuggestionController::class, 'edit'])->name('connect');
