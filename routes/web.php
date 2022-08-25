<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

Route::middleware(['auth','admin'])
    ->group(function() {
        Route::resource('/company', CompanyController::class);
        Route::get('/api/company', [App\Http\Controllers\CompanyController::class, 'api']);

        Route::resource('/employe', EmployeController::class);
        Route::get('/api/employe', [App\Http\Controllers\EmployeController::class, 'api']);
});