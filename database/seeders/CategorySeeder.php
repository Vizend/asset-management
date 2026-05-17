<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            'Laptop',
            'Desktop PC',
            'Printer',
            'Projector',
            'Router',
            'Switch',
            'Access Point',
            'Monitor',
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'description' => $category . ' category',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
