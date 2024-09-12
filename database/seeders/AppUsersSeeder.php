<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppUsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('app_users')->insert([
            [
                'username' => 'peter_kovacs',
                'email' => 'peter.kovacs@example.hu',
                'phone_number' => '0612345678',
                'address' => 'Budapest, Andrássy út 10, 1061',
            ],
            [
                'username' => 'anna_szabo',
                'email' => 'anna.szabo@example.hu',
                'phone_number' => '0620987654',
                'address' => 'Debrecen, Piac utca 12, 4024',
            ],
            [
                'username' => 'gabor_nagy',
                'email' => 'gabor.nagy@example.hu',
                'phone_number' => '0670123456',
                'address' => 'Győr, Baross út 15, 9021',
            ],
            [
                'username' => 'katinka_toth',
                'email' => 'katinka.toth@example.hu',
                'phone_number' => '0670987654',
                'address' => 'Pécs, Kossuth tér 7, 7621',
            ],
        ]);
    }
}
