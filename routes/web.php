<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


//Home
Route::get('/', [HomeController::class, 'index'])->name('home');



Route::prefix('/usuario')->name('users.')->group(function () {

    Route::get('/home',                 [UserController::class, 'index'])->name('home');
    Route::get('/criar',                [UserController::class,'createOrEdit'])->name('register');
    Route::get('/{id}/editar',          [UserController::class,'createOrEdit'])->name('edit');
    Route::post('/salvar',              [UserController::class,'save'])->name('create');
    Route::put('/{id}/salvar',          [UserController::class,'save'])->name('update');
    Route::delete('/{id}/deletar',      [UserController::class,'delete'])->name('delete');
});

Route::prefix('/login')->name('login.')->controller(LoginController::class)->group(function () {

    Route::get('/',             'index')->name('index');
    Route::post('/autenticar',  'authenticate')->name('authenticate');
    Route::get('/logout',       'logout')->name('logout');

});

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
