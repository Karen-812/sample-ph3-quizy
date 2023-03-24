<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $params = [
            [
                'name'=>'N予備校',
                'is_modal'=>1,
            ],
            [
                'name'=>'ドットインストール',
                'is_modal'=>1,
            ],
            [
                'name'=>'POSSE課題',
                'is_modal'=>1,
            ],
        ];

        DB::table('contents')->insert($params);
    }
}
