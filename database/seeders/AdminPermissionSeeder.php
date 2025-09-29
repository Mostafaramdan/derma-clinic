<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // جلب أول مستخدم
        $admin = User::orderBy('id')->first();
        if(!$admin) return;

        // إنشاء دور السوبر أدمن إذا لم يكن موجود
        $role = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);

        // جلب كل الصلاحيات أو إنشائها
        $permissions = [
            'patients.view', 'visits.view', 'prescriptions.view', 'labs.manage', 'files.manage', 'admin.panel',
            // صلاحيات الأمراض المزمنة
            'chronic-diseases.view',
            'chronic-diseases.create',
            'chronic-diseases.update',
            'chronic-diseases.delete',
        ];
        foreach($permissions as $perm){
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // ربط كل الصلاحيات بالدور
        $role->syncPermissions(Permission::all());

        // تعيين الدور للمستخدم
        $admin->assignRole('super_admin');
    }
}
