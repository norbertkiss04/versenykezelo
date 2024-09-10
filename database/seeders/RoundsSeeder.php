<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoundsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rounds')->insert([
            [
                'competition_id' => 1,
                'round_number' => 1,
                'deleted_at' => null,
            ],
            [
                'competition_id' => 1,
                'round_number' => 2,
                'deleted_at' => null,
            ],
            [
                'competition_id' => 2,
                'round_number' => 1,
                'deleted_at' => null,
            ],
        ]);
    }
}
