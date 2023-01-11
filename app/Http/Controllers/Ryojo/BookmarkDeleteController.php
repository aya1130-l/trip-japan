<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;


class BookmarkDeleteController extends Controller
{
    public function __invoke(Request $request)
    {
       $bookmarkMemory = Memory::where('id',$request->memoryId)->firstOrFail();
       $bookmarkMemory->bookmarks()->delete();
       $title = $bookmarkMemory -> title;
        return back()->with('bookmark.success',"$title.をお気に入りから削除しました"); 


    }
}
