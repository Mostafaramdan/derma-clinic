<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@clinic.test'],
            [
                'name' => 'Clinic Admin',
                'password' => Hash::make('Admin@12345'), // غيّرها بعدين
                'locale' => 'en', // أو 'ar'
            ]
        );
        if(!$user->hasRole('admin')){
            $user->assignRole('admin');
        }
    }
}
