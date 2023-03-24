<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
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
                'name'=>'HTML',
                'is_modal'=>1,
            ],
            [
                'name'=>'CSS',
                'is_modal'=>1,
            ],
            [
                'name'=>'JavaScript',
                'is_modal'=>1,
            ],
            [
                'name'=>'PHP',
                'is_modal'=>1,
            ],
            [
                'name'=>'Laravel',
                'is_modal'=>1,
            ],
            [
                'name'=>'SQL',
                'is_modal'=>1,
            ],
            [
                'name'=>'SHELL',
                'is_modal'=>1,
            ],
            [
                'name'=>'情報システム基礎知識（その他）',
                'is_modal'=>1,
            ],
        ];
        DB::table('languages')->insert($params);
    }
}
