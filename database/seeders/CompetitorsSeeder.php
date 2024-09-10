<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitorsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('competitors')->insert([
            [
                'round_id' => 1,
                'user_id' => 1,
            ],
            [
                'round_id' => 1,
                'user_id' => 2,
            ],
            [
                'round_id' => 2,
                'user_id' => 1,
            ],
            [
                'round_id' => 3,
                'user_id' => 2,
            ],
        ]);
    }
}
