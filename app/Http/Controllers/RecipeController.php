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
           // $RecipesLikedByUser=$this->RecipesLikedByUser(Auth::user()->id);
            $FeaturedRecipe = $recipes->sortByDesc('NbLikes')->first();
            $MostRecentRecipe=$recipes->sortByDesc('created_at')->first();
            // dd($MostRecentRecipe);
            //  dd($RecipesLikedByUser);
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

    public function like(Request $request)
    {
        try {
            $user = User::findOrFail(Auth::user()->id);
            $recipe = Recipe::findOrFail($request->RecipeId);
            if (!$user->likedRecipes()->where('recipe_id', $recipe->id)->exists()) 
            {
                $user->likedRecipes()->attach($recipe->id);
                $recipe->increment('NbLikes');
                $recipe->save();
                $NbLikes = $recipe->NbLikes; 
                return response()->json([ 'NbLikes' => $NbLikes,'RecipeAlreadyLiked' => False]);
            }
            return response()->json(['RecipeAlreadyLiked' => True]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }
    }

    public function dislike(Request $request)
{
    try {
        $user = User::findOrFail(Auth::user()->id);
        $recipe = Recipe::findOrFail($request->RecipeId);
        if ($user->likedRecipes()->where('recipe_id', $recipe->id)->exists()) 
        {
            $user->likedRecipes()->detach($recipe->id);
            $recipe->decrement('NbLikes');
            $recipe->save();
            $NbLikes = $recipe->NbLikes; 
            return response()->json([ 'NbLikes' => $NbLikes]);
        }
        return ;
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred while processing your request.'], 500);
    }
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
    public function RecipesLikedByUser($UserId)
    {   if($UserId==null)
        {
            $user = User::findOrFail(Auth::user()->id);
            $likedRecipes = $user->likedRecipes;
        }
        else
        $user = User::findOrFail($UserId);
        $likedRecipes = $user->likedRecipes; 
        return $likedRecipes !== null;


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

