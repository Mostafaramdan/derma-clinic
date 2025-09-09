<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    {
        $services = [
            [
                'name' => ['ar' => 'كشف جلدية', 'en' => 'Dermatology Consult'],
                'default_price' => 300,
            ],
            [
                'name' => ['ar' => 'جلسة ليزر (منطقة صغيرة)', 'en' => 'Laser Session (Small Area)'],
                'default_price' => 500,
            ],
            [
                'name' => ['ar' => 'تقشير كيميائي خفيف', 'en' => 'Light Chemical Peel'],
                'default_price' => 400,
            ],
            [
                'name' => ['ar' => 'Dermapen', 'en' => 'Dermapen'],
                'default_price' => 600,
            ],
        ];

        foreach ($services as $s) {
            Service::firstOrCreate(['name' => $s['name']], ['default_price' => $s['default_price']]);
        }
    }
}
}
