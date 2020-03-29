<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Api\Controller;
use Illuminate\Auth\AuthenticationException;
use App\Http\Requests\Api\Frontend\UserRequest;
use Illuminate\Support\Facades\Hash;

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

        return new UserResource($user);
    }

    public function update(UserRequest $request)
    {
        $user = $request->user();

        $attributes = $request->only(['name', 'phone']);

        $user->update($attributes);

        return new UserResource($user);
    }

    public function updatePassword(UserRequest $request)
    {
        $user = $request->user();
        if (!Hash::check($request->old_password, $user->password)) {
            throw new AuthenticationException('密码错误');
        }

        $attributes = $request->only(['password']);

        $user->update($attributes);

        return new UserResource($user);
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
