<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =
            [
                [
                    'email' => 'superadmin@teamdlh.com',
                    'name' => 'Super Admin',
                    'username' => 'superadmin',
                    'nik' => '1231231231231231',
                    'jabatan' => 'Admin Sistem',
                    'role' => 'superadmin',
                ],
                [
                    'email' => 'admin@teamdlh.com',
                    'name' => 'Admin DLH',
                    'username' => 'admin',
                    'nik' => '3213213213213213',
                    'jabatan' => 'Admin Lapangan',
                    'role' => 'admin',
                ],
                [
                    'email' => 'operator@teamdlh.com',
                    'name' => 'Operator Timbangan',
                    'username' => 'operator',
                    'nik' => '2312312312312312',
                    'jabatan' => 'Petugas Timbangan',
                    'role' => 'operator',
                ],
            ];

        foreach ($users as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'username' => $u['username'],
                    'nik' => $u['nik'],
                    'jabatan' => $u['jabatan'],
                    'email_verified_at' => now(),
                    'password' => Hash::make('Bersih@123'),
                    'remember_token' => Str::random(10),
                ]
            );
            $user->assignRole($u['role']);
            if ($u['role'] === 'superadmin') {
                $user->givePermissionTo(Permission::all());
            }
        }
    }
}
