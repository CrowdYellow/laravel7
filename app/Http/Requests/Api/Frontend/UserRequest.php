<?php

namespace App\Http\Requests\Api\Frontend;

use App\Http\Requests\Api\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->getFunction()) {
            case 'store':
                return [
                    'name'              => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
                    'password'          => 'required|confirmed|alpha_dash|min:6',
                    'phone'             => [
                        'required',
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                        'unique:users'
                    ],
                    'verification_key'  => 'required|string',
                    'verification_code' => 'required|string',
                ];
                break;
            case 'update':
                $userId = auth('api')->id();

                return [
                    'name'  => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . $userId,
                    'phone' => [
                        'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
                        'unique:users,phone,' . $userId,
                    ],
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'verification_key'  => '短信验证码 key',
            'verification_code' => '短信验证码',
        ];
    }

    public function messages()
    {
        return [
            'name.unique'   => '用户名已被占用，请重新填写',
            'name.regex'    => '用户名只支持英文、数字、横杆和下划线。',
            'name.between'  => '用户名必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名不能为空。',
        ];
    }
}
