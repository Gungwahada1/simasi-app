<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Daftar permissions dengan UUID
        $permissions = [
            ['name' => 'absent-full', 'uuid' => Str::uuid()],
            ['name' => 'absent-index', 'uuid' => Str::uuid()],
            ['name' => 'absent-create', 'uuid' => Str::uuid()],
            ['name' => 'student-full', 'uuid' => Str::uuid()],
            ['name' => 'student-index', 'uuid' => Str::uuid()],
            ['name' => 'student-show', 'uuid' => Str::uuid()],
            ['name' => 'subject-full', 'uuid' => Str::uuid()],
            ['name' => 'subject-index', 'uuid' => Str::uuid()],
            ['name' => 'subject-show', 'uuid' => Str::uuid()],
            ['name' => 'user-full', 'uuid' => Str::uuid()],
            ['name' => 'role-full', 'uuid' => Str::uuid()],
            ['name' => 'role-index', 'uuid' => Str::uuid()],
            ['name' => 'role-show', 'uuid' => Str::uuid()],
            ['name' => 'permission-full', 'uuid' => Str::uuid()],
            ['name' => 'permission-index', 'uuid' => Str::uuid()],
        ];

        // Membuat permissions jika belum ada
        foreach ($permissions as $permissionData) {
            Permission::firstOrCreate(
                ['name' => $permissionData['name']],
                ['uuid' => $permissionData['uuid']]
            );
        }

        // Membuat role "Magang" dengan UUID dan menetapkan permissions
        $roleMagang = Role::firstOrCreate(
            ['name' => 'Magang'],
            ['uuid' => Str::uuid()]
        );
        $roleMagang->syncPermissions([
            'absent-index',
            'absent-create',
            'student-index',
            'student-show',
            'subject-index',
            'subject-show',
        ]);

        // Membuat role "Paruh Waktu" dengan UUID dan menetapkan permissions
        $roleParuhWaktu = Role::firstOrCreate(
            ['name' => 'Paruh Waktu'],
            ['uuid' => Str::uuid()]
        );
        $roleParuhWaktu->syncPermissions([
            'absent-index',
            'absent-create',
            'student-index',
            'student-show',
            'subject-index',
            'subject-show',
        ]);

        // Membuat role "Pegawai Tetap" dengan UUID dan menetapkan permissions
        $rolePegawaiTetap = Role::firstOrCreate(
            ['name' => 'Pegawai Tetap'],
            ['uuid' => Str::uuid()]
        );
        $rolePegawaiTetap->syncPermissions([
            'absent-full',
            'student-full',
            'subject-full',
            'user-full',
            'role-index',
            'role-show',
            'permission-index',
        ]);

        // Membuat role "Admin" dengan UUID dan menetapkan permissions
        $roleAdmin = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['uuid' => Str::uuid()]
        );
        $roleAdmin->syncPermissions([
            'absent-full',
            'student-full',
            'subject-full',
            'user-full',
            'role-full',
            'permission-full',
        ]);

        // Membuat role "Developer" dengan UUID dan menetapkan permissions
        $roleDeveloper = Role::firstOrCreate(
            ['name' => 'Developer'],
            ['uuid' => Str::uuid()]
        );
        $roleDeveloper->syncPermissions([
            'absent-full',
            'student-full',
            'subject-full',
            'user-full',
            'role-full',
            'permission-full',
        ]);
    }
}
