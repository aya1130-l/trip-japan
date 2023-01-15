<?php
declare(strict_types=1);

namespace App\Modules\ImageUpload;

use Illuminate\Support\Facades\Storage;

class LocalImageManager implements ImageManagerInterface
{
    public function save($file): string
    {
        $path = (string) Storage::putFile('public/images/memory/', $file);//任意のファイル名で保存
        $array = (array) explode("/", $path);
        return end($array);//ファイル名取得
    }

    public function delete(string $name): void
    {
        $filePath = 'public/images/memory/' . $name;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
