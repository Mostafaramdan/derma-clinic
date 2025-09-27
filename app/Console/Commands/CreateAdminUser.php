<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateAdminUser extends Command
{
    protected $signature = 'clinic:create-admin {email} {--name=Clinic Admin} {--password=12345678} {--locale=en}';
    protected $description = 'Create an admin user and assign admin role';

    public function handle(): int
    {
        $email   = $this->argument('email');
        $name    = $this->option('name') ?: 'Clinic Admin';
        $password= $this->option('password') ?: str()->random(12);
        $locale  = $this->option('locale') ?? 'en';

        // تأكد الجارد "web"
    $roleAdmin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
    $roleSuper = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        $user = \App\Models\User::firstOrCreate(
            ['email' => $email],
            ['name' => $name, 'password' => Hash::make($password), 'locale' => $locale]
        );

        // لازم موديل User فيه use HasRoles; و protected $guard_name='web';
        if (! $user->hasRole('admin')) {
            $user->assignRole($roleAdmin);
        }
        if (! $user->hasRole('super_admin')) {
            $user->assignRole($roleSuper);
        }

        $this->info("Admin created: {$email}");
        $this->info("Password: {$password}");
        return self::SUCCESS;
    }
}
