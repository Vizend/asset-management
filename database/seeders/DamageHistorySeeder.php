<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DamageHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('damage_histories')->insert([
            [
                'asset_id' => 2,
                'reported_by' => 2,
                'damage_date' => now(),
                'description' => 'keyboard tidak berfungsi',
                'severity' => 'medium',
                'repair_status' => 'repairing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
