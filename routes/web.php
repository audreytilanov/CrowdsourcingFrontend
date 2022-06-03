<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JasaController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\Admin\PaketJasaController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\Admin\RincianJasaController;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('user')->name('user.')->group(function(){

    Route::post('/login', [UserLoginController::class, 'proses'])->name('login');
    Route::post('/register', [UserLoginController::class, 'register'])->name('user.register');
    Route::get('/dashboard',[UserLoginController::class, 'dashboard'])->name('dashboard');

    Route::middleware(['checktoken'])->group(function(){
        Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
        
        Route::prefix('transaksi')->name('transaksi.')->group(function(){
            Route::get('/',[TransactionController::class, 'index'])->name('index');
            Route::get('/{id}',[TransactionController::class, 'detail'])->name('detail');
            Route::post('/buktipembayaran/{id}',[TransactionController::class, 'buktiPembayaran'])->name('buktipembayaran');
            Route::post('/create',[TransactionController::class, 'create'])->name('create');
            
        });
        
    });
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

        // JASA
        Route::prefix('jasa')->name('jasa.')->group(function(){
            Route::get('/',[JasaController::class, 'index'])->name('index');
            Route::get('/create',[JasaController::class, 'create'])->name('create');
            Route::post('/create',[JasaController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[JasaController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[JasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[JasaController::class, 'delete'])->name('delete');
        });

        Route::prefix('pegawai')->name('pegawai.')->group(function(){
            Route::get('/',[PegawaiController::class, 'index'])->name('index');
            Route::get('/create',[PegawaiController::class, 'create'])->name('create');
            Route::post('/create',[PegawaiController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[PegawaiController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[PegawaiController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[PegawaiController::class, 'delete'])->name('delete');
        });

        Route::prefix('rincianjasa')->name('rincianjasa.')->group(function(){
            Route::get('/',[RincianJasaController::class, 'index'])->name('index');
            Route::get('/create/{id}',[RincianJasaController::class, 'create'])->name('create');
            Route::post('/create/{id}',[RincianJasaController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[RincianJasaController::class, 'edit'])->name('edit');
            Route::post('/edit/{id}',[RincianJasaController::class, 'update'])->name('update');
            Route::post('/delete/{id}',[RincianJasaController::class, 'delete'])->name('delete');
        });

        
    });
});
