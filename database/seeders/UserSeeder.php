<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
           'name' => 'Ram Bahadur',
           'email' => 'ram@gmail.com',
           'password' => Hash::make('ram123')
        ]);

        User::create([
            'name' => 'Admin Bahadur',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);

        User::create([
            'name' => 'Shyam Bahadur',
            'email' => 'shyam@gmail.com',
            'password' => Hash::make('shyam123')
        ]);
    }
}
