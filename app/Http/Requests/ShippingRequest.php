<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
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
            'name' => 'required | min:5 | max:30',
            'phone'=>'required|numeric|digits:10',
            'street_names'=>'required|min:10|max:30',
            'wards_and_communes'=>'required|min:10|max:30',
            'district_id'=>'required',
            'province_and_city_id'=>'required'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>"Vui lòng điền họ và tên !",
          'name.min'=>"Họ và tên ít nhất 5 ksi tự !",
          'name.max'=>"Họ và tên không vượt quá 30 kí tự !",

          'phone.required'=>"Vui lòng điền số điện thoại !",
          'phone.numeric'=>"Số điện thoại phải là dạng số !",
          'phone.digits'=>"Số điện thoại gồm 10 chữ số !",

          'street_names.required'=>"Vui lòng điền thông tin !",
          'street_names.min'=>"Tên đường ít nhất 10 kí tự !",
          'street_names.max'=>"Tên đường không vượt quá 30 kí tự !",

          'wards_and_communes.required'=>"Vui lòng điền thông tin !",
          'wards_and_communes.min'=>"Tên phường/xã ít nhất 10 kí tự !",
          'wards_and_communes.max'=>"Tên phường/xã không vượt quá 30 kí tự !",

          'district_id.required'=>"Vui lòng chọn thông tin !",

          'province_and_city_id.required'=>"Vui lòng chọn thông tin !"
        ];
    }

}
