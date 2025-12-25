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
        Schema::create('pet_healths', function (Blueprint $table) {
            $table->id('kd');
            $table->unsignedBigInteger('kd_pet');
            $table->string('foto_cekdokter', 255);
            $table->string('stts_vaksin', 255);
            $table->string('stts_steril', 255);
            $table->string('riwayat_penyakit', 255);
            $table->timestamps();

            // $table->foreign('kd_pet')->references('kd')->on('pets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_healths');
    }
};
