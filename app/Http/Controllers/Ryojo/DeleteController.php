<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Memory;
use App\Services\RyojoService;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoService)
    {
        $memoryId = (int)$request->route('memoryId'); //ルートパス
        if(!$ryojoService->checkOwnMemory($request->user()->id,$memoryId)){
            throw new AccessDeniedHttpException();
        }
        $ryojoService->deleteMemory($memoryId);
        return redirect()->route('ryojo.index')->with('feedback.success',"投稿を削除しました");
    }
}

