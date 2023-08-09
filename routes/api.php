<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TubeController;

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

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/token', function (Request $request) {
        $user = $request->user();
        $token = $user->createToken($request->input('name'));

        return $token->accessToken;
    });

    Route::post('/logout', function (Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    });

    Route::post('logout_all', [PassportAuthController::class, 'logout_all']);

    Route::get('checkToken', [PassportAuthController::class, 'checkToken']);

    Route::resource('tubes', TubeController::class);
    Route::resource('tests', TestController::class);
});
