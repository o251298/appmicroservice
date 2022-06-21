<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CompanyService\CompanyController;
use App\Http\Controllers\Auth\APIAuthenticationController;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// API AUTH
Route::post('login', [APIAuthenticationController::class, 'login'])->name('api_login');
Route::post('register', [APIAuthenticationController::class, 'register'])->name('api_register');
Route::get('logout', [APIAuthenticationController::class, 'logout'])->name('api_logout');

// COMPANY SERVICE
Route::get('service/companies', [CompanyController::class, 'index']);
Route::get('service/companies/create', [CompanyController::class, 'create']);

// CLIENT SERVICE
Route::get('client/companies', [ClientController::class, 'getCompany'])->name('client_companies');
