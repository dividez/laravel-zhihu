<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreAnswerRequest
 * @package App\Http\Requests
 */
class StoreAnswerRequest extends FormRequest
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
            'body.required' => '评论内容不能为空',
            'body.min' => '评论内容不能少于25个字符',
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
            'body' => 'required|min:12',
        ];
    }
}
