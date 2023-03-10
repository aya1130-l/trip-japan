<?php

namespace App\Http\Requests\Ryojo;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;//trueなら誰でもおけ
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required'  
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "nameは必須項目です。"
        ];
    }  

    public function name()
    {
        return $this -> input('name');
    }

    public function profile()
    {
        return $this -> input('profile');
    }
}

