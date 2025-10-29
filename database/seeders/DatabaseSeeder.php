<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Supir;
use App\Models\Timbangan;
use App\Models\Truk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //     $this->call(PermissionSeeder::class);

        //     $roles = ['superadmin', 'admin', 'operator'];
        //     foreach ($roles as $role) {
        //         SpatieRole::firstOrCreate(['name' => $role]);
        //     }

        //     $superadmin = User::create([
        //         'name' => 'Super Admin',
        //         'username' => 'superadmin',
        //         'nik' => '123123123',
        //         'jabatan' => 'Admin Sistem',
        //         'email' => 'superadmin@teamdlh.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('Bersih@123'),
        //         'remember_token' => Str::random(10),
        //     ]);

        //     $superadmin->assignRole('superadmin');
        //     $superadmin->givePermissionTo(Permission::all());

        //     $admin = User::create([
        //         'name' => 'Admin DLH',
        //         'username' => 'admin',
        //         'nik' => '321321321',
        //         'jabatan' => 'Admin Lapangan',
        //         'email' => 'admin@teamdlh.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ]);
        //     $admin->assignRole('admin');

        //     $operator = User::create([
        //         'name' => 'Operator Timbangan',
        //         'username' => 'operator',
        //         'nik' => '987987987',
        //         'jabatan' => 'Petugas Timbangan',
        //         'email' => 'operator@teamdlh.com',
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ]);
        //     $operator->assignRole('operator');

        //     $truk1 = Truk::create([
        //         'no_polisi' => 'B 1234 ABC',
        //         'jenis_truk' => 'Dump Truck',
        //         'berat_truk' => 8000,
        //     ]);

        //     $truk2 = Truk::create([
        //         'no_polisi' => 'B 5678 XYZ',
        //         'jenis_truk' => 'Compactor',
        //         'berat_truk' => 9000,
        //     ]);

        //     $supir1 = Supir::create([
        //         'truk_id' => $truk1->truk_id,
        //         'nama' => 'Ahmad S',
        //         'no_ktp' => '3171023001110001',
        //         'no_hp' => '081234567890',
        //     ]);

        //     $supir2 = Supir::create([
        //         'truk_id' => $truk2->truk_id,
        //         'nama' => 'Budi P',
        //         'no_ktp' => '3171023002220002',
        //         'no_hp' => '081298765432',
        //     ]);

        //     Timbangan::create([
        //         'truk_id' => $truk1->truk_id,
        //         'supir_id' => $supir1->supir_id,
        //         'status' => 'Selesai',
        //         'berat_total' => 12500,
        //         'berat_truk' => 8000,
        //         'berat_sampah' => 4500,
        //         'nama_petugas' => 'Petugas A',
        //     ]);

        //     Timbangan::create([
        //         'truk_id' => $truk2->truk_id,
        //         'supir_id' => $supir2->supir_id,
        //         'status' => 'Selesai',
        //         'berat_total' => 14500,
        //         'berat_truk' => 9000,
        //         'berat_sampah' => 5500,
        //         'nama_petugas' => 'Petugas B',
        //     ]);
        // }


        Truk::factory(20)->create();
        Supir::factory(100)->create();
    }
}
