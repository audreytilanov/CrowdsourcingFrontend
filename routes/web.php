<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PaketJasaController;
use App\Http\Controllers\Admin\SkillController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function(){
    Route::post('/login', [AdminLoginController::class, 'proses'])->name('login');
    Route::get('/dashboard',[AdminLoginController::class, 'dashboard'])->name('dashboard');
    
    Route::middleware('checktoken')->group(function(){
        // KATEGORI
        Route::prefix('kategori')->name('kategori.')->group(function(){
            Route::get('/',[KategoriController::class, 'index'])->name('index');
            Route::get('/create',[KategoriController::class, 'create'])->name('create');
            Route::post('/create',[KategoriController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[KategoriController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[KategoriController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[KategoriController::class, 'delete'])->name('delete');
        });

        // SKILL
        Route::prefix('skill')->name('skill.')->group(function(){
            Route::get('/',[SkillController::class, 'index'])->name('index');
            Route::get('/create',[SkillController::class, 'create'])->name('create');
            Route::post('/create',[SkillController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[SkillController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[SkillController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[SkillController::class, 'delete'])->name('delete');
        });

        // PAKET JASA
        Route::prefix('paketjasa')->name('paketjasa.')->group(function(){
            Route::get('/',[PaketJasaController::class, 'index'])->name('index');
            Route::get('/create',[PaketJasaController::class, 'create'])->name('create');
            Route::post('/create',[PaketJasaController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[PaketJasaController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[PaketJasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[PaketJasaController::class, 'delete'])->name('delete');
        });
    });
});
