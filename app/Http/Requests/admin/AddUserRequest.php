<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'email'  => 'required|max:40|unique:tb_user,email',
            'pass'   => 'required|min:8|max:16',
            'repass' => 'required|same:pass',
            'phone'  => 'required|regex:/^[0-9]+$/|min:10|max:11',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required'  => 'Email không được bỏ trống',
            'email.email'     => 'Email không đúng định dạng',
            'email.unique'    => 'Email đã tồn tại',
            'pass.required'   => 'Mật khẩu không được bỏ trống',
            'pass.min'        => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'pass.max'        => 'Mật khẩu chỉ được phép tối đa 16 ký tự',
            'repass.required' => 'Hãy nhập lại mật khẩu',
            'repass.same'     => 'Mật khẩu nhập lại không khớp',
            'phone.required'  => 'Số điện thoại không được trống',
            'phone.min'       => 'Số điện thoại phải ít nhất 10 số',
            'phone.max'       => 'Số điện thoại tối đa 11 số',
            'phone.regex'     => 'Số điện thoại phải là phải số',
        ];
    }
}
