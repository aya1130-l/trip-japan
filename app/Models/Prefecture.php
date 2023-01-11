<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    public function memory(){

        return $this->belongsToMany(Memory::class,'memories_prefectures')->using(MemoryPrefecture::class);

    }

    public function region(){
        
        return $this->belongsTo(Region::class);
    
    }

}
