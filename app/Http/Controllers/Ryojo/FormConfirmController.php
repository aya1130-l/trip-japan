<?php
//ここでは、formbladeで入力された情報を取ってくる+確認画面へ送る処理
namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\CreateRequest;
use App\Models\Tag;
use App\Models\Prefecture;
use App\Services\RyojoService;;


class FormConfirmController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request,RyojoService $ryojoService)
    {
        $title = $request->title();
        $content = $request->content();
        $userId = $request->userId();
        $prefsName = $request->prefsName();
        $tagsId = $request->tagsId();
        $newImages = $request->images();//uploadクラスのインスタンス
        

        if($tagsId){
            foreach($tagsId as $tagId)
                {
                    $tag = Tag::where('Id',$tagId)->firstOrFail();
                    $tags[] = $tag;
                }
            }
            else{
                $tags = [];
            }
    
        if($prefsName){
            foreach($prefsName as $prefName)
                {
                    $pref = Prefecture::where('prefectures',$prefName)->firstOrFail();
                    $prefs[] = $pref;    
                }
            }
            else{
                $prefs = [];
            }


        $newImagesName = $ryojoService->imgStore($newImages);//アップロードされた画像のフルパス


        session()->put(['title'=>$title,'content'=>$content,'userId'=>$userId,'prefsName'=>$prefsName, 
                        'tagsId'=>$tagsId,'tags'=>$tags,'prefs'=>$prefs,'newImagesName'=>$newImagesName]);

        return view('ryojo.formconfirm')->with('title',$title)
                                    ->with('content',$content)->with('userId',$userId)
                                    ->with('tags',$tags)->with('prefs',$prefs)
                                    ->with('newImagesName',$newImagesName);
    }
}
