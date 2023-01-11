<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ryojo\ProfileUpdateRequest;
use App\Services\RyojoService;
use App\Models\Memory;


class MypageUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ProfileUpdateRequest $request, RyojoService $ryojoservice)

    {
        $userId = $request->user()->id;
        $myMemories = Memory::where('user_id',$userId);
        $name = $request->name();
        $profile = $request->profile();
        $ryojoservice->UpdateUserProfile($name,$profile,$userId);

        return redirect()->route('ryojo.mypage',['myMemories' => $myMemories])
                        ->with('feedback.success',"プロフィールを編集しました。");
    }
}
