<?php

namespace App\Services;

use App\Models\Memory;
use App\Models\Image;
use App\Models\Tag;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Prefecture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Modules\ImageUpload\ImageManagerInterface;



class RyojoService
{
    //本番環境ではcloudinaryに画像をアップロードするため
    public function __construct(private ImageManagerInterface $imageManager)
    {}

    public function getMemories()
    {
        return Memory::withCount('bookmarks')->with(['tags','images','prefectures'])->orderBy('created_at', 'DESC')->get(); //クエリビルダで降順にしたあとget()で取得,各eloquentモデルはクエリビルダ使用可能
        //withはeagerloading,クエリの発行回数減らす
        //withCountでリレーションの数取得
        //戻り値はCollectionのインスタンス
    }

    public function getBookmarks(int $userId)
    {
        return Bookmark::where('user_id',$userId)->get();
     
    }

    public function getTags()
    {
        return Tag::orderBy('id','ASC')->get();
    }

    public function getPrefs()
    {
        return Prefecture::orderBy('id','ASC')->get();
    }

    public function getTohokuPrefs()
    {
        return Prefecture::where('region_id','=','1')->orderBy('id','ASC')->get();
    }

    public function getKantoPrefs()
    {
        return Prefecture::where('region_id','=','2')->orderBy('id','ASC')->get();
    }

    public function getChubuPrefs()
    {
        return Prefecture::where('region_id','=','3')->orderBy('id','ASC')->get();
    }

    public function getKinkiPrefs()
    {
        return Prefecture::where('region_id','=','4')->orderBy('id','ASC')->get();
    }

    public function getChugokuPrefs()
    {
        return Prefecture::where('region_id','=','5')->orderBy('id','ASC')->get();
    }

    public function getShikokuPrefs()
    {
        return Prefecture::where('region_id','=','6')->orderBy('id','ASC')->get();
    }

    public function getKyusyuPrefs()
    {
        return Prefecture::where('region_id','=','7')->orderBy('id','ASC')->get();
    }


    public function getImages() //inputtype=fileのvalueはファイルパス
    {
        return Image::orderBy('created_at','ASC')->get();
    }

    public function getUsers(int $userId)
    {
        return User::where('id',$userId)->first();
    }


    public function checkOwnMemory(int $userId, int $memoryId):bool
    {
        $memory = Memory::where('id',$memoryId)->first();
        if(!$memory) {
            return false;
        }
        return $memory->user_id === $userId; //===はデータ型も一致している
    }

    public function getuserMemories(int $userId)
    {
        return Memory::with(['tags','images'])->withCount('bookmarks')->where('user_id',$userId)->orderBy('created_at','DESC')->get();
    }

    public function UpdateUserProfile(string $name, $profile, int $userId)
    {
        DB::transaction(function () use ($name, $profile, $userId){
            $user = User::where('id',$userId)->first();
            $user->name = $name;
            $user->profile = $profile;
            $user->save();
        });
    }


    //image保存(投稿前確認用)
    public function imgStore($images)//file型はarray型に変換できないからここタイプヒンティングでarrayにしない
    {
            foreach($images as $image) 
                {
                    $name = $this->imageManager->save($image);//任意のファイル名で画像保存後、フルパス(publicId)を返す
                    $imagesName[] = $name;
                 } 
            return  $imagesName;    
    }

    //投稿修正時imageを削除
    public function tmpimgdelete($newImagesName)
    {
            foreach($newImagesName as $newImageName){
                $this->imageManager->delete($newImageName);
        }
    }
        

