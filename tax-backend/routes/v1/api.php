<?php

//global controllers
use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\V1\Admin\UserController;
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

Route::post('/auth/register', [AuthenticationController::class, 'register']);
Route::post('/auth/login', [AuthenticationController::class, 'login']);

// ['middleware' => ['auth:sanctum']],
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('/user', function(Request $request) {
    //     return response()->json(['user'=>auth()->user()]);
    // });
    Route::get('/user',[UserController::class,'authDetails']);
    Route::post('/auth/logout', [AuthenticationController::class, 'logout']);
});
