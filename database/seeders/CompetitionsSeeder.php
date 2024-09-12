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
                'name' => 'Tavaszi Bajnokság',
                'year' => 2024,
                'prize_pool' => '15000',
                'start_date' => '2024-04-01',
                'end_date' => '2024-04-10',
            ],
            [
                'name' => 'Nyári Kupa',
                'year' => 2024,
                'prize_pool' => '3000',
                'start_date' => '2024-07-01',
                'end_date' => '2024-07-15',
            ],
        ]);
    }
}
