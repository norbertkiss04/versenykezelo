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
                'username' => 'john_doe',
                'email' => 'john@example.com',
                'phone_number' => '123456789',
                'address' => '123 Elm St, Springfield',
            ],
            [
                'username' => 'jane_doe',
                'email' => 'jane@example.com',
                'phone_number' => '987654321',
                'address' => '456 Oak St, Springfield',
            ],
            [
                'username' => 'admin_user',
                'email' => 'admin@example.com',
                'phone_number' => '555555555',
                'address' => '789 Pine St, Springfield',
            ],
        ]);
    }
}
