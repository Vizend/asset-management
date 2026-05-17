<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('assets')->insert([
            [
                'category_id' => 1,
                'asset_code' => 'AST-0001',
                'name' => 'Laptop Lenovo Thinkpad',
                'brand' => 'Lenovo',
                'model' => 'Thinkpad T14',
                'serial_no' => 'LEN123456',
                'purchase_date' => '2025-01-10',
                'purchase_price' => 15000000,
                'condition' => 'good',
                'status' => 'available',
                'location' => 'Ruang IT',
                'notes' => 'Laptop kerja staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 2,
                'asset_code' => 'AST-0002',
                'name' => 'Desktop Office',
                'brand' => 'Dell',
                'model' => 'OptiPlex',
                'serial_no' => 'DLL987654',
                'purchase_date' => '2024-08-15',
                'purchase_price' => 12000000,
                'condition' => 'good',
                'status' => 'borrowed',
                'location' => 'Finance',
                'notes' => 'Desktop finance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
