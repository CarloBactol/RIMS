<?php

namespace Database\Seeders;

use App\Models\InformationFiling;
use Illuminate\Database\Seeder;

class InformationFilingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationFiling::create([
            'residentID' => 1, // Assuming the resident ID from ResidentSeeder
            'filingDate' => now(),
            'filingType' => 'Information',
            'description' => 'Sample information filing',
            // Add other fields as needed
        ]);
    }
}
