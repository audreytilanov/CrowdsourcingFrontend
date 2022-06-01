<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\KategoriController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function(){
    Route::post('/login', [AdminLoginController::class, 'proses'])->name('login');
    Route::get('/dashboard',[AdminLoginController::class, 'dashboard'])->name('dashboard');
    
    Route::middleware('checktoken')->group(function(){
        Route::prefix('kategori')->name('kategori.')->group(function(){
            Route::get('/',[KategoriController::class, 'index'])->name('index');
            Route::get('/create',[KategoriController::class, 'create'])->name('create');
            Route::post('/create',[KategoriController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[KategoriController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[KategoriController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[KategoriController::class, 'delete'])->name('delete');
        });
    });
});
