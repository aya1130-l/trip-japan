<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class RegionSeeder extends Seeder
{
    /**
     * Run the database seedquits.
     *
     * @return void
     */
    public function run()
    {
        DB::table('regions')->insert([
            ['regions' => '北海道地方・東北地方'],
            ['regions' => '関東地方'],
            ['regions' => '中部地方'],
            ['regions' => '近畿地方'],
            ['regions' => '中国地方'],
            ['regions' => '四国地方'],
            ['regions' => '九州地方'],
        ]);
    }
}
