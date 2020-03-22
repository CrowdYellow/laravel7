<?php

namespace App\Http\Requests\Api\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text' => 'required|min:2',
        ];
    }
}
