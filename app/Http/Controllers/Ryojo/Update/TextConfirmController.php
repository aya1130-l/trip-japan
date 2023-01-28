<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\UpdateRequest;
use App\Models\Memory;
use App\Models\Tag;
use App\Models\Prefecture;
use App\Services\RyojoService;

class TextConfirmController extends Controller
{
    
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RyojoService $ryojoService)
    {
        $memoryId = $request->route('memoryId');
        if(!$ryojoService->checkOwnMemory($request->user()->id,$memoryId)){
            throw new AccessDeniedHttpException();
        }
        //sessionからデータ取得
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

        $memory = Memory::where('id',$memoryId)->firstOrFail();
        return view('ryojo.ud-textconfirm')->with('memory',$memory)->with('title',$title)
                                        ->with('content',$content)->with('userId',$userId)
                                        ->with('tags',$tags)->with('prefs',$prefs);

    }

}