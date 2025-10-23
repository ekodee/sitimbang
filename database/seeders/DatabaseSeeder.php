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


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Truk::factory(5)->create();
        Supir::factory(25)->create();
        // Timbangan::factory(100)->create();

        $roles = ['superadmin', 'admin', 'operator'];

        foreach ($roles as $role) {
            Role::create([
                'role_name' => $role
            ]);
        }

        User::create([
            'role_id' => '2',
            'name' => 'Admin DLH',
            'email' => 'admin@teamdlh.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'role_id' => '3',
            'name' => 'Operator DLH',
            'email' => 'operator@teamdlh.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'role_id' => '1',
            'name' => 'Super Admin',
            'email' => 'superadmin@teamdlh.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
