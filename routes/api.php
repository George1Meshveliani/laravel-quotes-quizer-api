<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuoteController;
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
Route::get('user/{email}', [UserController::class, 'userDetail']);

// Endpoint: http://{url}/api/users
// In our example http://localhost:8000/api/users
Route::get('users', [UserController::class, 'allUsers']);

// Endpoint: http://{url}/api/quotes
// In our example http://localhost:8000/api/quotes
Route::get('quotes', [\Database\Seeders\QuotesTableSeeder::class, 'run']);
