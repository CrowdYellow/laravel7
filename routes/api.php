<?php

use Illuminate\Http\Request;

Route::prefix('v1/frontend')
    ->name('api.v1.')
    ->namespace('Api\Frontend')
    ->group(function() {
        Route::middleware('throttle:' . config('api.rate_limits.sign'))
            ->group(function () {
                // 图片验证码
                Route::post('captchas', 'CaptchasController@store')
                    ->name('api.captchas.store');
                // 短信验证码
                Route::post('verificationCodes', 'VerificationCodesController@store')
                    ->name('api.verificationCodes.store');
                // 用户注册
                Route::post('users', 'UsersController@store')
                    ->name('api.users.store');
                // 第三方登录
                Route::post('socials/{social_type}/authorizations', 'AuthorizationsController@socialStore')
                    ->where('social_type', 'weixin')
                    ->name('api.socials.authorizations.store');
                // 登录
                Route::post('authorizations', 'AuthorizationsController@store')
                    ->name('api.authorizations.store');
                // 刷新token
                Route::put('authorizations/current', 'AuthorizationsController@update')
                    ->name('authorizations.update');
                // 删除token
                Route::delete('authorizations/current', 'AuthorizationsController@destroy')
                    ->name('authorizations.destroy');
            });

        Route::middleware('throttle:' . config('api.rate_limits.access'))
            ->group(function () {
                // 游客可以访问的接口

                // 某个用户的详情
                Route::get('users/{user}', 'UsersController@show')
                    ->name('users.show');
                // 话题列表，详情
                Route::resource('topics', 'TopicsController')->only([
                    'index', 'show'
                ]);
                // 某个用户发布的话题
                Route::get('users/{user}/topics', 'TopicsController@userIndex')
                    ->name('users.topics.index');
                // 话题回复列表
                Route::get('topics/{topic}/comments', 'CommentsController@index')
                    ->name('topics.comments.index');
                // 某个用户的回复列表
                Route::get('users/{user}/comments', 'CommentsController@userIndex')
                    ->name('users.comments.index');

                // 登录后可以访问的接口
                Route::middleware('api.refresh')->group(function() {
                    // 当前登录用户信息
                    Route::get('user', 'UsersController@me')
                        ->name('user.show');
                    // 发布话题
                    Route::resource('topics', 'TopicsController')->only([
                        'store', 'update', 'destroy'
                    ]);
                    // 发布回复
                    Route::post('topics/{topic}/comments', 'CommentsController@store')
                        ->name('topics.comments.store');
                    // 删除回复
                    Route::delete('topics/{topic}/comments/{comment}', 'CommentsController@destroy')
                        ->name('topics.comments.destroy');
                    // 通知列表
                    Route::get('notifications', 'NotificationsController@index')
                        ->name('notifications.index');
                });
            });
    });
