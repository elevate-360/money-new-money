<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login/submit', [LoginController::class, 'login']);
Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/data', [IndexController::class, 'data'])->name('data');
Route::post('/data/submit', [App\Http\Controllers\IndexController::class, 'insertData']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('forget');
});
