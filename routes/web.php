<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ExhibitorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\AuthenticateRoutes;
use App\Http\Middleware\VerifyLogin;
use Illuminate\Support\Facades\Route;


//Home
Route::get('/', [HomeController::class, 'index'])->name('home');


//Usuários

Route::prefix('/usuarios')->name('users.')->group(function () {

    Route::get('',                      [UserController::class, 'index'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('index');
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

Route::prefix('/artistas')->name('artists.')->group(function () {
    Route::get('',                      [ArtistController::class, 'index'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('index');
    Route::get('/criar',                [ArtistController::class, 'createOrEdit'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('register');
    Route::get('/{id}/editar',          [ArtistController::class,'createOrEdit'])->middleware(VerifyLogin::class)->name('edit');
    Route::post('/salvar',              [ArtistController::class,'save'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('create');
    Route::put('/{id}/salvar',          [ArtistController::class,'save'])->middleware(VerifyLogin::class)->name('update');
    Route::delete('/{id}/deletar',      [ArtistController::class,'delete'])->middleware(VerifyLogin::class,AuthenticateRoutes::class)->name('delete');
});


Route::prefix('/expositores')->middleware(VerifyLogin::class, AuthenticateRoutes::class)->name('exhibitors.')->group(function () {

    Route::get('/',                 [ExhibitorController::class,'index'])->name('index');
    Route::get('/cadastro',         [ExhibitorController::class,'showRegister'])->name('register');
    Route::post('/save',            [ExhibitorController::class,'save'])->name('save');
    Route::get('/criar',            [ExhibitorController::class, 'createOrEdit'])->name('create');
    Route::get('/{id}/editar',      [ExhibitorController::class, 'createOrEdit'])->name('edit');

    Route::post('/salvar',          [ExhibitorController::class, 'save'])->name('save');
    Route::put('/salvar',           [ExhibitorController::class, 'save'])->name('update');
    Route::delete('/{id}/deletar',  [ExhibitorController::class, 'delete'])->name('delete');

});

//Admin dashboard
Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->middleware(VerifyLogin::class, AuthenticateRoutes::class)->name('admin.dashboard');

//Eventos
Route::prefix('/eventos')->group(function() {
    Route::get('/', [EventsController::class, 'index']);
    Route::get('/{id}', [EventsController::class, 'showEvent']);
});