<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Ryojo\UpdateRequest;
use App\Models\Memory;
use App\Services\RyojoService;

class ImageFormController extends Controller
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

        $memory = Memory::where('id',$memoryId)->firstOrFail();//編集中のmemory
        return view('ryojo.imageform')->with('memory',$memory);

    }

}
