<?php

namespace Database\Seeders;

use App\Models\BarangayLGU;
use Illuminate\Database\Seeder;

class LgusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BarangayLGU::create([
            'firstName' => "Juan",  
            'middleName' => "Cruz",  
            'lastName' => "Luna",  
            'isSecretary' => false,  
            'isTreasurer' => false,  
            'role' => "Captain",  
            // Add other fields as needed
        ]);
        BarangayLGU::create([
            'firstName' => "Carlo",  
            'middleName' => "Jurilla",  
            'lastName' => "Pamor",  
            'isSecretary' => false, 
            'isTreasurer' => false,   
            'role' => "Chairperson",  
            // Add other fields as needed
        ]);
        
        BarangayLGU::create([
            'firstName' => "Dona",  
            'middleName' => "Jurilla",  
            'lastName' => "Mactan",  
            'isSecretary' => false,  
            'isTreasurer' => false,  
            'role' => "Mayor",  
            // Add other fields as needed
        ]);

        BarangayLGU::create([
            'firstName' => "Mike",  
            'middleName' => "Jurilla",  
            'lastName' => "Pamor",  
            'isSecretary' => true,  
            'isTreasurer' => false,  
            'role' => "Councilors",  
            // Add other fields as needed
        ]);

        BarangayLGU::create([
            'firstName' => "Jaime",  
            'middleName' => "Jurilla",  
            'lastName' => "Yao",  
            'isSecretary' => false,  
            'isTreasurer' => true,  
            'role' => "Councilors",  
            // Add other fields as needed
        ]);
    }
}
