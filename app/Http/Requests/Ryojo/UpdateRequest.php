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

    public function content()
    {
        return $this -> input('content'); //input:指定したキー名の値を取得
    }

    public function title()
    {
        return $this -> input('title');
    }

    public function userId()
    {
        return $this -> user()->id; //requestのuser()は今ログインしているユーザー情報を返してくれる
        //webガードがデフォルトで設定されており、providerの設定からusersテーブルの情報をeloquentモデルにして返す
    }

    public function tagsId():array
    {
        return $this -> input('tag.*',[]); //formのcheckboxの中身,valueにtagのidを指定しているのでこの場合はid取得
    }

    public function prefsName():array
    {
        return $this -> input('pref.*',[]);
    }

}
