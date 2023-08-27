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
                'description' => 'نحن نثق ان منصتنا تستحق التجربة.',
                'features' => collect(['مميزات خطة البلس']),
            ],
            [
                'name' => 'Basic',
                'price' => 100,
                'description' => 'انطلق في افاق التجارة الالكترونية',
                'features' => collect(['ادارة المنتجات وخصائصه', 'ادارة التصنيفات', 'ادارة المستخدمين'])
            ],
            [
                'name' => 'Pro',
                'price' => 199,
                'description' => 'لا تدع شي يوقفك.',
                'features' => collect(['جميع مميزات خطة بلس', 'مجموعات المستخدمين', 'ادارة المتجر والاحتمالات'])
            ],
        ]);
    }
}
