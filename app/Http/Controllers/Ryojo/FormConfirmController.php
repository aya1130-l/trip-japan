<?php
namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\ImageUpdateRequest;
use App\Models\Tag;
use App\Models\Prefecture;
use App\Services\RyojoService;


class FormConfirmController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ImageUpdateRequest $request,RyojoService $ryojoService)
    {
        $title = $request->session()->get('title');
        $content = $request->session()->get('content');
        $userId = $request->session()->get('userId');
        $prefsName = $request->session()->get('prefsName');
        $tagsId = $request->session()->get('tagsId');
       
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
    
        foreach($prefsName as $prefName)
            {
                $pref = Prefecture::where('prefectures',$prefName)->firstOrFail();
                $prefs[] = $pref;    
            }

        $newImages = $request->images();//uploadクラスのインスタンス
        $newImagesPath = $ryojoService->imgStore($newImages);//アップロードされた画像のフルパス

        session()->put(['title'=>$title,'content'=>$content,'userId'=>$userId,'prefsName'=>$prefsName, 
                        'tagsId'=>$tagsId,'tags'=>$tags,'prefs'=>$prefs,'newImagesPath'=>$newImagesPath]);

        return view('ryojo.formconfirm')->with('title',$title)
                                    ->with('content',$content)->with('userId',$userId)
                                    ->with('tags',$tags)->with('prefs',$prefs)
                                    ->with('newImagesPath',$newImagesPath);
    }
}
