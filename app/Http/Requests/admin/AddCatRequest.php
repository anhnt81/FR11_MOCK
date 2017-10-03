<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCatRequest extends FormRequest
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
        if(empty($this->id))
            $err = ['name' => 'required|unique:tb_category,name'];
        else
            $err = ['name' => 'required|unique:tb_category,name,'.$this->id];
        return $err;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên chuyên mục không được bỏ trống',
            'name.unique' => 'Tên chuyên mục đã tồn tại'
        ];
    }
}
