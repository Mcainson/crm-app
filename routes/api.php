<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
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

Route::middleware('auth:sanctum', 'localization')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'localization'])->group(function () {
    Route::apiResources([
        'companies' => CompanyController::class,
        'employers' => EmployerController::class,
    ]);
    Route::post('/me', [AuthController::class, 'me']);
});

Route::post('/register', [AuthController::class, 'register'])->middleware('localization');
Route::post('/login', [AuthController::class, 'login'])->middleware('localization');


