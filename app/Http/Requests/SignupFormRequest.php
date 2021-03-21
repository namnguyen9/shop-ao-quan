<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupFormRequest extends FormRequest
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
            'name'=>'required|min:8|max:40|regex:/[A-Za-z]/',
            'email'=>'required|email:rfc,dns|unique:App\Models\User,email',
            'password'=>'required|min:8|max:30|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'phone'=>'required|digits:10',
        ];
    }

    public function messages()
    {
        return [    
            'name.required'=>'Vui lòng nhập họ và tên !',
            'name.min'=>'Họ và tên không hợp lệ !',
            'name.max'=>'Tên quá dài !',
            'name.unique'=>'Tên quá dài !',
            'name.regex'=>'Họ và tên không được chứa chữ số và kí tự !',

            'email.required'=>'Vui lòng nhập địa chỉ email !',
            'email.email'=>'Email không hợp lệ !',
            'email.unique'=>'Email đã tồn tại !',

            'password.required'=>'Vui lòng nhập mật khẩu !',
            'password.min'=>'Mật khẩu ít nhất 8 kí tự',
            'password.max'=>'Mật khẩu quá dài !',
            'password.regex'=>'Mật khẩu ít nhất một chữ cái viết hoa, một chữ cái viết thường, một số và một ký tự đặc biệt !',

            'phone.required'=>'Vui lòng nhập số điện thọai !',
            'phone.digits'=>'Số điện thoại gồm 10 chữ số !',
        ];
    }
}
