<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RyojoService;

class FormController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoservice)
    {
        $tags = $ryojoservice->getTags(); //eloquentコレクションが返ってくる
        $Tohokuprefs = $ryojoservice->getTohokuPrefs();
        $Kantoprefs = $ryojoservice->getKantoPrefs();
        $Chubuprefs = $ryojoservice->getChubuPrefs();
        $Kinkiprefs = $ryojoservice->getKinkiPrefs();
        $Chugokuprefs = $ryojoservice->getChugokuPrefs();
        $Shikokuprefs = $ryojoservice->getShikokuPrefs();
        $Kyusyuprefs = $ryojoservice->getKyusyuPrefs();
        $selectedprefsName = [];

        $title="";
        $content="";
        
        return view('ryojo.textform')->with('tags',$tags)->with('Tohokuprefs',$Tohokuprefs)
                                ->with('Kantoprefs',$Kantoprefs)->with('Chubuprefs',$Chubuprefs)
                                ->with('Kinkiprefs',$Kinkiprefs)->with('Chugokuprefs',$Chugokuprefs)
                                ->with('Shikokuprefs',$Shikokuprefs)->with('Kyusyuprefs',$Kyusyuprefs)
                                ->with('selectedprefsName',$selectedprefsName)->with('title',$title)
                                ->with('content',$content);
    }
}