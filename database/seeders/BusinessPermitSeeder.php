<?php

namespace Database\Seeders;

use App\Models\BusinessPermit;
use Illuminate\Database\Seeder;

class BusinessPermitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BusinessPermit::create([
            'residentID' => 1, // Assuming the resident ID from ResidentSeeder
            'businessName' => 'Occidental Glass and Aluminum Supply',
            'businessAddress' => 'Zone 1 Camela Hom St.',
            // Add other fields as needed
        ]);
        BusinessPermit::create([
            'residentID' => 2, // Assuming the resident ID from ResidentSeeder
            'businessName' => 'Occidental Glass and Aluminum Supply',
            'businessAddress' => 'Zone 2 Camela Hom St.',
            // Add other fields as needed
        ]);
    }
}
