<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $teacher = [
            'result.view',
            'result.add',
            'result.edit',
            'result.delete'
        ];

        $employe = [
            ...$teacher,
            'student.view',
            'student.add',
            'student.edit',
            'student.delete',

            'teacher.view',
            'teacher.add',
            'teacher.edit',
            'teacher.delete',

            'subject.view',
            'subject.add',
            'subject.edit',
            'subject.delete',

            'class.view',
            'class.add',
            'class.edit',
            'class.delete',

        ];

        $admin = [
            ...$employe,
            'employe.view',
            'employe.add',
            'employe.edit',
            'employe.delete',
            'archive.view',
            'archive.delete',
            'archive.restore',
            'status.view'
        ];

        $permissions = [
            ...$admin,
            'admin.view',
            'admin.add',
            'admin.edit',
            'admin.delete',
        ];

        foreach($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }

        $role = Role::updateOrCreate(['name' => 'student']);
        $role->givePermissionTo(Permission::findByName('result.view'));

        $role = Role::updateOrCreate(['name' => 'teacher']);
        foreach($teacher as $permission) {
            $role->givePermissionTo(Permission::findByName($permission));
        }

        $role = Role::updateOrCreate(['name' => 'employe']);
        foreach($employe as $permission) {
            $role->givePermissionTo(Permission::findByName($permission));
        }

        $role = Role::updateOrCreate(['name' => 'admin']);
        foreach($admin as $permission) {
            $role->givePermissionTo(Permission::findByName($permission));
        }

        Role::updateOrCreate(['name' => 'Super-Admin']);
    }
}
