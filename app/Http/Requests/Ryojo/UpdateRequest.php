<?php

namespace App\Http\Requests\Ryojo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //trueなら誰でもOK状態
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required'
             ];
    }

    public function messages()
    {
        return [
            "title.required" => "titleは必須項目です。",
            "content.required" => "contentは必須項目です。"
        ];
    }  

}
