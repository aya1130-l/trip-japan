<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RyojoService;
use App\Models\Memory;


class TextUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RyojoService $ryojoService)
    {   
        $memoryId = $request->route('memoryId');//ルートパス
        if(!$ryojoService->checkOwnMemory($request->user()->id,$memoryId)){
            throw new AccessDeniedHttpException();
        }
 
        $ryojoService->textupdateMemory(
            $memoryId, 
            $request->session()->get('title'),
            $request->session()->get('content'),
            $request->session()->get('userId'),
            $request->session()->get('prefsName'),
            $request->session()->get('tagsId')
        );

        return redirect()->route('ryojo.index');
        
    }
}
