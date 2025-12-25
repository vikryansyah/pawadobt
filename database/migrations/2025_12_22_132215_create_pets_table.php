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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->integer('age_years')->default(0);
            $table->integer('age_months')->default(0);
            $table->string('breed')->nullable();
            $table->string('size')->nullable(); // small, medium, large
            $table->string('color')->nullable();
            $table->decimal('weight', 5, 2)->nullable();
            $table->text('description');
            $table->text('health_info')->nullable();
            $table->text('personality')->nullable();
            $table->boolean('is_vaccinated')->default(false);
            $table->boolean('is_neutered')->default(false);
            $table->boolean('is_house_trained')->default(false);
            $table->boolean('good_with_kids')->default(false);
            $table->boolean('good_with_dogs')->default(false);
            $table->boolean('good_with_cats')->default(false);
            $table->string('primary_image')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['available', 'pending', 'adopted'])->default('available');
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
