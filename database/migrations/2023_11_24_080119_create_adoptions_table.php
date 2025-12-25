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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengadopsi');
            $table->unsignedBigInteger('id_penyedia');
            $table->unsignedBigInteger('kd_pet');
            $table->date('tanggal');
            $table->integer('total_nominal');
            $table->string('mtd_bayar', 50);
            $table->enum('stts_pengiriman', ['dikemas', 'dikirim', 'sampai']);

            $table->foreign('id_pengadopsi')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_penyedia')->references('id')->on('pet_contributors')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            // revisi terbaru
            // $table->foreign('kd_pet')->references('kd')->on('pets')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};
