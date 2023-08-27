<?php

namespace Database\Seeders;

use App\Models\PlanType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plan_types')->truncate();
        DB::table('plan_types')->insert([
            [
                'id' => PlanType::Monthly,
                'discount' => 0,
                'months_count' => 1,
            ],
            [
                'id' => PlanType::EveryThreeMonth,
                'discount' => 15,
                'months_count' => 3,
            ],
            [
                'id' => PlanType::Yearly,
                'discount' => 20,
                'months_count' => 12,
            ]
        ]);
    }
}
