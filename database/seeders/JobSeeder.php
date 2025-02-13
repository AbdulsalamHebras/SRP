<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JobSeeder extends Seeder
{
    public function run()
    {
        $yemenCities = ['صنعاء', 'عدن', 'تعز', 'الحديدة', 'المكلا', 'إب', 'سيئون', 'الغيضة', 'ذمار', 'حجة'];

        $currencies = ['USD', 'YER', 'SAR'];

        for ($i = 0; $i < 100; $i++) {
            DB::table('jobs')->insert([
                'jobName' => 'وظيفة ' . Str::random(5),
                'description' => 'هذه وصف مختصر للوظيفة ' . Str::random(10),
                'jobType' => ['دوام كامل', 'دوام جزئي', 'عن بُعد'][array_rand(['دوام كامل', 'دوام جزئي', 'عن بُعد'])],
                'minSalary' => rand(500, 2000),
                'maxSalary' => rand(2500, 10000),
                'currency' => $currencies[array_rand($currencies)],
                'category_id' => rand(1, 10),
                'company_id' => rand(1, 50),
                'requirements' => 'متطلبات الوظيفة: خبرة لا تقل عن سنتين',
                'expirationDate' => now()->addDays(rand(30, 90)),
                'location' => $yemenCities[array_rand($yemenCities)], 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}