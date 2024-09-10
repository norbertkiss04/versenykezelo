<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('competitions')->insert([
            [
                'name' => 'Spring Championship',
                'year' => 2024,
                'prize_pool' => '10000',
                'start_date' => '2024-03-01',
                'end_date' => '2024-03-15',
            ],
            [
                'name' => 'Summer Tournament',
                'year' => 2024,
                'prize_pool' => '20000',
                'start_date' => '2024-06-01',
                'end_date' => '2024-06-15',
            ],
        ]);
    }
}
