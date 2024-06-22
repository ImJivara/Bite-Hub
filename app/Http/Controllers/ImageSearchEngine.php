<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\SerpApiService;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

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




    

    protected $serpApiService;

    public function __construct(SerpApiService $serpApiService)
    {
        $this->serpApiService = $serpApiService;
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $images = $this->serpApiService->searchImages($query);
    
        // Assuming $images['images_results'] is the array of images from SerpApi
        $perPage = 12; // Number of items per page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($images['images_results'], ($currentPage - 1) * $perPage, $perPage);
        $paginatedItems = new LengthAwarePaginator($currentItems, count($images['images_results']), $perPage);
    
        return view('ImageSearchResults', ['images' => $paginatedItems]);
    }
    public function saveImage(Request $request)
    {
        try {
            $imageUrl = $request->input('selected_image');
            if (!$imageUrl) {
                return redirect()->back()->with('error', 'No image selected.');
            }

            $imageContents = file_get_contents($imageUrl);
            if ($imageContents === false) {
                return redirect()->back()->with('error', 'Failed to download the image.');
            }

            $imageName = basename($imageUrl);
            Storage::put('public/ImageSearchResults/' . $imageName, $imageContents);

            return redirect()->back()->with('success', 'Image saved successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to save image: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to save the image.');
        }
    }


































}
