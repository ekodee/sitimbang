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
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seeder lain (izin, wilayah, dll)
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            KecamatanSeeder::class,
            UserSeeder::class,
        ]);

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
            $timbangan->berat_truk = $truk->berat_truk;
            $timbangan->berat_total = $truk->berat_truk + $timbangan->berat_sampah;
            $timbangan->save();
        });
    }
}
