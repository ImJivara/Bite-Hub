<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'recipe_id', 'body',
    ];
    
    public function post()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
