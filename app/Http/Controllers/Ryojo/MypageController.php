<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use App\Services\RyojoService;

class MypageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RyojoService $ryojoservice)
    {
        $user = $request->user();
        $userId = $request->user()->id;
        $myMemories = $ryojoservice->getuserMemories($userId);
        $bookmarkMemoriesId = array();

        $bookmarks = $ryojoservice->getBookmarks($userId);//bookmarkがあれば、みたいなことしたいから
        foreach($bookmarks as $bookmark)
            {
                $bookmarkMemoriesId[] = $bookmark->memory_id;
            }

        return view('ryojo.mypage',compact('user','myMemories','bookmarkMemoriesId'));
    }
}
