<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Trial',
                'price' => 0,
            ],
            [
                'name' => 'Basic',
                'price' => 10,
            ],
            [
                'name' => 'Pro',
                'price' => 20,
            ],
        ]);
    }
}
