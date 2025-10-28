<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timbangans', function (Blueprint $table) {
            $table->id('timbangan_id');
            $table->unsignedBigInteger('truk_id');
            $table->unsignedBigInteger('supir_id')->nullable();
            $table->string('status');
            $table->decimal('berat_total', 10, 2);
            $table->decimal('berat_truk', 10, 2);
            $table->decimal('berat_sampah', 10, 2);
            $table->string('nama_petugas');
            $table->timestamps();

            $table->foreign('truk_id')->references('truk_id')->on('truks')->onDelete('restrict');
            $table->foreign('supir_id')->references('supir_id')->on('supirs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timbangans');
    }
};
