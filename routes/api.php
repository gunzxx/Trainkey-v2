<?php

use App\Http\Controllers\api\DataController;
use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth-api'])->group(function(){
    Route::get('/ajax/data', [DataController::class, 'data']);
    Route::post('/ajax/search', [HomeController::class, 'search']);
    Route::post('/ajax/showall', [HomeController::class, 'showall']);
    Route::post('/ajax/update', [HomeController::class, 'update']);
    Route::post('/ajax/rank', [HomeController::class, 'rank']);

    Route::DELETE('/profile', [ProfileController::class, 'delete']);

    Route::post('/message', [ForumController::class, 'store']);
});

Route::post('/emit-event', [EventController::class, 'emit']);
