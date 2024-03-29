<?php

use App\Http\Controllers\api\TypologyController;
use App\Http\Controllers\api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Doctor Routes
Route::get('doctors', [UserController::class, 'index']);
Route::get('doctors/search', [UserController::class, 'search']);


// Typology Routes
Route::get('typologies/search', [TypologyController::class, 'search']);
