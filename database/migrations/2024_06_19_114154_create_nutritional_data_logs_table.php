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
        
            Schema::create('nutritional_data_logs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                // $table->string('food');
                $table->date('log_date');
                $table->decimal('calories', 10, 2)->default(0);
                $table->decimal('carbs', 10, 2)->default(0);
                $table->decimal('protein', 10, 2)->default(0);
                $table->decimal('fat', 10, 2)->default(0);
                $table->timestamps();
    
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unique(['user_id', 'log_date']); // Ensure each user has only one log per day
            });
      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutritional_data_logs');
    }
};
