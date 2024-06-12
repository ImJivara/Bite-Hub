<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Activity;
use Laravel\Prompts\alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;// for file saving

class RecipeController extends Controller
{
    public function getRecipes(Request $request)
    {  
        if($request->id==null)
        {
            $recipes=Recipe::all();
        //    $RecipesLikedByUser=$this->RecipesLikedByUser(Auth::user()->id);
            $FeaturedRecipe = $recipes->sortByDesc('NbLikes')->first();
            $MostRecentRecipe=$recipes->sortByDesc('created_at')->first();
            // dd($MostRecentRecipe);
            //  dd($RecipesLikedByUser);
            return view('Recipes',['rec'=>$recipes,'featuredrec'=>$FeaturedRecipe,'MostRecentRecipe'=>$MostRecentRecipe] );
        }
        else{
            $recipe=Recipe::findOrFail($request->id);
            if($recipe==null) dd("such post doesnt exist");
            else
            $ingredients=$recipe->ingredients_details;
            $ingredients=explode("-",$ingredients);
            $step=$recipe->steps_details;
            $step=explode("-",$step);
            $comments=$this->getRecipeComments($recipe->id);
            return view('Recipe',['r'=>$recipe,'ing'=>$ingredients,'steps'=>$step,'comments'=>$comments] );
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
            
            if (!$user->likedRecipes()->where('recipe_id', $recipe->id)->exists()) {
                $user->likedRecipes()->attach($recipe->id);
                $recipe->increment('NbLikes');
                $recipe->save();
                $NbLikes = $recipe->NbLikes; 

                Activity::create([
                    'user_id' => $user->id,
                    'type' => 'like_recipe',
                    'subject_type' => 'App\Models\Recipe',
                    'subject_id' => $recipe->id,
                    'description' => 'User ' . $user->name . ' liked the recipe ' . $recipe->RecipeName,
                ]);
                
                return response()->json(['NbLikes' => $NbLikes, 'RecipeAlreadyLiked' => False]);
            }
            return response()->json(['RecipeAlreadyLiked' => True]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage(),"success"=>False]);
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
public function commentOnRecipe(Request $request, $recipeId)
{
    $recipe = Recipe::findOrFail($recipeId);
    $user = Auth::user();

    // Record the comment (assuming you have a Comment model and table)
    $comment = $recipe->comments()->create([
        'user_id' => $user->id,
        'content' => $request->input('content'),
    ]);

    // Record the activity
    Activity::create([
        'user_id' => $user->id,
        'type' => 'comment',
        'description' => "You commented on the recipe: {$recipe->title}",
    ]);

    return redirect()->back()->with('success', 'Comment added successfully!');
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
    public function RecipesLikedByUser()
    {   
        // if($UserId==null)
        // {
            $user = User::findOrFail(Auth::user()->id);
            $likedRecipes = $user->likedRecipes;
        // }
        // else
        // $user = User::findOrFail($UserId);
        // $likedRecipes = $user->likedRecipes(); 
        return  $likedRecipes;
    }
    public function getRecipeComments($recipeId)
    {
        try {
            $recipe = Recipe::findOrFail($recipeId);
            $comments = $recipe->comments;
            // return response()->json($comments);
            return $comments;
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
    
    public function GetProfileInfo()
    {

        $likedRecipes=$this->RecipesLikedByUser();
        $recentActivities = Activity::where('user_id', Auth::user()->id)
                                    ->latest()
                                    ->take(10)
                                    ->get();
     return view("Profile Folder.ProfilePage",["likedRecipes"=>$likedRecipes]);
        
    }

#################################### Eeleq relationships functions  ################################################################3






    public function fetchAndStoreRecipes()
    {
        $response = Http::get('https://api.spoonacular.com/recipes/random', [
            'apiKey' => env('SPOONACULAR_API_KEY'),
            'number' => 1 // Number of recipes to fetch
        ]);

        $recipeData = $response->json()['recipes'];
        $nutritionalData = $this->fetchNutritionalData($recipeData[0]['id']);
        $ingredients = $this->extractIngredients($recipeData);  
        $selected_nutritional_values = ['calories', 'fat', 'carbs', 'protein'];
        // dd($recipes);
         // Convert the recipe data to JSON
        //  $recipeJson = json_encode($recipes, JSON_PRETTY_PRINT);
        //  $filePath = 'C:/Users/User/Documents/RecipeData/';
        //  $fileName = 'recipe_' . time() . '.json'; 
        //  file_put_contents($filePath . $fileName, $recipeJson);

        return view('OneRecipedemo', [
            'recipe' => $recipeData,
            'nutritionalData' => $nutritionalData,
            'ingredients' => $ingredients,
            'selected_nutritional_values' => $selected_nutritional_values,
        ]);
    }

    // Fetch nutritional data for a recipe from Spoonacular API
    private function fetchNutritionalData($recipeId)
    {
        try {
            $response = Http::get("https://api.spoonacular.com/recipes/{$recipeId}/nutritionWidget.json", [
                'apiKey' => env('SPOONACULAR_API_KEY'),
            ]);

            if ($response->successful()) {
                return $response->json();
            } else {
                // Log or handle the error response
                return null;
            }
        } catch (\Exception $e) {
            // Log or handle the exception
            dd($e->getMessage()); // Dump the exception message
            return null;
        }
    }

    private function extractIngredients($recipeData)
    {
        $ingredients = [];

        // Check if 'extendedIngredients' key exists in the $recipeData array
        if (isset($recipeData['extendedIngredients'])) {
            foreach ($recipeData['extendedIngredients'] as $ingredientData) {
                $ingredient = [
                    'name' => $ingredientData['name'],
                    'amount' => $ingredientData['amount'],
                    'unit' => $ingredientData['measures']['us']['unitLong'] // Assuming you want to use US units
                ];
                $ingredients[] = $ingredient;
            }
        }

        return $ingredients;
    }

    





























}

