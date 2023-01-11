<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function memory(){

        return $this->belongsToMany(Memory::class,'memories_tags')->using(MemoryTag::class);

    }

}
