<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VisitType;

class VisitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $types = [
            ['ar' => 'كشف',       'en' => 'Consultation'],
            ['ar' => 'متابعة',    'en' => 'Follow-up'],
            ['ar' => 'جلسة ليزر', 'en' => 'Laser Session'],
        ];

        foreach ($types as $t) {
            VisitType::firstOrCreate(['name' => $t]);
        }
    }
}
