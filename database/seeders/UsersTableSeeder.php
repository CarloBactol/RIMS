<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'password' => bcrypt('adminpass'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Employee User',
            'email' => 'employee@email.com',
            'password' => bcrypt('adminpass'),
            'role' => 'employee',
        ]);
    }
}
