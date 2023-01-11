<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PrefectureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prefectures')->insert([
            ['region_id' => 1, 'prefectures' => '北海道'],
            ['region_id' => 1, 'prefectures' => '青森県'],
            ['region_id' => 1, 'prefectures' => '岩手県'],
            ['region_id' => 1, 'prefectures' => '宮城県'],
            ['region_id' => 1, 'prefectures' => '秋田県'],
            ['region_id' => 1, 'prefectures' => '山形県'],
            ['region_id' => 1, 'prefectures' => '福島県'],
            ['region_id' => 2, 'prefectures' => '茨城県'],
            ['region_id' => 2, 'prefectures' => '栃木県'],
            ['region_id' => 2, 'prefectures' => '群馬県'],
            ['region_id' => 2, 'prefectures' => '埼玉県'],
            ['region_id' => 2, 'prefectures' => '千葉県'],
            ['region_id' => 2, 'prefectures' => '東京都'],
            ['region_id' => 2, 'prefectures' => '神奈川県'],
            ['region_id' => 3, 'prefectures' => '新潟県'],
            ['region_id' => 3, 'prefectures' => '富山県'],
            ['region_id' => 3, 'prefectures' => '石川県'],
            ['region_id' => 3, 'prefectures' => '福井県'],
            ['region_id' => 3, 'prefectures' => '山梨県'],
            ['region_id' => 3, 'prefectures' => '長野県'],
            ['region_id' => 3, 'prefectures' => '岐阜県'],
            ['region_id' => 3, 'prefectures' => '静岡県'],
            ['region_id' => 3, 'prefectures' => '愛知県'],
            ['region_id' => 4, 'prefectures' => '三重県'],
            ['region_id' => 4, 'prefectures' => '滋賀県'],
            ['region_id' => 4, 'prefectures' => '京都府'],
            ['region_id' => 4, 'prefectures' => '大阪府'],
            ['region_id' => 4, 'prefectures' => '兵庫県'],
            ['region_id' => 4, 'prefectures' => '奈良県'],
            ['region_id' => 4, 'prefectures' => '和歌山県'],
            ['region_id' => 5, 'prefectures' => '鳥取県'],
            ['region_id' => 5, 'prefectures' => '岡山県'],
            ['region_id' => 5, 'prefectures' => '広島県'],
            ['region_id' => 5, 'prefectures' => '山口県'],
            ['region_id' => 5, 'prefectures' => '島根県'],
            ['region_id' => 6, 'prefectures' => '徳島県'],
            ['region_id' => 6, 'prefectures' => '香川県'],
            ['region_id' => 6, 'prefectures' => '愛媛県'],
            ['region_id' => 6, 'prefectures' => '高知県'],
            ['region_id' => 7, 'prefectures' => '福岡県'],
            ['region_id' => 7, 'prefectures' => '佐賀県'],
            ['region_id' => 7, 'prefectures' => '長崎県'],
            ['region_id' => 7, 'prefectures' => '熊本県'],
            ['region_id' => 7, 'prefectures' => '大分県'],
            ['region_id' => 7, 'prefectures' => '宮崎県'],
            ['region_id' => 7, 'prefectures' => '鹿児島県'],
            ['region_id' => 7, 'prefectures' => '沖縄県'],
        ]);
    }
}
