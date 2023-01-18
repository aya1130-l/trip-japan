<?php

namespace App\Http\Requests\Ryojo;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            //
        ];
    }

    public function search()
    {
        return $this -> input('search');
    }

    public function searchtagsId():array
    {
        return $this -> input('searchtag.*',[]); //formのcheckboxの中身,valueにtagのidを指定しているのでこの場合はid取得
    }

    public function searchprefs():array
    {
        return $this -> input('searchpref.*',[]);
    }


}
