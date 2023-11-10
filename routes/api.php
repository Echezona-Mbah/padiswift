<?php

use App\Http\Controllers\User\ForgetPasswordController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/verify-email', [RegisterController::class, 'verifyEmail']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/verify-otp', [LoginController::class, 'verifyOTP']);

Route::post('/forgot-password', [ForgetPasswordController::class, 'forgotPassword']);
Route::post('/forget-verify-otp', [ForgetPasswordController::class, 'verifyOTP']);
Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword']);




// Route::group(['middleware'=> ['auth:sanctum']],function(){
//     Route::post('/request-otp', [LoginController::class, 'requestOTP'])->name('request-otp');
//     Route::post('/verify-otp', [LoginController::class, 'verifyOTP']);

// });

