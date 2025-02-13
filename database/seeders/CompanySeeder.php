<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = \Faker\Factory::create();
        $yemeniCities = ['صنعاء', 'عدن', 'تعز', 'حضرموت', 'الحديدة', 'إب', 'ذمار', 'المكلا', 'سيئون', 'صعدة'];
        $websites = []; 

        for ($i = 0; $i < 100; $i++) {
            do {
                $website = $faker->unique()->domainName; // توليد موقع فريد
            } while (in_array($website, $websites)); // التحقق من عدم تكراره

            $websites[] = $website;
            DB::table('companies')->insert([
                'name' => $faker->company,
                'email' => $faker->unique()->companyEmail,
                'password' => bcrypt('password'),
                'jobField' => $faker->jobTitle,
                'mission' => $faker->sentence,
                'vision' => $faker->sentence,
                'dateOfCreation' => $faker->date(),
                'aboutus' => $faker->paragraph,
                'logo' => 'default.png',
                'website' => "https://$website",
                'phoneNumber' => '77' . rand(10000000, 99999999),
                'commercialRegister' => 'sample.pdf',
                'location' => $faker->randomElement($yemeniCities),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}