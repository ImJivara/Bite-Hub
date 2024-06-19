<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


class WorkoutController extends Controller
{
    public function GetWorkouts(Request $request)
    {
        $type = $request->input('type');
        $language = $request->input('language', '2'); // Default to English (2) if not provided

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . env('WORKOUT_API_KEY'),
            ])->get("https://wger.de/api/v2/exercise/?category={$type}&language={$language}");

            if ($response->successful()) {
                $workouts = collect($response->json()['results'])->pluck('name')->toArray();
            return response()->json($response->json());
            } else {
                return response()->json(['error' => 'Failed to fetch workouts'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Exception occurred: ' . $e->getMessage()], 500);
        }
    }
    public function GetExercise(Request $request)
    {
        $type = $request->input('type');
        $search = $request->input('search');
        $page = $request->input('page', 1); // Default page is 1
        $perPage = 10; // Number of items per page

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token ' . env('WORKOUT_API_KEY'),
            ])->get("https://wger.de/api/v2/exercise/", [
                'category' => $type,
                'language' => '2',
                'search' => $search,
                'page' => $page,
                'limit' => $perPage,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Failed to fetch workouts'], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Exception occurred: ' . $e->getMessage()], 500);
        }
    }

}

// 55715de52a098e66a462f228656ba1c7b0a7ac0c