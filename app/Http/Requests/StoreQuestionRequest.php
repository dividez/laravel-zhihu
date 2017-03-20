<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreQuestionRequest
 * @package App\Http\Requests
 */
class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     * @author zhangpengyi
     */
    public function messages()
    {
        return [
            'body.required' => '内容不能为空',
            'body.min' => '内容不能少于25个字符',
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:6|max:196',
            'body' => 'required|min:25',
        ];
    }
}
