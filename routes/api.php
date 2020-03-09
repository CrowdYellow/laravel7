<?php

use Illuminate\Http\Request;

Route::prefix('v1/frontend')->name('api.v1.')->namespace('Api\Frontend')->group(function() {
    // 短信验证码
    Route::post('verificationCodes', 'VerificationCodesController@store')
        ->name('verificationCodes.store');
    // 用户注册
    Route::post('users', 'UsersController@store')
        ->name('users.store');
});
