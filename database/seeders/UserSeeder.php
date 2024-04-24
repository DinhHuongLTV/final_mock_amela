<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nguyen Van A',
            'email' => 'a1977@gmail.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Nguyen Van B',
            'email' => 'b2002@gmail.com',
            'password' => Hash::make('code'),
        ]);
    }
}
