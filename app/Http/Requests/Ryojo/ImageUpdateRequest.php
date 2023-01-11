<?php

namespace App\Http\Requests\Ryojo;

use Illuminate\Foundation\Http\FormRequest;

class ImageUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            "images.max:10" => "選択できる画像は10枚までです。",
            "images.required" => "imageは必須項目です。",
            "images.image" => "指定されたファイルが画像(jpeg,jpg,png,svg)ではありません。",
            "images.max:2048" => "画像のサイズが大きすぎます。"
        ];
    }  
}
