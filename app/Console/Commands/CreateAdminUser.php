<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    protected $signature = 'clinic:create-admin {--email=root@admin.com} {--name=Clinic Admin} {--password=12345678} {--locale=en}';
    protected $description = 'Create an admin user and assign admin role';

    public function handle(): int
    {
        $email   = $this->option('email');
        $name    = $this->option('name') ?: 'Clinic Admin';
        $password= $this->option('password') ?: str()->random(12);
        $locale  = $this->option('locale') ?? 'en';

        // جميع الصلاحيات من ملف config/permissions.php
        $permissions = config('permissions');

        // إنشاء الصلاحيات
        foreach ($permissions as $perm) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // إنشاء الدورين admin و super_admin
        $roleSuper = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $roleSuper->syncPermissions($permissions);
        $roleAdmin->syncPermissions($permissions);

        $user = \App\Models\User::where('email', $email)->first();
        if ($user) {
            // إذا كان موجود فقط أعطه الدورين والصلاحيات
            $user->assignRole($roleSuper);
            $user->assignRole($roleAdmin);
            $user->syncPermissions($permissions);

            $this->info("User found. Super Admin and Admin roles and all permissions assigned: {$email}");
            return self::SUCCESS;
        } else {
            // إذا لم يكن موجود أنشئه ثم أعطه الدورين والصلاحيات
            $user = \App\Models\User::create([
                'email' => $email,
                'name' => $name,
                'password' => Hash::make($password),
                'locale' => $locale
            ]);
            $user->assignRole($roleSuper);
            $user->assignRole($roleAdmin);
            $user->syncPermissions($permissions);
            $this->info("Super Admin created: {$email}");
            $this->info("Password: {$password}");
            return self::SUCCESS;
        }
    }
}
