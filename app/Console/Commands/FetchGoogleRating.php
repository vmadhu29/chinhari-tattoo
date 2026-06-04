<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

#[Signature('google:fetch-rating')]
#[Description('Fetch and cache Google Places rating and review count')]
class FetchGoogleRating extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiKey = config('services.google_places.key');
        $placeId = config('services.google_places.place_id');

        if (!$apiKey || !$placeId) {
            $this->error('Google Places API key or Place ID is missing.');
            return;
        }

        $url = 'https://maps.googleapis.com/maps/api/place/details/json';
        
        $response = Http::get($url, [
            'place_id' => $placeId,
            'fields' => 'rating,user_ratings_total',
            'key' => $apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            if (isset($data['result']['rating']) && isset($data['result']['user_ratings_total'])) {
                $rating = $data['result']['rating'];
                $count = $data['result']['user_ratings_total'];
                
                Cache::forever('google_rating', $rating);
                Cache::forever('google_review_count', $count);
                
                $this->info("Successfully cached Google Rating: {$rating} and Count: {$count}");
            } else {
                $this->error('Failed to find rating in the Google Places response.');
                Log::error('Google Places API response missing rating fields', ['response' => $data]);
            }
        } else {
            $this->error('Failed to fetch from Google Places API.');
            Log::error('Google Places API request failed', ['status' => $response->status(), 'response' => $response->body()]);
        }
    }
}
