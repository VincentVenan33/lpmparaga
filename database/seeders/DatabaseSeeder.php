<?php

namespace Database\Seeders;

use App\Models\UsersModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        UsersModel::create([
            'name' => 'Venansius Fortunatus Wijaya',
            'username' => 'ven',
            'email' => 's@gmail.com',
            'role' => 'SUPER_ADMIN',
            'status' => '1',
            'password' => Hash::make('admin')
        ]);
        UsersModel::create([
            'name' => 'Venansius Fortunatus Wijaya',
            'username' => 'ven',
            'email' => 'a@gmail.com',
            'role' => 'ADMIN',
            'status' => '1',
            'password' => Hash::make('admin')
        ]);
        UsersModel::create([
            'name' => 'Venansius Fortunatus Wijaya',
            'username' => 'ven',
            'email' => 'd@gmail.com',
            'role' => 'USER',
            'status' => '1',
            'password' => Hash::make('admin')
        ]);
    }
}