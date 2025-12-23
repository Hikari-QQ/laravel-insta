<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Olivia',
            'email' => 'olivia@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1
        ]);
        User::create([
            'name' => 'Billie',
            'email' => 'billie@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Kate',
            'email' => 'kate@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Kevin',
            'email' => 'kevin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);
        User::create([
            'name' => 'Tom',
            'email' => 'tom@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 2
        ]);
    }
}


