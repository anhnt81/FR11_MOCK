<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email'  => 'required|max:40|unique:tb_user,email,' . $this->id,
            'pass'   => 'nullable|min:8|max:16',
            'repass' => 'same:pass',
            'phone'  => 'required|regex:/^[0-9]+$/|min:10|max:11',
            'avatar' => 'nullable|mimes:jpeg,png,jpg'
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
            'email.required' => 'Email không được bỏ trống',
            'email.email'    => 'Email không đúng định dạng',
            'pass.min'       => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'pass.max'       => 'Mật khẩu chỉ được phép tối đa 16 ký tự',
            'repass.same'    => 'Mật khẩu nhập lại không khớp',
            'phone.required' => 'Số điện thoại không được trống',
            'phone.min'      => 'Số điện thoại phải ít nhất 10 số',
            'phone.max'      => 'Số điện thoại tối đa 11 số',
            'phone.regex'    => 'Số điện thoại phải là phải số',
            'avatar.mines'   => 'Chỉ chấp nhận ảnh jpg, jpeg, png'
        ];
    }
}
