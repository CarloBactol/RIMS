<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserOfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'password' => bcrypt('adminpass'), // Replace with the hashed password
            'role' => 'Admin',
            // Add other fields as needed
        ]);
    }
}
