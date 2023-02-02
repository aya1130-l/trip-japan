<?php
//ここでは、入力情報をformに渡してリダイレクトする
namespace App\Http\Controllers\Ryojo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RyojoService;
use App\Models\Prefecture;

class PostReviseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request,RyojoService $ryojoservice)
    {
        $title = $request->session()->get('title');
        $content = $request->session()->get('content');
        $userId = $request->session()->get('userId');
        $selectedprefsName = $request->session()->get('prefsName');
        $selectedtagsId = $request->session()->get('tagsId');
        $newImagesPath = $request->session()->get('newImagesPath');
        $ryojoservice->tmpimgdelete($newImagesPath);

        $tags = $ryojoservice->getTags();
        $prefs = $ryojoservice->getPrefs();
        $Tohokuprefs = $ryojoservice->getTohokuPrefs();
        $Kantoprefs = $ryojoservice->getKantoPrefs();
        $Chubuprefs = $ryojoservice->getChubuPrefs();
        $Kinkiprefs = $ryojoservice->getKinkiPrefs();
        $Chugokuprefs = $ryojoservice->getChugokuPrefs();
        $Shikokuprefs = $ryojoservice->getShikokuPrefs();
        $Kyusyuprefs = $ryojoservice->getKyusyuPrefs();

        return view('ryojo.textform',compact('title','content','tags','prefs','selectedtagsId','selectedprefsName',
                                            'Tohokuprefs','Kantoprefs','Chubuprefs','Kinkiprefs','Chugokuprefs','Shikokuprefs','Kyusyuprefs'));

    }
}
