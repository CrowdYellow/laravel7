<?php

namespace App\Http\Requests\Api\Frontend;

use App\Http\Requests\Api\FormRequest;

class TopicRequest extends FormRequest
{
    public function rules()
    {
        switch ($this->getFunction()) {
            case 'store':
                return [
                    'title'       => 'required|string',
                    'body'        => 'required|string',
                    'category_id' => 'required|exists:categories,id',
                ];
                break;
            case 'update':
                return [
                    'title'       => 'string',
                    'body'        => 'string',
                    'category_id' => 'exists:categories,id',
                ];
                break;
        }
    }

    public function attributes()
    {
        return [
            'title'       => '标题',
            'body'        => '话题内容',
            'category_id' => '分类',
        ];
    }
}
