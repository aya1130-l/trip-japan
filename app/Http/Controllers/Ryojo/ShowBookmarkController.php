<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use App\Services\RyojoService;

class ShowBookmarkController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoservice)
    {
        $userId = $request->user()->id;
        $bookmarks = $ryojoservice->getbookmarks($userId);
        $bookmarkMemoriesId = [];
        foreach($bookmarks as $bookmark)
            {
                $bookmarkMemoriesId[] = $bookmark->memory_id;
            }
        
        $bookmarkMemories = [];
        foreach($bookmarkMemoriesId as $bookmarkMemoryId)
            {
                $bookmarkMemory = Memory::withCount('bookmarks')->where('id',$bookmarkMemoryId)->firstOrFail();
                $bookmarkMemories[] = $bookmarkMemory;
            }
        return view('ryojo.bookmark')->with('bookmarkMemories',$bookmarkMemories)
                                    ->with('bookmarkMemoriesId',$bookmarkMemoriesId);
    }
}
