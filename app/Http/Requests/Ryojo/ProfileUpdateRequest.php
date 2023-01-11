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
            'name' => 'required|max:255',
            'profile' => 'max:1000',      
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "nameは必須項目です。",
            "name.max:255" => "nameが長すぎます(255文字まで)。",
            "profile.max:1000" => "profileが長すぎます(1000字まで)"
        ];
    }  
}
