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
        Schema::create('favorits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pengadopsi');
            $table->unsignedBigInteger('kd_pet');
            
            $table->foreign('id_pengadopsi')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('kd_pet')->references('kd')->on('pets')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorits');
    }
};
