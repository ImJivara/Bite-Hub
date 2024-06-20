<?php

namespace App\Http\Controllers;
use App\Models\NutritionalDataLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
// YOUR_EDAMAM_APP_ID=7ba1f1e8 
// YOUR_EDAMAM_APP_KEY=0bfaa9370bce866584f689af21404aa2
class NutritionController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'calories' => 'required|numeric',
            'carbs' => 'required|numeric',
            'protein' => 'required|numeric',
            'fat' => 'required|numeric',
            //'food' => 'required|string', // Validate 'food' attribute if necessary
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();
        $currentDate = now()->toDateString();

        // Check if a log already exists for the current date
        $existingLog = NutritionalDataLog::where('user_id', $user->id)
                                        ->where('log_date', $currentDate)
                                        ->first();

        if ($existingLog) {
            return response()->json([
                'success' => 'RecordExists',
                'message' => 'A record for today already exists.'
            ], 200);
        }

        // Create a new NutritionalDataLog instance
        $log = new NutritionalDataLog();
        $log->user_id = $user->id;
        $log->log_date = $currentDate; // Use the current date
        $log->calories = $validatedData['calories'];
        $log->carbs = $validatedData['carbs'];
        $log->protein = $validatedData['protein'];
        $log->fat = $validatedData['fat'];
        // $log->food = $validatedData['food'];  // Assign 'food' attribute if necessary

        // Save the log to the database
        $log->save();

        // Optionally, return a response
        return response()->json([
            'success' => true,
            'message' => 'Nutritional data logged successfully'
        ], 200);
    }


    public function fetchNutritionData(Request $request)
    {
        $user_id = auth()->id(); // Assuming user is authenticated
        $logs = NutritionalDataLog::where('user_id', $user_id)
            ->whereMonth('log_date', now()->month) // Filter by current month
            ->orderBy('log_date', 'asc')
            ->get();

        $totalCalories = $logs->sum('calories');
        $totalCarbs = $logs->sum('carbs');
        $totalProtein = $logs->sum('protein');
        $totalFat = $logs->sum('fat');

        return response()->json([
            'logs' => $logs,
            'totals' => [
                'calories' => $totalCalories,
                'carbs' => $totalCarbs,
                'protein' => $totalProtein,
                'fat' => $totalFat,
            ]
        ]);
    }
    public function getMonthlyNutritionalData(Request $request)
{
    $user = Auth::user();
    $currentMonth = now()->month;
    $currentYear = now()->year;

    $logs = DB::table('nutritional_data_logs')
        ->where('user_id', $user->id)
        ->whereYear('log_date', $currentYear)
        ->whereMonth('log_date', $currentMonth)
        ->orderBy('log_date')
        ->get(['log_date', 'calories', 'carbs', 'protein', 'fat']);

    return response()->json($logs);
}


}