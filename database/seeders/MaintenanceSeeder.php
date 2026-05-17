<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('maintenances')->insert([
            [
                'asset_id' => 1,
                'performed_by' => 1,
                'maintenance_date' => now(),
                'next_maintenance' => now()->addMonths(6),
                'cost' => 500000,
                'vendor' => 'Service Center Lenovo',
                'description' => 'Cleaning and thermal paste',
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
