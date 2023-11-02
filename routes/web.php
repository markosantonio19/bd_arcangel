<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'post'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.store');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'product', 'as' => 'product.'], function(){
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::get('/buy/{id}', [ProductController::class, 'buy'])->name('buy');
        Route::get('/my', [ProductController::class, 'my'])->name('my');
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/purchase', [ProfileController::class, 'purchase'])->name('purchase');
    });
});