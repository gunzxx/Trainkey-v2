<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'home']);
    Route::get('/logout', [HomeController::class, 'logout']);

    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::post('/profile', [ProfileController::class, 'update']);
    Route::get('/password', [ProfileController::class, 'editPassword']);
    Route::post('/password', [ProfileController::class, 'updatePassword']);

    Route::get('/forum', [ForumController::class, 'index']);
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'postLogin']);
    
    Route::get('/register', [AuthController::class, 'getRegister']);
    Route::post('/register', [AuthController::class, 'postRegister']);

    Route::get('/forget-password', [PasswordController::class, 'forget']);
    Route::post('/forget-password', [PasswordController::class, 'sendMail']);
});

Route::get('/send-mail', [PasswordController::class, 'sendMail']);
Route::get('/test-event', [EventController::class, 'test']);
