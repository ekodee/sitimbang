<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Kecamatan;
use App\Models\Truk;
use App\Models\Supir;
use App\Models\Timbangan;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder lain (izin, wilayah, dll)
        $this->call([
            PermissionSeeder::class,
            KecamatanSeeder::class,
        ]);

        // --- Role & User ---
        $roles = ['superadmin', 'admin', 'operator'];
        foreach ($roles as $role) {
            SpatieRole::firstOrCreate(['name' => $role]);
        }

        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@teamdlh.com'],
            [
                'name' => 'Super Admin',
                'username' => 'superadmin',
                'nik' => '1231231231231231',
                'jabatan' => 'Admin Sistem',
                'email_verified_at' => now(),
                'password' => Hash::make('Bersih@123'),
                'remember_token' => Str::random(10),
            ]
        );
        $superadmin->assignRole('superadmin');
        $superadmin->givePermissionTo(Permission::all());

        $admin = User::firstOrCreate(
            ['email' => 'admin@teamdlh.com'],
            [
                'name' => 'Admin DLH',
                'username' => 'admin',
                'nik' => '3213213213213213',
                'jabatan' => 'Admin Lapangan',
                'email_verified_at' => now(),
                'password' => Hash::make('Bersih@123'),
                'remember_token' => Str::random(10),
            ]
        );
        $admin->assignRole('admin');

        $operator = User::firstOrCreate(
            ['email' => 'operator@teamdlh.com'],
            [
                'name' => 'Operator Timbangan',
                'username' => 'operator',
                'nik' => '2312312312312312',
                'jabatan' => 'Petugas Timbangan',
                'email_verified_at' => now(),
                'password' => Hash::make('Bersih@123'),
                'remember_token' => Str::random(10),
            ]
        );
        $operator->assignRole('operator');

        // --- Data Dummy Otomatis ---
        $kecamatan = Kecamatan::all();

        // Buat 20 truk
        $truks = Truk::factory(20)->create();

        // Buat 100 supir yang otomatis terhubung ke truk & kecamatan
        $supirs = Supir::factory(100)->make()->each(function ($supir) use ($truks, $kecamatan) {
            $supir->truk_id = $truks->random()->truk_id;
            $supir->kecamatan_id = $kecamatan->random()->kecamatan_id;
            $supir->save();
        });

        // Buat 300 data timbangan acak
        Timbangan::factory(300)->make()->each(function ($timbangan) use ($truks, $supirs) {
            $supir = $supirs->random();
            $truk = $truks->where('truk_id', $supir->truk_id)->first() ?? $truks->random();

            $timbangan->truk_id = $truk->truk_id;
            $timbangan->supir_id = $supir->supir_id;
            $timbangan->save();
        });
    }
}
