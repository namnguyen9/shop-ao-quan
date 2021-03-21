<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoMetaCategoryRequest extends FormRequest
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
            'meta_keywords' => 'required | min:3 | max:60',
            'meta_desc'=>'required|min:10',
        ];
    }

    public function messages()
    {
        return [
          'meta_keywords.required'=>"Vui lòng điền thông tin !",
          'meta_keywords.min'=>"Vui lòng điền ít nhất 3 kí tự !",
          'meta_keywords.max'=>"Độ dài tối đa là 60 kí tự !",

          'meta_desc.required'=>"Vui lòng điền thông tin !",
          'meta_desc.min'=>"Vui lòng điền ít nhất 10 kí tự !",
        ];
    }
}
