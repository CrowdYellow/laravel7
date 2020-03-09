<?php

namespace App\Http\Requests\Api\Frontend;

use App\Http\Requests\Api\FormRequest;

class AuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|alpha_dash|min:6',
        ];
    }
}
