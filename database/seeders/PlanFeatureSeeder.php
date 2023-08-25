<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plan_features')->truncate();
        DB::table('plan_features')->insert([
            [
                'name' => 'products',
                'description' => 'make it easy to manage your products',
                'available' => 1,
            ],
            [
                'name' => 'categories',
                'description' => 'make it easy to manage your categories',
                'available' => 1,
            ],
            [
                'name' => 'warehouses',
                'description' => 'create your warehouses without limits',
                'available' => 2,
            ],
            [
                'name' => 'loyalty_points',
                'description' => 'support loyalty points to your store',
                'available' => 2,
            ],
            [
                'name' => 'employees',
                'description' => 'manager employees',
                'available' => 2,
            ],
            [
                'name' => 'brands',
                'description' => 'manage your brands',
                'available' => 2,
            ],
            [
                'name' => 'suppliers',
                'description' => 'manager suppliers',
                'available' => 3,
            ],
            [
                'name' => 'sms',
                'description' => 'send sms message to your customers',
                'available' => 3,
            ]
        ]);
    }
}
