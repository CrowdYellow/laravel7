<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Frontend\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $verifyData = Cache::get($request->verification_key);

        if (!$verifyData) {
            abort(403, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $verifyData['phone'],
            'password' => $request->password,
            'avatar'   => $request->avatar ?? '/icon.png',
        ]);

        // 清除验证码缓存
        Cache::forget($request->verification_key);

        $token = auth('api')->login($user);

        return response(new UserResource($user))->withHeaders(['token' => $token]);
    }

    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return new UserResource($request->user());
    }
}
