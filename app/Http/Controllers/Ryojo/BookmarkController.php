<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function __invoke(Request $request)
    {
        $userId = $request->user()->id;
        $memoryId = $request->memory_id;
       
        if(Bookmark::where('memory_id', $memoryId)->where('user_id', $userId)->exists())
        {
        Bookmark::where('memory_id', $memoryId)->where('user_id', $userId)->delete();
        
        }else{
            $bookmark = new Bookmark;
            $bookmark->memory_id = $memoryId;
            $bookmark->user_id = $userId;
            $bookmark->save();
        };

        //withCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $memory = Memory::where('id',$memoryId)->withCount('bookmarks')->firstOrFail();
        $bookmarksCount = $memory->bookmarks_count;

        //ajaxに渡す値
        $json = [
            'bookmarksCount' => $bookmarksCount,
        ];

        //ajaxに引数の値を返す
        return response()->json($json);
    }
}
