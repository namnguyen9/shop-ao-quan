<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required | min:3 | max:30',
            'desc'=>'required|min:5',
            'status'=>'required'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>"Vui lòng điền thông tin !",
          'name.min'=>"Vui lòng điền ít nhất 3 kí tự !",
          'name.max'=>"Độ dài tối đa là 30 kí tự !",

          'desc.required'=>"Vui lòng điền thông tin !",
          'desc.min'=>"Vui lòng điền ít nhất 5 kí tự !",

          'status.required'=>"Vui chọn thông tin !"
        ];
    }

     public function attributes()
    {
        return [
            'name' => 'Tên danh mục',
            'desc' => 'Mô tả danh mục',
            'status' => 'Trạng thái danh mục',
        ];
    }
}
