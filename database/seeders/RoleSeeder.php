<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $perms = [
            'patients.view','patients.create','patients.update',
            'visits.view','visits.create','visits.update',
            'billing.manage','labs.manage','files.manage','admin.panel'
        ];
        foreach($perms as $p){ Permission::firstOrCreate(['name'=>$p]); }

        $admin = Role::firstOrCreate(['name'=>'admin']);
        $doctor = Role::firstOrCreate(['name'=>'doctor']);
        $reception = Role::firstOrCreate(['name'=>'receptionist']);

        $admin->givePermissionTo(Permission::all());
        $doctor->givePermissionTo(['patients.view','visits.view','visits.create','visits.update','billing.manage','labs.manage','files.manage']);
        $reception->givePermissionTo(['patients.view','patients.create','visits.view','visits.create']);
    }
}
