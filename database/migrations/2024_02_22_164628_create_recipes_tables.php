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
        Schema::create('recipes_tables', function (Blueprint $table) {
            $table->id();
            $table->string('RecipeName');
            $table->string('Description');
            $table->string('Steps');
            $table->integer('NbIngredients');
            $table->integer('NbLikes');
            $table->string('steps_details');
            $table->string('ingredients_details');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes_tables');
    }
};
