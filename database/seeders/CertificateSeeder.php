<?php

namespace Database\Seeders;

use App\Models\Certificate;
use Illuminate\Database\Seeder;

class CertificateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Certificate::create([
            'residentID' => 1, // Assuming the resident ID from ResidentSeeder
            'certificateType' => 'Barangay Clearance',
            'issueDate' => now(),
            'expiryDate' => now()->addYear(), // Assuming a one-year validity
            // Add other fields as needed
        ]);
    }
}
