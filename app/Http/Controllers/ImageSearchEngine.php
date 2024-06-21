<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageSearchEngine extends Controller
{   


    public function index()
    {

        return view('SearchBar');
    }

    public function fetchAndSaveImages(Request $request)
    {
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

        if (!empty($photos)) {
            $imageUrl = $photos[0]['src']['original']; // Assuming 'original' is the full-size image URL
            $savedImagePath = $this->saveImageLocally($imageUrl);

            if ($savedImagePath) {
                return "Image saved at: " . $savedImagePath;
            } else {
                return "Failed to save image.";
            }
        } else {
            return "No photos found.";
        }
    }

    private function saveImageLocally($imageUrl)
    {
        try {
            // Fetch image content
            $response = Http::get($imageUrl);
            $imageContent = $response->getBody();
    
            // Extract filename from URL
            $filename = basename($imageUrl);
    
            // Specify the directory path
            $directoryPath = 'C:/Users/User/Documents/RecipeImages/';
    
            // Save image to the specified directory
            $filePath = $directoryPath . $filename;
            file_put_contents($filePath, $imageContent);
    
            // Return the saved file path
            return $filePath;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving image: ' . $e->getMessage());
    
            // Return null or handle the error as needed
            return null;
        }
    }
    
    


    private function saveImageLocally2($imageUrl)
    {
        try {
            // Fetch image content
            $response = Http::get($imageUrl);
            $imageContent = $response->getBody();
    
            // Generate a unique filename with extension
           // $filename = uniqid() . '.jpg'; // Assuming images fetched are in JPEG format
           $extension = pathinfo($response, PATHINFO_EXTENSION);
           $filename = Str::slug(pathinfo($response, PATHINFO_FILENAME)) . '_' . uniqid() . '.' . $extension;
            // Specify the directory path
            $directoryPath = 'C:/Users/User/Documents/RecipeImages/';
    
            // Save image to the specified directory
            $filePath = $directoryPath . $filename;
            file_put_contents($filePath, $imageContent);
    
            // Return the saved file path
            return $filePath;
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving image: ' . $e->getMessage());
    
            // Return null or handle the error as needed
            return null;
        }
    }
}
