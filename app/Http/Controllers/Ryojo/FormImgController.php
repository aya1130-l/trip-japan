<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\CreateRequest;
use App\Models\Tag;
use App\Models\Prefecture;
use App\Services\RyojoService;

class FormImgController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request)
    {
        //フォームの内容requestからもらってきてsessionに追加
        $title = $request->title();
        $content = $request->content();
        $userId = $request->userId();
        $prefsName = $request->prefsName();
        $tagsId = $request->tagsId();
        session()->put(['title'=>$title,'content'=>$content,'userId'=>$userId,'prefsName'=>$prefsName,'tagsId'=>$tagsId]); //sessionにデータ追加している

        return view('ryojo.imageform');
    }


}
