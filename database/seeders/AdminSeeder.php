<?php

namespace Database\Seeders;

use App\Models\AppAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        AppAdmin::firstOrCreate(
            ['username' => 'SuperAdmin'],
            [
                'password' => Hash::make('password'),
                'last_login' => null,
                'last_login_ip' => null,
            ]
        );

        AppAdmin::firstOrCreate(
            ['username' => 'Admin'],
            [
                'password' => Hash::make('password'),
                'last_login' => null,
                'last_login_ip' => null,
            ]
        );
    }
}

