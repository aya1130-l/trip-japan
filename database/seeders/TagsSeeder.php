<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'id' => 1,
                'tagname' => '温泉',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'tagname' => '旅館',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'tagname' => 'おいしいごはん',
                'created_at' => now(),
                'updated_at' => now(),              
            ],
            [
                'id' => 4,
                'tagname' => '絶景',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'tagname' => '山登り',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'tagname' => '川下り',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'tagname' => 'キャンプ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'tagname' => 'アウトドア',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'tagname' => '桜',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'tagname' => '花火',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'tagname' => '海',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'tagname' => '紅葉',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'tagname' => '雪景色',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 14,
                'tagname' => '自然',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 15,
                'tagname' => '森林浴',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 16,
                'tagname' => '伝統工芸',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 17,
                'tagname' => '寺社仏閣',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 18,
                'tagname' => 'その他',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
