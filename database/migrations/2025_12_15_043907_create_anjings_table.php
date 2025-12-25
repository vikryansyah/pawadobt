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
    Schema::create('anjings', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('ras');
        $table->integer('umur'); // bulan
        $table->enum('gender', ['Jantan', 'Betina']);
        $table->enum('status', ['Tersedia', 'Proses Adopsi']);
        $table->timestamps();
    }); 
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anjings');
    }
};


