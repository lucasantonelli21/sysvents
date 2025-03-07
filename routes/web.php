<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Home
Route::get('/', function() {
    return view('home');
});


//Auth
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/registrar', [AuthController::class, 'showRegister']);
Route::post('/registrar', [AuthController::class, 'store']);
Route::post('/', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/login', function(){
    return view('login');
});
