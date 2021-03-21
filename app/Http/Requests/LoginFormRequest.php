<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required | min:3 | max:50',
            'email'=>'required',
            'password'=>'required',
            'phone'=>'required'
        ];
    }

    public function messages()
    {
        return [
          'name.required'=>"Vui lòng điền thông tin !",
          'name.min'=>"Vui lòng điền ít nhất 5 kí tự !",
          'name.max'=>"Độ dài tối đa là 50 kí tự !",

          'email.required'=>"Vui lòng điền thông tin !",
          'meta_desc.min'=>"Vui lòng điền ít nhất 10 kí tự !",

          'password.required'=>"Vui lòng điền thông tin !",

          'phone.required'=>"Vui lòng điền thông tin !",

        ];

    }

}
