<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\UpdateRequest;
use App\Models\Memory;
use App\Services\RyojoService;


class SelectController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, RyojoService $ryojoService)
    {
        $memoryId = $request->route('memoryId');
        if(!$ryojoService->checkOwnMemory($request->user()->id,$memoryId)){
        }

        //フォームの内容requestからもらってきてsessionに追加
        $title = $request->title();
        $content = $request->content();
        $userId = $request->userId();
        $prefsName = $request->prefsName();
        $tagsId = $request->tagsId();
        session()->put(['memoryId'=>$memoryId,'title'=>$title,'content'=>$content,'userId'=>$userId,'prefsName'=>$prefsName,'tagsId'=>$tagsId]); //sessionにデータ追加している

        //画像編集するか確認する画面へ、編集中のmemoryの画像を表示
        $memory = Memory::where('id',$memoryId)->firstOrFail();
        return view('ryojo.select')->with('memory',$memory);

    }
}
