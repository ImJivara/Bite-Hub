<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use App\Models\Activity;
use App\Models\NutritionalData;
use Illuminate\Support\Facades\View;
use Laravel\Prompts\alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;// for file saving
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{  
   #################################### Post Events ################################################################
   //get all recipes for main page
    public function getRecipes(Request $request)
    {  
        if($request->id==null)
        {
            // Fetch distinct categories
            $categories = Recipe::select('Category')->distinct()->pluck('Category');

            $sortBy = $request->input('sort_by', 'created_at');
            $sortOrder = $request->input('sort_order', 'desc');
            $category = $request->input('category');

            $recipesQuery = Recipe::query();

            if ($category) {
                $recipesQuery->where('Category', $category);
            }

            $recipesQuery->orderBy($sortBy, $sortOrder);
            $recipes = $recipesQuery->paginate(10);
            $featuredRecipe = Recipe::orderBy('NbLikes', 'desc')->first();
            $MostRecentRecipe = Recipe::orderBy('created_at', 'desc')->first();

            return view('Recipes', [
                'rec' => $recipes,
                'featuredrec' => $featuredRecipe,
                'MostRecentRecipe' => $MostRecentRecipe,
                'categories' => $categories // Pass categories to the view
            ]);
        }
        else{
            try {
                $recipe =Recipe::with('nutritionalData')->findOrFail($request->id);
            } catch (\Exception $e) {
                dd("Such post doesn't exist."); 
            }
        
            $ingredients = json_decode($recipe->ingredients_details, true);
            $step_details = $recipe->steps_details;
            $comments = $this->getRecipeComments($recipe->id);
        
            return view('Recipe', [
                'r' => $recipe,
                'ing' => $ingredients,
                'steps' => $step_details,
                'comments' => $comments
            ]);
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

#################################### Post #######################################################################

#################################### Post Recipe ################################################################
    public function getForm()
    {
        return view('recipeForm');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'RecipeName' => 'required|string|max:255',
            'Description' => 'required|string',
            'Category' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'difficulty_level' => 'required|string|max:255',
            'cooking_time' => 'required|integer|min:1',
            'preparation_time' => 'required|integer|min:1',
            'Health_Score' => 'required|integer|min:1',
            'steps.*' => 'required|string',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.amount' => 'required|numeric',
            'ingredients.*.unit' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Handle thumbnail upload if provided
        if ($request->hasFile('thumbnail')) {
            // Get the uploaded file
            $thumbnailFile = $request->file('thumbnail');
            
            // Generate a unique filename based on the recipe ID
            $thumbnailFileName = 'recipe_' . uniqid() . '.' . $thumbnailFile->getClientOriginalExtension();
            
            // Store the file in the public storage directory
            $thumbnailPath = $thumbnailFile->storeAs('public\thumbnails', $thumbnailFileName, 'public');
        } else {
            $thumbnailPath = null;
        }

        // Create a new Recipe instance
        $recipe = new Recipe();
        $recipe->user_id = auth()->user()->id; // Assuming the recipe is associated with the authenticated user
        $recipe->RecipeName = $request->input('RecipeName');
        $recipe->Description = $request->input('Description');
        $recipe->Category = $request->input('Category');
        $recipe->thumbnail = $thumbnailPath; // Store the thumbnail path
        $recipe->difficulty_level = $request->input('difficulty_level');
        $recipe->cooking_time = $request->input('cooking_time');
        $recipe->preparation_time = $request->input('preparation_time');
        $recipe->Health_Score = $request->input('Health_Score');

        // Convert steps and ingredients data to JSON format
        $steps = $request->input('steps');
        $ingredients = $request->input('ingredients');

        // Prepare steps_details and ingredients_details as JSON arrays
        $recipe->Steps = count($steps);
        $recipe->steps_details =  json_encode($steps);;
        $recipe->NbIngredients = count($ingredients);
        $recipe->ingredients_details = json_encode($ingredients);

        // Save the recipe to the database
        $recipe->save();

        // Create a new NutritionalData instance
        $nutritionalData = new NutritionalData();
        $nutritionalData->recipe_id = $recipe->id;
        $nutritionalData->calories = $request->input('calories');
        $nutritionalData->carbs = $request->input('carbs');
        $nutritionalData->fat = $request->input('fat');
        $nutritionalData->protein = $request->input('protein');
        
        // Save the nutritional data to the database
        $nutritionalData->save();

        // Redirect to a success page or somewhere else
        return redirect()->route('recipes.Form')->with('success', 'Recipe added successfully!');
    }
#################################### Post Recipe ################################################################

#################################### Recipe Search ################################################################  


    public function searchrecipesbar(Request $request)
    {
        $query = $request->input('query');

        // Perform the search query based on your criteria (e.g., title or author name)
        $r= Recipe::where('RecipeName', 'like', '%' . $query . '%')
                        ->orWhereHas('author', function($queryBuilder) use ($query) {
                            $queryBuilder->where('name', 'like', '%' . $query . '%');
                        })
                        ->with('author') // Eager load the author relationship
                        ->get();

        // Render the Blade component with recipes
          $recipe_cards = View::make('components.recipecard2search', compact('r'))->render();

        return response()->json([
            'recipe_cards' => $recipe_cards
        ]);
                 
    }
#################################### Recipe Search ################################################################################
    
    

    

#################################### Eeleq relationships functions  ################################################################
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
    

#################################### Eeleq relationships functions  ################################################################

#################################### API Functions  ################################################################

    // public function fetchAndStoreRecipes()
    // {
    //     $response = Http::get('https://api.spoonacular.com/recipes/random', [
    //         'apiKey' => env('SPOONACULAR_API_KEY'),
    //         'number' => 1 // Number of recipes to fetch
    //     ]);

    //     $recipeData = $response->json()['recipes'];
    //     $nutritionalData = $this->fetchNutritionalData($recipeData[0]['id']);
    //     $ingredients = $this->extractIngredients($recipeData);  
    //     $selected_nutritional_values = ['calories', 'fat', 'carbs', 'protein'];
        

    //      // Convert the recipe data to JSON
    //     // Directory path
    //     // $directoryPath = 'C:/Users/PC/Documents/RecipeData/';

    //     // Check if the directory exists, if not, create it
    //     // if (!is_dir($directoryPath)) {
    //     //     mkdir($directoryPath, 0777, true);
    //     // }

    //     // // Save recipe data
    //     // $recipeJson = json_encode($recipeData, JSON_PRETTY_PRINT);
    //     // $recipeFileName = $directoryPath . 'recipe_' . time() . '.json'; 
    //     // file_put_contents($recipeFileName, $recipeJson);

    //     // // Save nutritional data
    //     // $nutritionalDataJson = json_encode($nutritionalData, JSON_PRETTY_PRINT);
    //     // $nutritionalDataFileName = $directoryPath . 'nutritionalData_recipe_' . $recipeData[0]['id'] . '.json'; 
    //     // file_put_contents($nutritionalDataFileName, $nutritionalDataJson);

    //     // return view('OneRecipedemo', [
    //     //     'recipe' => $recipeData,
    //     //     'nutritionalData' => $nutritionalData,
    //     //     'ingredients' => $ingredients,
    //     //     'selected_nutritional_values' => $selected_nutritional_values,
    //     // ]);
    // }

    // // Fetch nutritional data for a recipe from Spoonacular API
    // private function fetchNutritionalData($recipeId)
    // {
    //     try {
    //         $response = Http::get("https://api.spoonacular.com/recipes/{$recipeId}/nutritionWidget.json", [
    //             'apiKey' => env('SPOONACULAR_API_KEY'),
    //         ]);

    //         if ($response->successful()) {
    //             return $response->json();
    //         } else {
    //             // Log or handle the error response
    //             return null;
    //         }
    //     } catch (\Exception $e) {
    //         // Log or handle the exception
    //         dd($e->getMessage()); // Dump the exception message
    //         return null;
    //     }
    // }

    // private function extractIngredients($recipeData)
    // {
    //     $ingredients = [];

    //     // Check if 'extendedIngredients' key exists in the $recipeData array
    //     if (isset($recipeData['extendedIngredients'])) {
    //         foreach ($recipeData['extendedIngredients'] as $ingredientData) {
    //             $ingredient = [
    //                 'name' => $ingredientData['name'],
    //                 'amount' => $ingredientData['amount'],
    //                 'unit' => $ingredientData['measures']['us']['unitLong'] // Assuming you want to use US units
    //             ];
    //             $ingredients[] = $ingredient;
    //         }
    //     }

    //     return $ingredients;
    // }

    














public function fetchAndStoreRecipes2()
{
    $response = Http::get('https://api.spoonacular.com/recipes/random', [
        'apiKey' => env('SPOONACULAR_API_KEY'),
        'number' => 1 // Number of recipes to fetch
    ]);

    $recipeData = $response->json()['recipes'][0]; // Assuming only one recipe is fetched
    $nutritionalData = $this->fetchNutritionalData2($recipeData['id']);
    $ingredients = $this->extractIngredients2($recipeData);  

    if ($nutritionalData) {
        DB::beginTransaction();
        
        $stepsDetails = [];

        // Access the analyzedInstructions array and its steps
        $analyzedInstructions = $recipeData['analyzedInstructions'];
        if (!empty($analyzedInstructions)) 
        {
            foreach ($analyzedInstructions[0]['steps'] as $step)
            {
                // Collect step descriptions into the $stepsDetails array
                $stepsDetails[] = $step['step'];
            }
        }
        
        try {
             // Insert recipe data
             $recipe = Recipe::create([
                'user_id' => 1, 
                'RecipeName' => $recipeData['title'],
                'Description' => strip_tags($recipeData['summary']),
                'Steps' => count($recipeData['analyzedInstructions'][0]['steps']),
                'steps_details' => json_encode($stepsDetails), 
                'NbIngredients' => count($ingredients),
                'ingredients_details' => json_encode($ingredients), 
                'NbLikes' => $recipeData['aggregateLikes'],
                'IsApproved' => 0, 
                'difficulty_level' => 'Medium',
                'thumbnail' => $recipeData['image'],
                'cooking_time' => $recipeData['cookingMinutes'],
                'preparation_time' => $recipeData['preparationMinutes'],
                'Category' => isset($recipeData['dishTypes'][0]) ? $recipeData['dishTypes'][0] : 'Uncategorized',
                'Health_Score' => $recipeData['healthScore'],
            ]);

            // Insert nutritional data
            $nutritional = NutritionalData::create([     
                'recipe_id'=>$recipe->id,       
                'calories' => $nutritionalData['calories'],
                'carbs' => $nutritionalData['carbs'],
                'fat' => $nutritionalData['fat'],
                'protein' => $nutritionalData['protein'],
                'bad' => json_encode($nutritionalData['bad']),
                'good' => json_encode($nutritionalData['good']),
                'nutrients' => json_encode($nutritionalData['nutrients']),
            ]);
            DB::commit();
            dd($recipe,$nutritional);
           // return response()->json(['message' => 'Recipe and nutritional data saved successfully',"Recipe"=>$recipe,"Ingredients"=>$ingredients], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to save data', 'details' => $e->getMessage()], 500);
        }
    } else {
        return response()->json(['error' => 'Failed to fetch nutritional data'], 500);
    }
}

private function fetchNutritionalData2($recipeId)
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
        return null;
    }
}

private function extractIngredients2($recipeData)
{
    $ingredients = [];

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

public function search(Request $request)
    {   
        // Validate the request input
        $request->validate([
            'query' => 'required|string',
        ]);

        // Get the search query from the request
        $query = $request->input('query');

        // Fetch Pexels API key from environment variables
        $apiKey = env('PEXELS_API_KEY');

        // Make request to Pexels API
        $response = Http::withHeaders([
            'Authorization' => $apiKey,
        ])->get('https://api.pexels.com/v1/search', [
            'query' => $query,
            'per_page' => 1, // Adjust as per your requirement
        ]);

        // Handle API response
        $photos = $response->json()['photos'] ?? [];
        dd($photos);
       //Save images to local storage
        // $savedImageUrls = [];
        // foreach ($photos as $photo) {
        //     $imageUrl = $photo['src']['medium'] ?? null;
        //     if ($imageUrl) {
        //         $savedImageUrl = $this->saveImageLocally2($imageUrl);
        //         if ($savedImageUrl) {
        //             $savedImageUrls[] = $savedImageUrl;
        //         }
                
        //     }
        // }

        //Pass the data to the view
        // return view('SearchBar', [
        //     'recipeName' => $query,
        //     'imageUrls' => $savedImageUrl,
        // ]);
    }

   
    





















}

