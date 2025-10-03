<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            VisitTypeSeeder::class,
            ChronicDiseaseSeeder::class,
            ServiceSeeder::class,
            AdminPermissionSeeder::class, // Ensure super_admin role/permissions exist first
            RoleSeeder::class,
            AdminUserSeeder::class, // Now assign roles to users
            MedicationSeeder::class,
            AdviceSeeder::class,
        ]);
    }

}
