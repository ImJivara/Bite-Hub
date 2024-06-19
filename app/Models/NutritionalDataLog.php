<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionalDataLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'log_date',
        'calories',
        'carbs',
        'protein',
        'fat',
        'food',
    ];

    // Define the relationship: each log belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

