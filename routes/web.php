<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\AuthenticateRoutes;
use App\Http\Middleware\VerifyLogin;
use App\Models\Event;
use Illuminate\Support\Facades\Route;


//Home
Route::get('/', [HomeController::class, 'index'])->name('home');


//Usuários

Route::prefix('/usuarios')->name('users.')->group(function () {

    Route::get('/',                      [UserController::class, 'index'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('index');
    Route::get('/criar',                [UserController::class,'createOrEdit'])->name('register');
    Route::get('/{id}/editar',          [UserController::class,'createOrEdit'])->middleware(VerifyLogin::class)->name('edit');
    Route::post('/salvar',              [UserController::class,'save'])->name('create');
    Route::put('/{id}/salvar',          [UserController::class,'save'])->middleware(VerifyLogin::class)->name('update');
    Route::delete('/{id}/deletar',      [UserController::class,'delete'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('delete');
});

//Login
Route::prefix('/login')->name('login.')->controller(LoginController::class)->group(function () {

    Route::get('/',             'index')->name('index');
    Route::post('/autenticar',  'authenticate')->name('authenticate');
    Route::get('/logout',       'logout')->name('logout');

});

Route::prefix('/artistas')->name('artists.')->middleware(VerifyLogin::class, AuthenticateRoutes::class)->group(function () {
    Route::get('/',                      [ArtistController::class, 'index'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('index');
    Route::get('/criar',                [ArtistController::class, 'createOrEdit'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('register');
    Route::get('/{id}/editar',          [ArtistController::class,'createOrEdit'])->middleware(VerifyLogin::class)->name('edit');
    Route::post('/salvar',              [ArtistController::class,'save'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('create');
    Route::put('/{id}/salvar',          [ArtistController::class,'save'])->middleware(VerifyLogin::class)->name('update');
    Route::delete('/{id}/deletar',      [ArtistController::class,'delete'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('delete');
});

Route::prefix('/expositores')->middleware(VerifyLogin::class, AuthenticateRoutes::class)->name('exhibitors.')->group(function () {

    Route::get('/',                 [ExhibitorController::class,'index'])->name('index');
    Route::get('/cadastro',         [ExhibitorController::class,'showRegister'])->name('register');
    Route::get('/criar',            [ExhibitorController::class, 'createOrEdit'])->name('create');
    Route::get('/{id}/editar',      [ExhibitorController::class, 'createOrEdit'])->name('edit');

    Route::post('/salvar',          [ExhibitorController::class, 'save'])->name('save');
    Route::put('/salvar',           [ExhibitorController::class, 'save'])->name('update');
    Route::delete('/{id}/deletar',  [ExhibitorController::class, 'delete'])->name('delete');

});

//Admin dashboard
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/dashboard',        [AdminController::class, 'index'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('dashboard');
});

//Eventos
Route::prefix('/eventos')->name('events.')->group(function() {
    Route::get('/',                 [EventController::class,'index'])->name('index');
    Route::get('/cadastro',         [EventController::class,'showRegister'])->name('register');

    Route::get('/criar',            [EventController::class, 'createOrEdit'])->name('create');
    Route::get('/{id}/editar',      [EventController::class, 'createOrEdit'])->name('edit');

    Route::post('/salvar',          [EventController::class, 'save'])->name('save');
    Route::put('/salvar',           [EventController::class, 'save'])->name('update');
    Route::delete('/{id}/deletar',  [EventController::class, 'delete'])->name('delete');
});

Route::prefix('/transações')->name('transactions.')->group(function() {
    Route::get('/',                 [TransactionController::class,'index'])->name('index');
    Route::get('/cadastro',         [TransactionController::class,'showRegister'])->name('register');

    Route::get('/criar',            [TransactionController::class, 'createOrEdit'])->name('create');
    Route::get('/{id}/editar',      [TransactionController::class, 'createOrEdit'])->name('edit');

    Route::post('/salvar',          [TransactionController::class, 'save'])->name('save');
    Route::put('/salvar',           [TransactionController::class, 'save'])->name('update');
    Route::delete('/{id}/deletar',  [TransactionController::class, 'delete'])->name('delete');
});