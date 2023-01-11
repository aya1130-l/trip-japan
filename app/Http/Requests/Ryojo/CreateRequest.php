<?php

namespace App\Http\Requests\Ryojo;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() //リクエストを認証できるか判定させる
    {
        return true; //trueの場合は誰でもリクエスト可能
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
            'content' => 'required',
            'images' => 'required|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,svg|max:2048' //配列の中身に対するバリデーション
             ];
    }

    public function messages()
    {
        return [
            "title.required" => "titleは必須項目です。",
            "content.required" => "contentは必須項目です。",
            "images.required" => "imageは必須項目です。",
            "images.max:10" => "選択できる画像は10枚までです。",
            "images.mimes:jpeg,png,jpg,svg" => "指定されたファイルが画像(jpeg,jpg,png,svg)ではありません。",
            "images.max:2048" => "画像のサイズが大きすぎます。"
        ];
    }  
}
