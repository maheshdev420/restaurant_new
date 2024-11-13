<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\userApiController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });+


Route::post('/socialite/login', [userApiController::class, 'socialiteLogin'])->name('api.socialite.login');
Route::post('/user/store', [userApiController::class, 'storeFrontUser'])->name('api.user.store');
Route::post('/user/login', [userApiController::class, 'userLogin'])->name('api.user.login');
Route::post('password/email', [userApiController::class, 'passwordEmail'])->name('api.password.email');
Route::post('sign/up/email/verify', [userApiController::class, 'signUpEmailverify'])->name('api.signUp.email.verify');
Route::post('verify/otp', [userApiController::class, 'verifyOtp'])->name('api.password.verifyOtp');
Route::patch('password/update', [userApiController::class, 'userPasswordUpdate'])->name('api.user.password.update');
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('user')->group(function () {
        Route::put('update', [userApiController::class, 'updateUserProfile'])->name('api.user.update');
        // Route::patch('password/update', [userApiController::class, 'userPasswordUpdate'])->name('api.user.password.update');
        Route::get('profile/view', [userApiController::class, 'viewUserProfile'])->name('api.view.user.profile');
        Route::delete('delete', [userApiController::class, 'destroyFrontUser'])->name('api.user.delete');
        Route::get('logout', [userApiController::class, 'userLogout'])->name('api.user.logout');

    });

    Route::prefix('address')->group(function () {
        Route::get('list', [userApiController::class, 'showAddressList'])->name('api.address.list');
        Route::get('create', [userApiController::class, 'showCreateAddressForm'])->name('api.address.create');
        Route::post('store', [userApiController::class, 'storeAddress'])->name('api.address.store');
        Route::put('update/{id}', [userApiController::class, 'updateAddress'])->name('api.address.update');
        Route::delete('delete/{id}', [userApiController::class, 'destroyAddress'])->name('api.address.delete');
    });
});