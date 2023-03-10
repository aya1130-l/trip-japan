<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\ImageUpdateRequest;
use App\Models\Memory;
use App\Models\Tag;
use App\Services\RyojoService;
use App\Models\Prefecture;



class ImageConfirmController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ImageUpdateRequest $request, RyojoService $ryojoService)
    {
        $memoryId = $request->route('memoryId');
        if(!$ryojoService->checkOwnMemory($request->user()->id,$memoryId)){
            throw new AccessDeniedHttpException();
        }
    
        //テキストデータはsessionから、画像はリクエストから
        $title = $request->session()->get('title');
        $content = $request->session()->get('content');
        $userId = $request->session()->get('userId');
        $prefsName = $request->session()->get('prefsName');
        $tagsId = $request->session()->get('tagsId');
        $newImages = $request->images();//uploadクラスのインスタンス

        $newImagesPath = $ryojoService->imgStore($newImages);//アップロードされた画像のフルパス

        session()->put(['newImagesPath'=>$newImagesPath]);//アップロードファイルインスタンスはセッションに入れられないためファイル名

        if($tagsId){
        foreach($tagsId as $tagId)//投稿編集時に初期値を表示するために必要
            {
                $tag = Tag::where('Id',$tagId)->firstOrFail();
                $tags[] = $tag;
            }
        }
        else{
            $tags = [];
        }

        foreach($prefsName as $prefName)
            {
                $pref = Prefecture::where('prefectures',$prefName)->firstOrFail();
                $prefs[] = $pref;
            }

        $memory = Memory::where('id',$memoryId)->firstOrFail();//編集中のmemory
        return view('ryojo.ud-imageconfirm',compact('memory','title','content','userId','tags','prefs','newImages','newImagesPath'));

    }
}
