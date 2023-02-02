<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use Illuminate\Support\Facades\Auth;
use App\Services\RyojoService;

class MemoryDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoservice)
    {
        $memoryId = $request->route('memoryId');
        $memory = Memory::where('id',$memoryId)->withCount('bookmarks')->firstOrFail();

        $userId = Auth::id();
        $bookmarkMemoriesId = array();

        if($userId)
        {
            $bookmarks = $ryojoservice->getBookmarks($userId);
            foreach($bookmarks as $bookmark)
            {
                $bookmarkMemoriesId[] = $bookmark->memory_id;
            }
        }

        return view('ryojo.memory',compact('memory','bookmarkMemoriesId'));
    }
}
