<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Endpoint: http://{url}/api/user-signup
// In our example http://localhost:8000/api/user-signup
Route::post('user-signup', [UserController::class, 'userSignUp' ]);

// Endpoint: http://{url}/api/user-lohin
// In our example http://localhost:8000/api/login
Route::post('user-login', [UserController::class, 'userLogin']);

// Endpoint: http://{url}/api/user/{email}
// In our example http://localhost:8000/api/user/{email}
Route::post('user/{email}', [UserController::class, 'userDetail']);

// Endpoint: http://{url}/api/users
// In our example http://localhost:8000/api/users
Route::get('users', [UserController::class, 'allUsers']);
