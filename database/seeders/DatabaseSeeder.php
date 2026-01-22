<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RolePermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'nayem',
            'email' => 'admin@gmail.com',
            'phone' => '01840308835',
            'shop_name' => 'Deal prime',
            'role' => 'Admin',
            'password' => 'admin@gmail.com',
            'status'=> 1 ,
        ]);



        $this->call([
            SettingSeeder::class,
            RolePermissionSeeder::class,
        ]);


    }
}