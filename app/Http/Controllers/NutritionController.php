<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class NutritionController extends Controller
{
    public function fetchNutritionalInfo(Request $request)
    {
        $food = $request->input('recipeName');
        $category = $request->input('category');
        $apiKey = env('SPOONACULAR_API_KEY');
        $url = "https://api.spoonacular.com/recipes/complexSearch";

        $client = new Client();

        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'apiKey' => $apiKey,
                    'query' => $food,
                    'type' => $category,
                    'addRecipeNutrition' => true,
                    'number' => 1,
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            // Extracting nutrition details from the response
            if (isset($data['results'][0]['nutrition']['nutrients'])) {
                $nutrients = $data['results'][0]['nutrition']['nutrients'];

                // Initialize variables to hold specific nutritional values
                $calories = null;
                $carbs = null;
                $protein = null;
                $fat = null;

                // Iterate through nutrients to find specific values
                foreach ($nutrients as $nutrient) {
                    switch ($nutrient['title']) {
                        case 'Calories':
                            $calories = $nutrient['amount'];
                            break;
                        case 'Carbohydrates':
                            $carbs = $nutrient['amount'];
                            break;
                        case 'Protein':
                            $protein = $nutrient['amount'];
                            break;
                        case 'Fat':
                            $fat = $nutrient['amount'];
                            break;
                        default:
                            break;
                    }
                }

                // return response()->json([
                //     'calories' => $calories,
                //     'carbs' => $carbs,
                //     'protein' => $protein,
                //     'fat' => $fat,
                // ]);
                return view('nutrition', [
                    'calories' => $calories,
                    'carbs' => $carbs,
                    'protein' => $protein,
                    'fat' => $fat,
                ]);
            }
            else return;


        
    


}