<?php

namespace Database\Seeders;

use Carbon\CarbonImmutable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = CarbonImmutable::now();
        $param = [
            'id' => 1,
            'date' => $now,
            'hours' => 1,
            'language_id' => 5,
            'content_id' => 2,
            'user' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        $param = [
            'id' => 2,
            'date' => $now,
            'hours' => 1,
            'language_id' => 3,
            'content_id' => 1,
            'user' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ];
        DB::table('input_data')->insert($param);
    }
}
