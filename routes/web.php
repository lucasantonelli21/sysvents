<?php
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

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
