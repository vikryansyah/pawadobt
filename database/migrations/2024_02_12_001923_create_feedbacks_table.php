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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('kd');
            $table->unsignedBigInteger('id_penyedia');
            $table->unsignedBigInteger('id_pengadopsi');
            $table->integer('rating')->nullable();
            $table->string('message', 200)->nullable();
            
            $table->foreign('id_pengadopsi')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_penyedia')->references('id')->on('pet_contributors')->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