    //投稿
    public function saveMemory(string $title, string $content, int $userId, array $newImagesName, array $prefsName, array $tagsId)
    {
        DB::transaction(function () use ($title, $content, $userId, $newImagesName, $prefsName, $tagsId){ //transactionはクロージャ使用する必要があるらしい
            $memory = new Memory;
            $memory->title = $title;
            $memory->content =  $content;
            $memory->user_id = $userId;
            $memory->save();
            
            foreach($newImagesName as $newImageName)
             { 
                $imageModel = new Image;
                $imageModel->name = $newImageName;//cloudinaryにおける画像ファイルのフルパス(publicId)
                $imageModel->save();
                $memory->images()->attach($imageModel->id); //新たな紐付け
            }
            
                //memory保存後にtagを中間テーブルへ
                $memory->tags()->attach($tagsId); //中間テーブルにデータ追加、引数は挿入先のID、重複可能、
            
                //memory保存後にprefectureを中間テーブルへ
                $prefsId = [];
                foreach($prefsName as $prefName)
                {
                    $pref = Prefecture::where('prefectures',$prefName)->firstOrFail();
                    $prefsId[] = $pref->id;
                }
                $memory->prefectures()->attach($prefsId);
            });
    }

     //投稿更新(画像変更なし)
     public function textupdateMemory(int $memoryId, string $title, string $content, int $userId, array $prefsName, array $tagsId)
     {
         DB::transaction(function () use ($memoryId, $title, $content, $userId, $prefsName, $tagsId) {
             $memory = Memory::where('id', $memoryId)->firstOrFail();
             $memory->title = $title;
             $memory->content =  $content;
             $memory->user_id = $userId;
             $memory->save();
             
      
             //memory保存後にtagを中間テーブルへデータ追加
                 $memory->tags()->sync($tagsId); //重複不可なのでsync、この時配列tagsIdの中身一気に追加できる
             
            //memory保存後にprefectureを中間テーブルへ    
             $prefsId = [];
             foreach($prefsName as $prefName)
             {
                 $pref = Prefecture::where('prefectures',$prefName)->firstOrFail();
                 $prefsId[] = $pref->id;
             }
             $memory->prefectures()->sync($prefsId);
        });
     }

    //投稿更新(画像変更あり)
    public function imageupdateMemory(int $memoryId, string $title, string $content, int $userId, array $newImagesName, array $prefsName, array $tagsId)
    {
        DB::transaction(function () use ($memoryId, $title, $content, $userId, $newImagesName, $prefsName, $tagsId) {
            $memory = Memory::where('id', $memoryId)->firstOrFail();
            $memory->title = $title; 
            $memory->content =  $content;
            $memory->user_id = $userId;
            $memory->save();

            //以前のimage削除
            $memory->images()->each(function ($image) use ($memory)
            {
                $this->imageManager->delete($image->name);//画像ファイル削除
                $memory->images()->detach($image->id); //紐付を削除
                $image->delete(); //$imageのレコード削除

            });

            //新規の画像保存
             foreach($newImagesName as $newImageName)
             { 
                $imageModel = new Image;
                $imageModel->name = $newImageName;
                $imageModel->save();
                $memory->images()->attach($imageModel->id); //新たな紐付け
            }
            
            //memory保存後にtagを中間テーブルへデータ追加
            $memory->tags()->sync($tagsId); //重複不可なのでsync、この時配列tagsIdの中身一気に追加できる
            
            //memory保存後にprefectureを中間テーブルへ
            $prefsId = [];
            foreach($prefsName as $prefName)
            {
                $pref = Prefecture::where('prefectures',$prefName)->firstOrFail();
                $prefsId[] = $pref->id;
            }
            $memory->prefectures()->sync($prefsId);
            });
    }

    

     //投稿削除
     public function deleteMemory(int $memoryId)
     {
         DB::transaction(function () use ($memoryId) {
             $memory = Memory::where('id', $memoryId)->firstOrFail();
             $memory->images()->each(function ($image) use ($memory){//eachメソッドでコレクションの中身取り出し、中身をそのままコールバックすることができる
                $this->imageManager->delete($image->name);//画像ファイル削除
                 $memory->images()->detach($image->id); //紐付を削除
                 $image->delete(); //$imageのレコード削除
             });
             $memory->delete(); //メモリー削除
         });
     }

}