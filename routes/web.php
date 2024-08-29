<?php

use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\SettingController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\PublicAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('/quotation/{id}', [PublicAccess::class, 'quotation'])->name('public.quotation.show');
Route::post('quotation/update-status',[PublicAccess::class,'quotationStatus'])->name('quotation.status');
Route::get('quotation/quotation-print-view/{id}',[PublicAccess::class,'quotationPrintView'])->name('quotation.print-view');

Route::get('app-schedules',[PublicAccess::class,'schedulars']);
Route::get('run',[PublicAccess::class,'commandRunner']);

Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
   Route::get('policies',[CustomerController::class,'getPolicies'])->name('policies');
   Route::get('view-policy/{id}',[CustomerController::class,'viewPolicy'])->name('policy.show');

   Route::get('claims',[CustomerController::class,'claims'])->name('claims');
   Route::any('claims/claim-search',[CustomerController::class,'claimSearch'])->name('claim.search');
   Route::any('raise-claim',[CustomerController::class,'raiseClaim'])->name('claim.raise');
   Route::any('claims/claim-details',[CustomerController::class,'claimDetails'])->name('claim.details');
   Route::any('claims/claim-upload-docs',[CustomerController::class,'claimUploadDocs'])->name('claim.upload-docs');

   Route::get('transactions',[CustomerController::class,'getTransaction'])->name('transactions');

   Route::get('profile',[SettingController::class,'getProfile'])->name('profile');
   Route::get('change-password',[SettingController::class,'getChangePassword'])->name('change-password');
   Route::post('change-password',[SettingController::class,'updatePassword'])->name('change-password');
});
