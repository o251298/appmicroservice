<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyService\CompanyController;
use App\Http\Controllers\AuthService\APIAuthenticationController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| API Auth Service
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function (){
    Route::post('login', [APIAuthenticationController::class, 'login'])->name('api_login');
    Route::post('register', [APIAuthenticationController::class, 'register'])->name('api_register');
    Route::post('reset_password', [APIAuthenticationController::class, 'resetPassword'])->name('api_reset_password');
});
/*
|--------------------------------------------------------------------------
| API Company Service
|--------------------------------------------------------------------------
*/
Route::prefix('service')->group(function (){
    Route::get('companies', [CompanyController::class, 'index']);
    Route::post('companies/create', [CompanyController::class, 'create']);
});
/*
|--------------------------------------------------------------------------
| API Client Service
|--------------------------------------------------------------------------
*/
Route::prefix('users')->group(function (){
    Route::post('registration', [ClientController::class, 'registration'])->name('user_register');
    Route::post('sign-in', [ClientController::class, 'login'])->name('user_login');
    Route::post('recover-password', [ClientController::class, 'recoveryPassword'])->name('user_recover_password');
    Route::get('companies', [ClientController::class, 'getCompany'])->name('user_companies');
    Route::post('companies/create', [ClientController::class, 'createCompany'])->name('user_companies_create');
});
