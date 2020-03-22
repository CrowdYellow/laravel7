<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    /**
     * 获取路由对应的控制器中的方法
     * @return false|string
     */
    public function getFunction()
    {
        $str = $this->route()->getAction()['uses'];
        return substr($str,strpos($str,"@") + 1);
    }
}
