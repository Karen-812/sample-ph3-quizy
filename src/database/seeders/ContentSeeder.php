<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
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
        $now = CarbonImmutable::now();
        $params = [
            [
                'name'=>'N予備校',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'ドットインストール',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'=>'POSSE課題',
                'is_modal'=>1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('contents')->insert($params);
    }
}
