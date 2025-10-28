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
        Schema::create('truks', function (Blueprint $table) {
            $table->id('truk_id');
            $table->string('no_polisi', 20)->unique();
            $table->string('jenis_truk', 50);
            $table->decimal('berat_truk', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truks');
    }
};
