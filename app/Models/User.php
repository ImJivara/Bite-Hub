<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password' => 'hashed',
    ];
    public function posts()
    {
        return $this->hasMany(Recipe::class);
    }
    public function likedRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_user')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship: A user can have many followers
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    // Relationship: A user can follow many other users
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }
    // Follow a user
    public function follow($userIdToFollow)
    {
        $this->following()->attach($userIdToFollow);
    }

    // Unfollow a user
    public function unfollow($userIdToUnfollow)
    {
        $this->following()->detach($userIdToUnfollow);
    }

    // Check if a user is following another user
    public function isFollowing($userId)
    {
        return $this->following()->where('followed_id', $userId)->exists();
    }
    
    /**
     * Get the count of users that the user is following.
     *
     * @return int
     */

    public function followingCount()
    {
        return $this->following()->count();
    
    }

    /**
     * Get the count of followers for the user.
     *
     * @return int
     */
    public function followersCount()
    {
        return $this->followers()->count();
    }
}
