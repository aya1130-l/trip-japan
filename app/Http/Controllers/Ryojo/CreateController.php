<?php

namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use App\Services\RyojoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Memory;
use App\Models\Image;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoService)
    {
        $ryojoService->saveMemory(
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
