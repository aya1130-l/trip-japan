<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RyojoService;

class UserpageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoservice)
    {
        $userId = $request->route('userId');
        $user = $ryojoservice->getUsers($userId);
        $userMemories = $ryojoservice->getuserMemories($userId);
        $bookmarkMemoriesId = array();

        $loginUserId = $request->user()->id;
        $bookmarks = $ryojoservice->getBookmarks($loginUserId);
        foreach($bookmarks as $bookmark)
            {
                $bookmarkMemoriesId[] = $bookmark->memory_id;
            }
        return view('ryojo.userpage')->with('user',$user)
                                    ->with('userMemories',$userMemories)
                                    ->with('bookmarkMemoriesId',$bookmarkMemoriesId);
    }
}