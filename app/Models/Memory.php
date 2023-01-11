<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

    public function user()//リレーションメソッド
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'memories_tags')->using(MemoryTag::class);
    }

    public function images()
    {
        return $this->belongsToMany(Image::class,'memories_images')->using(MemoryImage::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function prefectures()
    {
        return $this->belongsToMany(Prefecture::class,'memories_prefectures')->using(MemoryPrefecture::class);
    }
}
