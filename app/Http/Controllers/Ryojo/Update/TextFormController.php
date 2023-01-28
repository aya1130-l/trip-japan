<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException; //今ログインしている人のmemoryじゃないですよ
use App\Services\RyojoService;

class TextFormController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RyojoService $ryojoservice)
    {
        $memoryId = $request->route('memoryId');
        if(!$ryojoservice->checkOwnMemory($request->user()->id,$memoryId)){
            throw new AccessDeniedHttpException();
        }

        $tags = $ryojoservice->getTags(); //eloquentコレクション
        $memory = Memory::where('id',$memoryId)->firstOrFail();
        $Tohokuprefs = $ryojoservice->getTohokuPrefs();
        $Kantoprefs = $ryojoservice->getKantoPrefs();
        $Chubuprefs = $ryojoservice->getChubuPrefs();
        $Kinkiprefs = $ryojoservice->getKinkiPrefs();
        $Chugokuprefs = $ryojoservice->getChugokuPrefs();
        $Shikokuprefs = $ryojoservice->getShikokuPrefs();
        $Kyusyuprefs = $ryojoservice->getKyusyuPrefs();
        
        $selectedtags = $memory->tags->toArray(); //eloquentコレクションを配列に
        if($selectedtags){
            foreach($selectedtags as $selectedtag){
                $selectedtagsId[] = $selectedtag['id']; //選択済みのtagidを配列に放り込んでる
            };
        }
        else{
            $selectedtagsId = [];
        }
        
        $selectedprefs = $memory->prefectures->toArray();
        foreach($selectedprefs as $selectedpref){
                $selectedprefsName[] = $selectedpref['prefectures']; //選択済みのprefidを配列に放り込んでる
            };


        return view('ryojo.ud-textform')->with('memory',$memory)->with('tags',$tags)
                                    ->with('Tohokuprefs',$Tohokuprefs)
                                    ->with('Kantoprefs',$Kantoprefs)->with('Chubuprefs',$Chubuprefs)
                                    ->with('Kinkiprefs',$Kinkiprefs)->with('Chugokuprefs',$Chugokuprefs)
                                    ->with('Shikokuprefs',$Shikokuprefs)->with('Kyusyuprefs',$Kyusyuprefs)
                                    ->with('selectedtagsId',$selectedtagsId)
                                    ->with('selectedprefsName',$selectedprefsName);
    }
}
