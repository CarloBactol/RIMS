<?php

namespace Database\Seeders;

use App\Models\Resident;
use Illuminate\Database\Seeder;

class ResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resident::create([
            'firstName' => 'John',
            'middleName' => 'Cruz',
            'lastName' => 'Doe',
            'nationality' => 'Filipino',
            'civilStatus' => 'Single',
            'age' => 24,
            'dateOfBirth' => '1990-01-01',
            'address' => '123 Main St',
            'contactNumber' => '01234567890',
            'barangay' => 'Quibaol',
            'gender' => 'Male',
            // Add other fields as needed
        ]);
        Resident::create([
            'firstName' => 'Kat',
            'middleName' => 'Yao',
            'lastName' => 'Neri',
            'nationality' => 'Filipino',
            'civilStatus' => 'Single',
            'age' => 24,
            'dateOfBirth' => '1999-10-27',
            'address' => '123 Main St',
            'contactNumber' => '01234567891',
            'barangay' => 'Quibaol',
            'gender' => 'Female',
            // Add other fields as needed
        ]);
    }
}
