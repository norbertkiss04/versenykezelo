<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AppUsersSeeder::class,
            CompetitionsSeeder::class,
            RoundsSeeder::class,
            CompetitorsSeeder::class,
        ]);
    }
}
