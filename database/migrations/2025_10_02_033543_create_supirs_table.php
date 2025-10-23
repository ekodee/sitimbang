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
        Schema::create('supirs', function (Blueprint $table) {
            $table->id('supir_id');
            $table->unsignedBigInteger('truk_id')->nullable();
            $table->string('nama', 100);
            $table->string('no_ktp', 20);
            $table->string('no_hp', 20);
            $table->timestamps();

            $table->foreign('truk_id')->references('truk_id')->on('truks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supirs');
    }
};
