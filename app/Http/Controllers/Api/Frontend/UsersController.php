<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\Frontend\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UsersController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'email'    => $request->email,
            'password' => $request->password,
            'avatar'   => 'email',
        ]);

        return new UserResource($user);
    }
}
