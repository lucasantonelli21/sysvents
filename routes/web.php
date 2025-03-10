<?php

use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');



Route::prefix('/usuario')->name('user.')->group(function () {

    Route::get('/cadastro', [UserController::class,'showRegister'])->name('register');
    Route::post('/save',    [UserController::class,'save'])->name('save');
});

Route::prefix('/login')->name('login.')->controller(LoginController::class)->group(function () {

    Route::get('/',             'index')->name('index');
    Route::post('/autenticar',  'authenticate')->name('authenticate');
    Route::get('/logout',       'logout')->name('logout');

});

Route::prefix('/expositores')->name('exhibitor.')->group(function () {

    Route::get('/',                 [ExhibitorController::class,'index'])->name('index');
    Route::get('/cadastro',         [ExhibitorController::class,'showRegister'])->name('register');
    Route::post('/save',            [ExhibitorController::class,'save'])->name('save');
    Route::get('/criar',            [ExhibitorController::class, 'createOrEdit'])->name('create');
    Route::get('/{id}/editar',      [ExhibitorController::class, 'createOrEdit'])->name('edit');

    Route::post('/salvar',          [ExhibitorController::class, 'save'])->name('save');
    Route::put('/salvar',           [ExhibitorController::class, 'save'])->name('update');
    Route::delete('/{id}/deletar',  [ExhibitorController::class, 'delete'])->name('delete');

});

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
