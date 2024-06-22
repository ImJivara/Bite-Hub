<?php

namespace App\Services;

use GuzzleHttp\Client;

class SerpApiService
{
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->apiKey = env('SERPAPI_KEY');
        $this->client = new Client();
    }

    public function searchImages($query)
    {
        $response = $this->client->get('https://serpapi.com/search', [
            'query' => [
                'q' => $query,
                'engine' => 'google_images',
                'api_key' => $this->apiKey,
                'output' => 'json'
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
