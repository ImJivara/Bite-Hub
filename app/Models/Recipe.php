<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    
    use HasFactory;
   
    protected $fillable = [
        'user_id',
        'RecipeName',
        'Description',
        'Steps',
        'steps_details',
        'NbIngredients',
        'ingredients_details',
        'NbLikes',
        'IsApproved',
        'difficulty_level',
        'thumbnail',
        'cooking_time',
        'preparation_time',
        'Nutritional_data',
        'Category',
        'Health_Score'
    ];

    // Define the one-to-one relationship with NutritionalData
    public function nutritionalData()
    {
        return $this->hasOne(NutritionalData::class, 'recipe_id');
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'recipe_user')->withTimestamps();
    }

    

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
