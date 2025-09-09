<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChronicDisease;

class ChronicDiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $diseases = [
            ['ar' => 'سكر',   'en' => 'Diabetes'],
            ['ar' => 'ضغط',   'en' => 'Hypertension'],
            ['ar' => 'ربو',   'en' => 'Asthma'],
            ['ar' => 'قلب',   'en' => 'Heart Disease'],
        ];

        foreach ($diseases as $d) {
            ChronicDisease::firstOrCreate(['name' => $d]);
        }
    }
}
