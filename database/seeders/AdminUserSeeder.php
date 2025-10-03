<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {

    // تأكد من وجود الدورين admin و super_admin
    Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        $user = User::firstOrCreate(
            ['email' => 'admin@clinic.test'],
            [
                'name' => 'Clinic Admin',
                'password' => Hash::make('Admin@12345'), // غيّرها بعدين
                'locale' => 'en', // أو 'ar'
            ]
        );
        // Assign both 'admin' and 'super_admin' roles to ensure all permissions
        if(!$user->hasRole('admin')){
            $user->assignRole('admin');
        }
        if(!$user->hasRole('super_admin')){
            $user->assignRole('super_admin');
        }
    }
}
