<?php
// app/Models/NutritionalData.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalData extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id', // Ensure recipe_id is fillable
        'calories',
        'carbs',
        'fat',
        'protein',
        'bad',
        'good',
        'nutrients',
        
    ];

    // Define the inverse of the one-to-one relationship with Recipe
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
