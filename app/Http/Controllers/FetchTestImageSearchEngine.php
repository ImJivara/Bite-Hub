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
use App\Services\SerpApiService;

class FetchTestImageSearchEngine extends Controller
{
    protected $serpApiService;

    public function __construct(SerpApiService $serpApiService)
    {
        $this->serpApiService = $serpApiService;
    }

    public function fetchAndStoreRecipes2()
    {
        try {
            // Fetch random recipe from Spoonacular API
            $response = Http::get('https://api.spoonacular.com/recipes/random', [
                'apiKey' => env('SPOONACULAR_API_KEY'),
                'number' => 1 // Number of recipes to fetch
            ]);

            if (!$response->successful()) {
                return response()->json(['error' => 'Failed to fetch recipe from Spoonacular API'], 500);
            }

            $recipeData = $response->json()['recipes'][0]; // Assuming only one recipe is fetched
            $nutritionalData = $this->fetchNutritionalData2($recipeData['id']);
            $ingredients = $this->extractIngredients2($recipeData);

            DB::beginTransaction();

            $stepsDetails = [];

            // Access the analyzedInstructions array and its steps
            $analyzedInstructions = $recipeData['analyzedInstructions'];
            if (!empty($analyzedInstructions)) {
                foreach ($analyzedInstructions[0]['steps'] as $step) {
                    // Collect step descriptions into the $stepsDetails array
                    $stepsDetails[] = $step['step'];
                }
            }

            // Insert recipe data
            $recipe = Recipe::create([
                'user_id' => 1, // Assuming the authenticated user ID
                'RecipeName' => $recipeData['title'],
                'Description' => strip_tags($recipeData['summary']),
                'Steps' => count($recipeData['analyzedInstructions'][0]['steps']),
                'steps_details' => json_encode($stepsDetails),
                'NbIngredients' => count($ingredients),
                'ingredients_details' => json_encode($ingredients),
                'NbLikes' => $recipeData['aggregateLikes'],
                'IsApproved' => 0,
                'difficulty_level' => 'Medium',
                'thumbnail' => $recipeData['image'], // Use Spoonacular's provided image initially
                'cooking_time' => $recipeData['cookingMinutes'],
                'preparation_time' => $recipeData['preparationMinutes'],
                'Category' => isset($recipeData['dishTypes'][0]) ? $recipeData['dishTypes'][0] : 'Uncategorized',
                'Health_Score' => $recipeData['healthScore'],
            ]);

            // Insert nutritional data
            $nutritional = NutritionalData::create([
                'recipe_id' => $recipe->id,
                'calories' => $nutritionalData['calories'],
                'carbs' => $nutritionalData['carbs'],
                'fat' => $nutritionalData['fat'],
                'protein' => $nutritionalData['protein'],
                'bad' => json_encode($nutritionalData['bad']),
                'good' => json_encode($nutritionalData['good']),
                'nutrients' => json_encode($nutritionalData['nutrients']),
            ]);

            // Fetch image from SerpApiService based on RecipeName
            $images = $this->serpApiService->searchImages($recipe->RecipeName);

            if (!empty($images['images_results'])) {
                $firstImage = $images['images_results'][0]['original'];

                // Download the image and save to storage
                $imageContents = file_get_contents($firstImage);
                if ($imageContents !== false) {
                    $imageName = basename($firstImage);
                    $imagePath = 'public/storage/thumbnails/' . $imageName;
                    Storage::put($imagePath, $imageContents);

                    // Update recipe thumbnail to the downloaded image path
                    $recipe->thumbnail = 'storage/thumbnails/' . $imageName;
                    $recipe->save();
                }
            }

            DB::commit();

            return response()->json(['message' => 'Recipe and nutritional data saved successfully', 'Recipe' => $recipe, 'Ingredients' => $ingredients], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to fetch or save recipe: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch or save recipe', 'details' => $e->getMessage()], 500);
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
}

