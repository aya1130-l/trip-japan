<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RyojoService;


class ImageUpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RyojoService $ryojoService)
    {
        $memoryId = $request->route('memoryId');
        if(!$ryojoService->checkOwnMemory($request->user()->id,$memoryId)){
            throw new AccessDeniedHttpException();
        }
    
        $ryojoService->imageupdateMemory(
            $memoryId,
            $request->session()->get('title'),
            $request->session()->get('content'),
            $request->session()->get('userId'),
            $request->session()->get('newImagesPath'),
            $request->session()->get('prefsName'),
            $request->session()->get('tagsId')
        );

        return redirect()->route('ryojo.index');
    }
}
