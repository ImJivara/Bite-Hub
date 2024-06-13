<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {              
        $user = User::findOrFail(Auth::user()->id);
        $recipe = Recipe::findOrFail($request->recipe_id);
        $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'body' => 'required|string|max:300',
        ]);

        $comment = new Comment(); //or staamel the normal create method
        $comment->user_id = $user->id; // Auth::id()
        $comment->recipe_id = $recipe->id;
        $comment->body = $request->body;
        $comment->save();
        Activity::create([
            'user_id' => $user->id,
            'type' => 'post_comment',
            'subject_type' => 'App\Models\Comment',
            'subject_id' => $recipe->id,
            'description' => 'User ' . $user->name . ' posted the comment: '.$comment->body.' On the post '. $recipe->RecipeName,
            
        ]);

        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
