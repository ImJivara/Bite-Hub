<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class RecipeController extends Controller
{
    public function getRecipes(Request $request)
    {  
        if($request->id==null)
        {
            $recipes=Recipe::all();
            $FeaturedRecipe = $recipes->sortByDesc('NbLikes')->first();
            $MostRecentRecipe=$recipes->sortByDesc('created_at')->first();
            // dd($MostRecentRecipe);
            return view('Recipes',['rec'=>$recipes,'featuredrec'=>$FeaturedRecipe] );
        }
        else{
            $recipe=Recipe::findOrFail($request->id);
            if($recipe==null) dd("such post doesnt exist");
            else
            $ingredients=$recipe->ingredients_details;
            $ingredients=explode("-",$ingredients);
            $step=$recipe->steps_details;
            $step=explode("-",$step);
            return view('Recipe',['r'=>$recipe,'ing'=>$ingredients,'steps'=>$step] );
        } 
    }
    
    public function getStep(Request $request)
    {   
        $recipe=Recipe::findOrFail($request->id);
        if($recipe==null) dd("such post doesnt exist");
        else
        $step=$recipe->steps_details;
        $step=explode("-",$step);
        return view('step',['steps'=>$step,'rec'=>$recipe]);


    }

    public function getIng(Request $request)
    {
        $recipe=Recipe::findOrFail($request->id);
        if($recipe==null) dd("such post doesnt exist");
        else
        $Ing=$recipe->ingredients_details;
        $Ing=explode("-",$Ing);
        return view('Ingredients',['Ing'=>$Ing,'rec'=>$recipe]);

    }
    public function IncLike(Request $request)
    {   $recipe=Recipe::find($request->id);
        $recipe->increment('NbLikes');
        $recipe->save();
        $recipe2=Recipe::find($request->id);
        $NbLikes=$recipe2->NbLikes;

        return response()->json([ 'NbLikes'=>$NbLikes ]);

    }
    public function DecLike(Request $request)
    {   $recipe=Recipe::find($request->id);
        $recipe->decrement('NbLikes');
        $recipe->save();
        $recipe2=Recipe::find($request->id);
        $NbLikes=$recipe2->NbLikes;
        return response()->json([ 'NbLikes'=>$NbLikes ]);

    }

    public function like(Request $request)
    {
        // $user = User::findOrFail(Auth::user()->id);
        // $recipe = Recipes::findOrFail($request->id);
        

        // if (!$user::likedRecipes()->where('recipe_id', $recipe)->exists()) {
        //     $user->likedRecipes()->attach($recipe);
        //     $NbLikes=$recipe->NbLikes;
        //     return response()->json(['message' => 'Recipe liked successfully.','NbLikes'=>$NbLikes]);
        // }

        // return response()->json(['message' => 'Recipe already liked.']);
        try {
            $user = User::findOrFail(Auth::user()->id);
            $recipe = Recipe::findOrFail($request->id);
    
            // Check if the user has already liked the recipe
            if (!$user->likedRecipes()->where('recipe_id', $recipe->id)->exists()) 
            {
                $user->likedRecipes()->attach($recipe);
                $recipe->increment('NbLikes');
                $recipe->save();
                $NbLikes = $recipe->NbLikes; // Assuming NbLikes is a column in your recipes table
                return response()->json(['message' => 'Recipe liked successfully.', 'NbLikes' => $NbLikes]);
            }
    
            return response()->json(['message' => 'Recipe already liked.']);
        } catch (\Exception $e) {
            // Handle the exception
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

    public function unlike(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $recipe = Recipe::findOrFail($request->id);

        if ($user->likedRecipes()->where('recipe_id', $recipe)->exists()) {
            $user->likedRecipes()->detach($recipe);
            $NbLikes=$recipe->NbLikes;
            return response()->json(['message' => 'Recipe unliked successfully.','NbLikes'=>$NbLikes]);
        }

        return response()->json(['message' => 'Recipe not liked yet.']);
    }
#################################### Eeleq relationships functions  ################################################################3
    public function RecipeLikedByWho(Request $request)
    {
        $recipe = Recipe::findOrFail($request->RecipeId);
        $usersWhoLiked = $recipe->likedByUsers;
        dd($usersWhoLiked);
    }
    public function IsRecipeLikedByUser(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $recipeId = $request->RecipeId; 
        $hasLiked = $user->likedRecipes()->where('recipe_id', $recipeId)->exists();
        dd($hasLiked);

    }
    public function RecipesLikedByUser(Request $request)
    {   if($request->UserId==null)
        {
            $user = User::findOrFail(Auth::user()->id);
            $likedRecipes = $user->likedRecipes;
            dd($likedRecipes);
        }
        else
        $user = User::findOrFail($request->UserId);
        $likedRecipes = $user->likedRecipes;
        
        dd($likedRecipes);

    }
    public function getRecipeComments($recipeId)
    {
        try {
            $recipe = Recipe::findOrFail($recipeId);
            $comments = $recipe->comments;
            return response()->json($comments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    
    }
    public function getUserComments($UserId)
    {
        try {
            $user = User::findOrFail($UserId);
            $comments = $user->comments;
            return response()->json($comments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    } 
    public function getUserCommentsOnRecipe($UserId, $recipeId)
    {
        try {
            $user = User::findOrFail($UserId);
            $comments = $user->comments()->where('recipe_id', $recipeId)->get();
            return response()->json($comments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }
    

#################################### Eeleq relationships functions  ################################################################3

}

