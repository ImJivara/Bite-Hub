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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('RecipeName');
            $table->string('Description');
            $table->string('Steps');
            $table->string('steps_details');
            $table->integer('NbIngredients');
            $table->string('ingredients_details');
            $table->integer('NbLikes');
            $table->boolean('IsApproved')->default(False); 
            $table->string('difficulty_level'); 
            $table->string('thumbnail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
