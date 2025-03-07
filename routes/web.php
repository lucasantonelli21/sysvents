<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

//Home
Route::get('/', [HomeController::class, 'index']);


// Auth
// Route::get('/', [AuthController::class, 'showLogin'])->name('login');
// Route::get('/registrar', [AuthController::class, 'showRegister']);
// Route::post('/registrar', [AuthController::class, 'store']);
// Route::post('/', [AuthController::class, 'authenticate']);
// Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/login', function(){
    return view('login');
});
