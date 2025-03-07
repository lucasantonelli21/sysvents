<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('/login')->name('login.')->controller(LoginController::class)->group(function () {

    Route::get('/',  'index')->name('index');
    Route::post('/autenticar', 'authenticate')->name('authenticate');

});

Route::get('/dashboard', function(){
    return view('admin.dashboard');
})->name('admin.dashboard');
