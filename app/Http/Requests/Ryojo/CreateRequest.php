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
            'pref' => 'required',
             ];
    }

    public function messages()
    {
        return [
            "title.required" => "titleは必須項目です。",
            "pref.required" => "都道府県を選んでください。",
        ];
    }  

    public function content()
    {
        return $this -> input('content');
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
