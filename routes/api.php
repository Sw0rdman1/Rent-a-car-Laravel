<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RentalController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserRentalController;
use App\Http\Controllers\CarRentalController;
use App\Http\Controllers\Api\AuthController;
use App\Models\Rental;

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


Route::resource('users.rentals',UserRentalController::class)->only('index');
Route::resource('cars.rentals',CarRentalController::class)->only('index');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::resource('rentals', RentalController::class)->only(['update', 'store', 'destroy']);
    Route::resource('cars',CarController::class)->only(['update', 'store', 'destroy']);
    Route::resource('brands',BrandController::class)->only(['update', 'store', 'destroy']);
    
    Route::resource('users', UserController::class)->only(['index', 'show']);


    Route::post('/logout', [AuthController::class, 'logout']);
});

    Route::resource('rentals', RentalController::class)->only(['index', 'show']);
    Route::resource('cars',CarController::class)->only(['index', 'show']);
    Route::resource('brands',BrandController::class)->only(['index', 'show']);
