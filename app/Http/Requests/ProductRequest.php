<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required | min:5 | max:255',
            'desc'=>'required|min:20',
            'fabric_material'=>'required|min:3|max:50',
            'style'=>'required|min:3|max:50',
            'size'=>'required|max:10',
            'origin'=>'required|min:2|max:50',
            'color'=>'required|min:3|max:20',
            'price'=>'required|min:5|max:20',
            'status'=>'required',
            'category_id'=>'required',
            'brand_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>"Vui lòng điền thông tin !",
          'name.min'=>"Vui lòng điền ít nhất 5 kí tự !",
          'name.max'=>"Độ dài tối đa là 255 kí tự !",

          'desc.required'=>"Vui lòng điền thông tin !",
          'desc.min'=>"Vui lòng điền ít nhất 20 kí tự !",

          'fabric_material.required'=>"Vui lòng điền thông tin !",
          'fabric_material.min'=>"Vui lòng điền ít nhất 3 kí tự !",
          'fabric_material.max'=>"Độ dài tối đa là 50 kí tự !",
          
          'style.required'=>"Vui lòng điền thông tin !",
          'style.min'=>"Vui lòng điền ít nhất 3 kí tự !",
          'style.max'=>"Độ dài tối đa là 50 kí tự !",
           
          'size.required'=>"Vui lòng điền thông tin !",
          'size.max'=>"Độ dài tối đa là 10 kí tự !",

          'origin.required'=>"Vui lòng điền thông tin !",
          'origin.min'=>"Vui lòng điền ít nhất 2 kí tự !",
          'origin.max'=>"Độ dài tối đa là 50 kí tự !",

          'color.required'=>"Vui lòng điền thông tin !",
          'color.min'=>"Vui lòng điền ít nhất 3 kí tự !",
          'color.max'=>"Độ dài tối đa là 20 kí tự !",

          'price.required'=>"Vui lòng điền thông tin !",
          'price.min'=>"Vui lòng điền ít nhất 5 kí tự !",
          'price.max'=>"Độ dài tối đa là 20 kí tự !",

          'status.required'=>"Vui chọn thông tin !",

          'category_id.required'=>"Vui chọn thông tin !",

          'brand_id.required'=>"Vui chọn thông tin !"
        ];
    }

     public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'desc' => 'Mô tả sản phẩm',
            'fabric_material' => 'Chất liệu',
            'style' => 'Phong cách',
            'size' => 'Kích thước',
            'origin' => 'Xuất xứ',
            'color' => 'Màu sản phẩm',
            'price' => 'Giá sản phẩm',
            'status' => 'Trạng thái',
            'category_id ' => 'Thuộc danh mục',
            'brand_id ' => 'Thuộc thương hiệu',
        ];
    }
}
