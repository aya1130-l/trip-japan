<?php

namespace App\Http\Controllers\Ryojo\Update;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RyojoService;
use App\Models\Memory;

class TextReviseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, RyojoService $ryojoservice)
    {
        $memoryId = $request->session()->get('memoryId');
        $title = $request->session()->get('title');
        $content = $request->session()->get('content');
        $userId = $request->session()->get('userId');
        $selectedprefsName = $request->session()->get('prefsName');
        $selectedtagsId = $request->session()->get('tagsId');

        $tags = $ryojoservice->getTags();
        $prefs = $ryojoservice->getPrefs();
        $Tohokuprefs = $ryojoservice->getTohokuPrefs();
        $Kantoprefs = $ryojoservice->getKantoPrefs();
        $Chubuprefs = $ryojoservice->getChubuPrefs();
        $Kinkiprefs = $ryojoservice->getKinkiPrefs();
        $Chugokuprefs = $ryojoservice->getChugokuPrefs();
        $Shikokuprefs = $ryojoservice->getShikokuPrefs();
        $Kyusyuprefs = $ryojoservice->getKyusyuPrefs();

        $memory = Memory::where('id',$memoryId)->firstOrFail();

        return view('ryojo.ud-textform',compact('memory','title','content','tags','prefs','selectedtagsId','selectedprefsName',
                                                'Tohokuprefs','Kantoprefs','Chubuprefs','Kinkiprefs','Chugokuprefs','Shikokuprefs','Kyusyuprefs'));
    }
}
