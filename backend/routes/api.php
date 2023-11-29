<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\CategoryController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('news/sources', [NewsController::class, 'getAllSources']);
Route::get('news/authors', [NewsController::class, 'getAllAuthors']);
Route::get('news/all', [NewsController::class, 'getAllNews']);
Route::get('news/categories', [NewsController::class, 'getAllCategories']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('categories/assign', [\App\Http\Controllers\UserController::class, 'assignCategories']);
    Route::get('/preferences', [\App\Http\Controllers\Api\PreferencesController::class, 'getPreferences']);
    Route::post('preferences/assign', [\App\Http\Controllers\Api\PreferencesController::class, 'assignPreferences']);

    Route::post('refresh-token', [
        'uses' => AccessTokenController::class . '@refreshToken',
        'middleware' => 'throttle',
    ]);
});
