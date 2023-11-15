<?php

use App\Http\Controllers\Airtime\AirtimeController;
use App\Http\Controllers\User\AuthNewPasswordController;
use App\Http\Controllers\User\ForgetPasswordController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\ProfileUpdatedController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\TopUpController;
use App\Http\Controllers\User\TransactionPinController;
use App\Http\Controllers\User\UploadPhotoController;
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
// Route::post('/upload-photo', [PhotoController::class, 'uploadPhoto']);



Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::post('/uploadPhoto/{id}', [UploadPhotoController::class, 'updatePhoto']);
    Route::post('/update-profile', [ProfileUpdatedController::class, 'updateProfile']);
    Route::post('/create-transaction-pin', [TransactionPinController::class, 'CreteTransactionPin']);
    Route::post('/update-transaction-pin', [TransactionPinController::class, 'updateTransactionPin']);
    Route::post('/update-password', [AuthNewPasswordController::class, 'updatePassword']);
    Route::post('/top-up', [TopUpController::class, 'topUp']);
    Route::post('/bank-transfer', [TopUpController::class, 'initiateBankTransfer']);
    Route::post('/airtime', [AirtimeController::class, 'recharge'])->name('airtime');


});
