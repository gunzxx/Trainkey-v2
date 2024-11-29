<?php

use App\Http\Controllers\api\DataController;
use App\Http\Controllers\api\HomeController;
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


Route::get('/ajax/data', [DataController::class, 'data']);
Route::middleware(['auth-api'])->group(function(){
    Route::post('/ajax/search', [HomeController::class, 'search']);
    Route::post('/ajax/showall', [HomeController::class, 'showall']);
    Route::post('/ajax/update', [HomeController::class, 'update']);
    Route::post('/ajax/rank', [HomeController::class, 'rank']);
});