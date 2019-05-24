<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'brand_name' => 'required|unique:brand|max:10',
            'brand_logo' => 'required',
            'brand_desc' => 'required',
            'brand_url' => 'required',
        ];
    }

    //自定义错误
    public function messages(){
        return [
            'brand_name.required' => '品牌名称不能为空',
            'brand_name.unique' => '品牌名称不能重复',
            'brand_logo.required' => '品牌logo不能为空',
            'brand_desc.required' => '品牌描述不能为空',
            'brand_url.required' => '品牌网址不能为空',
        ];
    }
}
