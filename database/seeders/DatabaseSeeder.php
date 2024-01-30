<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        $this->call([
            UsersTableSeeder::class,
            ResidentSeeder::class,
            InformationFilingSeeder::class,
            BlotterRecordSeeder::class,
            CertificateSeeder::class,
            // UserOfficerSeeder::class,
            LgusSeeder::class,
            BusinessPermitSeeder::class,
            // Add more seeders if needed
        ]);
    }
}
