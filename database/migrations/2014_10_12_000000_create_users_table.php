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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('email')->unique();
            $table->string('password');
            $table->text('foto', 500)->nullable();
            $table->enum('jenkel', ['laki-laki', 'perempuan', 'lainnya'])->nullable();
            $table->string('no_hp', 15)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->enum('status', ['active', 'suspended', 'banned', 'inactive', 'pending'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
