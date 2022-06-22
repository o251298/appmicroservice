<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyService\CompanyController;
use App\Http\Controllers\Auth\APIAuthenticationController;
use App\Http\Controllers\ClientController;

/*
|--------------------------------------------------------------------------
| API Auth Service
|--------------------------------------------------------------------------
*/
Route::post('login', [APIAuthenticationController::class, 'login'])->name('api_login');
Route::post('register', [APIAuthenticationController::class, 'register'])->name('api_register');
Route::get('logout', [APIAuthenticationController::class, 'logout'])->name('api_logout');
Route::post('reset_password', [APIAuthenticationController::class, 'resetPassword'])->name('api_reset_password');
/*
|--------------------------------------------------------------------------
| API Company Service
|--------------------------------------------------------------------------
*/
Route::get('service/companies', [CompanyController::class, 'index']);
Route::post('service/companies/create', [CompanyController::class, 'create']);
/*
|--------------------------------------------------------------------------
| API Client Service
|--------------------------------------------------------------------------
*/
Route::get('client/companies', [ClientController::class, 'getCompany'])->name('client_companies');
Route::post('client/companies/create', [ClientController::class, 'createCompany'])->name('client_companies_create');


