<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;


Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function(){
    Route::post('/login', [AdminLoginController::class, 'proses'])->name('login');
    Route::get('/dashboard',[AdminLoginController::class, 'dashboard'])->name('dashboard');
});
