<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'laporan-list',
            'laporan-create',
            'laporan-edit',
            'laporan-delete',
            'timbangan-list',
            'timbangan-create',
            'timbangan-edit',
            'timbangan-delete',
            'supir-list',
            'supir-create',
            'supir-edit',
            'supir-delete',
            'truk-list',
            'truk-create',
            'truk-edit',
            'truk-delete',
        ];

        foreach ($permissions as $permission) {
            $permission = Permission::create(['name' => $permission]);
        }
    }
}
