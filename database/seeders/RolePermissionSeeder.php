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
            ['name' => 'absent-index', 'uuid' => Str::uuid()],
            ['name' => 'absent-create', 'uuid' => Str::uuid()],
            ['name' => 'absent-store', 'uuid' => Str::uuid()],
            ['name' => 'absent-show', 'uuid' => Str::uuid()],
            ['name' => 'absent-edit', 'uuid' => Str::uuid()],
            ['name' => 'absent-update', 'uuid' => Str::uuid()],
            ['name' => 'absent-delete', 'uuid' => Str::uuid()],
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
            'absent-show',
        ]);

        // Membuat role "Paruh Waktu" dengan UUID dan menetapkan permissions
        $roleParuhWaktu = Role::firstOrCreate(
            ['name' => 'Paruh Waktu'],
            ['uuid' => Str::uuid()]
        );
        $roleParuhWaktu->syncPermissions([
            'absent-index',
            'absent-create',
            'absent-store',
            'absent-show',
            'absent-edit',
            'absent-update',
        ]);

        // Membuat role "Pegawai Tetap" dengan UUID dan menetapkan permissions
        $rolePegawaiTetap = Role::firstOrCreate(
            ['name' => 'Pegawai Tetap'],
            ['uuid' => Str::uuid()]
        );
        $rolePegawaiTetap->syncPermissions([
            'absent-index',
            'absent-create',
            'absent-store',
            'absent-show',
            'absent-edit',
            'absent-update',
            'absent-delete',
        ]);
    }
}
