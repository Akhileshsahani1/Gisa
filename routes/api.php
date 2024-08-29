<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Customer\ApiController;
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
Route::post('get-customer',[ApiController::class,'getCustomer']);
Route::post('sent-otp',[ApiController::class,'sendOTP']);
Route::post('submit-otp',[ApiController::class,'submitOTP']);

Route::group(['middleware' => ['auth:api']], function () {

Route::get('get-profile',[ApiController::class,'getProfile']);
Route::get('policies',[ApiController::class,'getPolicies']);
Route::post('claim-process',[ApiController::class,'claimProcess']);
Route::post('claim-image/{policy_id}/{name}/{type}',[ApiController::class,'claimDocImages']);
Route::get('claim-submit/{id}',[ApiController::class,'ClaimFilled']);
Route::get('claim/{id}',[ApiController::class,'getClaim']);
Route::get('policy-details/{id}',[ApiController::class,'policyDetails']);
Route::get('customer-claims',[ApiController::class,'customerClaims']);
Route::post('claim-audio/{policy_id}',[ApiController::class,'claimAudio']);
});
