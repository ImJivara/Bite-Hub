<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['NbLikes',];
    use HasFactory;
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
