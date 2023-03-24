<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
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
        $now = CarbonImmutable::now();
        $params = [
            [
                'name'=>'HTML',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'CSS',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'JavaScript',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'PHP',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'Laravel',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'SQL',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'SHELL',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'情報システム基礎知識（その他）',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        DB::table('languages')->insert($params);
    }
}
