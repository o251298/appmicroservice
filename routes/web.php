<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Auth\AuthenticationController;
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

// BASIC

Route::get('/', function (){
   return view('basic.index');
});

Route::get('/dashboard', function () {
    return view('client.home');
})->name('dashboard');

// AUTH
Route::get('auth/register', [AuthenticationController::class, 'registerPage'])->name('register_page');
Route::get('auth/login', [AuthenticationController::class, 'loginPage'])->name('login_page');
Route::get('auth/resetPassword', [AuthenticationController::class, 'resetPasswordPage'])->name('reset_password_page');
Route::post('register', [AuthenticationController::class, 'register'])->name('register');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('resetPassword', [AuthenticationController::class, 'resetPassword'])->name('reset_password');
Route::post('logout', [AuthenticationController::class, 'logout'])->name('logout');

// COMPANY
Route::get('companies', [ClientController::class, 'getCompany']);
Route::get('auth', [ClientController::class, 'auth'])->name('auth');
