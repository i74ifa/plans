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
                'id' => PlanType::Weekly,
                'period' => '+7 day',
            ],
            [
                'id' => PlanType::Monthly,
                'period' => '+1 month',
            ],
            [
                'id' => PlanType::EveryThreeMonth,
                'period' => '+3 month',
            ],
            [
                'id' => PlanType::Yearly,
                'period' => '+1 year',
            ]
        ]);
    }
}
