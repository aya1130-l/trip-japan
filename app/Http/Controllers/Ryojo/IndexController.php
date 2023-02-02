<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use App\Services\RyojoService;
use Illuminate\Support\Facades\Auth;
use App\Models\Memory;
use App\Models\Tag;
use App\Models\Prefecture;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\SearchRequest;


class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RyojoService $ryojoservice, SearchRequest $request)
    {
        $tags = $ryojoservice->getTags()->sort();
        $Tohokuprefs = $ryojoservice->getTohokuPrefs();
        $Kantoprefs = $ryojoservice->getKantoPrefs();
        $Chubuprefs = $ryojoservice->getChubuPrefs();
        $Kinkiprefs = $ryojoservice->getKinkiPrefs();
        $Chugokuprefs = $ryojoservice->getChugokuPrefs();
        $Shikokuprefs = $ryojoservice->getShikokuPrefs();
        $Kyusyuprefs = $ryojoservice->getKyusyuPrefs();
       
        $user = $request->user();
        $userId = Auth::id();
        $bookmarkMemoriesId = array();

        $search = $request -> search();
        $searchprefs = $request -> searchprefs();
        $searchtags = $request ->searchtagsId();

        $query = Memory::query(); //クエリビルダ
        
                
         //クエリ文が格納されている変数->join('結合するテーブル名', '結合元テーブル名.結合するカラム名', '=', '結合先テーブル名.リンクするカラム名')

        
        if($userId)
        {
            $bookmarks = $ryojoservice->getBookmarks($userId);
            foreach($bookmarks as $bookmark)
            {
                $bookmarkMemoriesId[] = $bookmark->memory_id;
            }
        }


        if($search or $searchprefs or $searchtags)
        {

                $spaceConversion = mb_convert_kana($search,'s');//全角スペースを半角スペースに
                $wordArraySearched = preg_split("/[\s,]+/", $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
                
                foreach($wordArraySearched as $value)
                {
                $query->where(function($query) use($value){
                        $query->Where('title', 'LIKE', '%'.$value.'%')
                            ->orWhere('content', 'LIKE', '%'.$value.'%');//whereの順番
                        });
                    }

                $i=0;
                foreach($searchprefs as $pref)
                {
                $whereHas = ($i == 0) ? 'whereHas' : 'orWhereHas';
                $query->$whereHas('prefectures',function($query)use($pref){
                    $query->where('prefectures',$pref);      
                    });
                $i++;
                }

                $j=0;
                foreach($searchtags as $tag)
                {
                $whereHas = ($j == 0) ? 'whereHas' : 'orWhereHas';
                $query->$whereHas('tags',function($query) use($tag){
                    $query->where('id',$tag);
                    });
                $j++;
                }      
                        
        }
        
        $memories = $query->orderBy('created_at', 'DESC')->withCount('bookmarks')->get();
        $popularMemories = Memory::withCount('bookmarks')->orderBy('bookmarks_count','desc')->limit(5)->get();
    
        return view('ryojo.index',compact('user','memories','popularMemories','tags','search','searchprefs','searchtags',
                                            'bookmarkMemoriesId','Tohokuprefs','Kantoprefs','Chubuprefs','Kinkiprefs','Chugokuprefs','Shikokuprefs','Kyusyuprefs'));
        
    }
}

