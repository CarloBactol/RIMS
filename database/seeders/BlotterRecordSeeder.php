<?php

namespace Database\Seeders;

use App\Models\BlotterRecord;
use Illuminate\Database\Seeder;

class BlotterRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlotterRecord::create([
            'residentID' => 1, // Assuming the resident ID from ResidentSeeder
            'date' => now(),
            'description' => 'Sample blotter record',
            // Add other fields as needed
        ]);
    }
}
