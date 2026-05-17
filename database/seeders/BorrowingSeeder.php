<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BorrowingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('borrowings')->insert([
            [
                'asset_id' => 2,
                'user_id' => 2,
                'borrow_date' => now(),
                'expected_return' => now()->addDays(7),
                'status' => 'borrowed',
                'notes' => 'Dipinjam untuk operasional',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
