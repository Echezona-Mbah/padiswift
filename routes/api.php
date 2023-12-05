<?php

use App\Http\Controllers\Airtime\AirtimeController;
use App\Http\Controllers\Airtime\DataController;
use App\Http\Controllers\Airtime\NetWorkImages;
use App\Http\Controllers\Education\WeacRegisterController;
use App\Http\Controllers\Education\WeacResultCheckController;
use App\Http\Controllers\Electricity\ElectricityController;
use App\Http\Controllers\Subscription\TVSubscriptionController;
use App\Http\Controllers\User\AuthNewPasswordController;
use App\Http\Controllers\User\ForgetPasswordController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\PadiTagController;
use App\Http\Controllers\User\ProfileUpdatedController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\TopUpController;
use App\Http\Controllers\User\TransactionPinController;
use App\Http\Controllers\User\UploadPhotoController;
use App\Http\Controllers\User\VerifyPinController;
use App\Http\Controllers\Wallect\WallectTransferContrroller;
use App\Models\WeacResultCheck;
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
Route::post('/verify-email/{email}', [RegisterController::class, 'verifyEmail']);
Route::post('/verify-email-otp/{email}', [RegisterController::class, 'verifyEmailOtp']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/verify-otp/{email}', [LoginController::class, 'verifyOTP']);
Route::delete('/deleteUser/{email}', [RegisterController::class, 'deleteUser']);


Route::post('/forgot-password', [ForgetPasswordController::class, 'forgotPassword']);
Route::post('/forget-verify-otp', [ForgetPasswordController::class, 'verifyOTP']);
Route::post('/reset-password', [ForgetPasswordController::class, 'resetPassword']);
// Route::post('/upload-photo', [PhotoController::class, 'uploadPhoto']);



Route::group(['middleware'=> ['auth:sanctum']],function(){
    Route::post('/upload-network-image', [NetWorkImages::class, 'store']);
    Route::get('/user/{id}', [RegisterController::class, 'show']);
    Route::post('/uploadPhoto/{id}', [UploadPhotoController::class, 'updatePhoto']);
    Route::post('/update-profile', [ProfileUpdatedController::class, 'updateProfile']);
    Route::post('/create-transaction-pin', [TransactionPinController::class, 'CreteTransactionPin']);
    Route::post('/update-transaction-pin', [TransactionPinController::class, 'updateTransactionPin']);
    Route::post('/update-paditag', [PadiTagController::class, 'updatePaditag']);
    Route::get('/get-user-by-padi-tag/{padiTag}', [PadiTagController::class, 'getUserByPadiTag']);
    Route::post('/wallect', [WallectTransferContrroller::class, 'transfer']);
    Route::post('/update-password', [AuthNewPasswordController::class, 'updatePassword']);
    Route::post('/bank-transfer', [TopUpController::class, 'backTransfer']);
    Route::post('/card', [TopUpController::class, 'card']);
    Route::post('/airtime', [AirtimeController::class, 'recharge'])->name('airtime');
    Route::get('/airtime/airtime-history', [AirtimeController::class, 'getAirtimeHistory']);
    Route::get('/getVariationCodes', [DataController::class, 'getVariationCodes']);
    Route::post('/data', [DataController::class, 'data'])->name('data');
    Route::get('/data/data-history', [DataController::class, 'getDateHistory']);
    Route::get('/airtime-data',[AirtimeController::class, 'index']);
    Route::post('/smart-card', [TVSubscriptionController::class, 'verifyDSTVSmartcard']);
    Route::post('/getVariationCodes', [TVSubscriptionController::class, 'getVariationCodes']);
    Route::post('/purchaseSubscription', [TVSubscriptionController::class, 'purchaseSubscription']);
    Route::get('/getTVHistory', [TVSubscriptionController::class, 'getTVHistory']);
    Route::post('/verifyMeterNumber', [ElectricityController::class, 'verifyMeterNumber']);
    Route::post('/purchaseElectricity', [ElectricityController::class, 'purchaseElectricity']);
    Route::get('/getElectricityHistory', [ElectricityController::class, 'getElectricityHistory']);
    Route::post('/getVariationCodes', [WeacResultCheckController::class, 'getVariationCodes']);
    Route::post('/purchaseWaecchack', [WeacResultCheckController::class, 'purchaseWaecchack']);
    Route::get('/getWeacCheckHistory', [WeacResultCheckController::class, 'getWeacCheckHistory']);
    Route::post('/verify-payment-pin', [VerifyPinController::class, 'verifyPinApi']);
    Route::post('/unblock-account', [VerifyPinController::class, 'requestUnblock']);
    Route::get('/getAllTable', [DataController::class, 'getAllTable']);
    Route::get('/getSupportedNetworks', [NetWorkImages::class, 'getSupportedNetworks']);

















});
