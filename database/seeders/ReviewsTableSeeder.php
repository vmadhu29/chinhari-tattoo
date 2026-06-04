<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'author_name' => 'Dhiraj Kumar',
                'author_initials' => 'DK',
                'avatar_color' => 'bg-purple-600',
                'rating' => 5,
                'relative_time' => '2 months ago',
                'content' => 'The best tattoo studio in town! The artists are highly professional and the hygiene is top-notch. I absolutely love my new tattoo. Highly recommended to everyone looking for quality work.'
            ],
            [
                'author_name' => 'Renu Ghiwdonde',
                'author_initials' => 'RG',
                'avatar_color' => 'bg-blue-600',
                'rating' => 5,
                'relative_time' => '3 months ago',
                'content' => 'I had an amazing experience at Chinhari Tattoo Studio. They took the time to understand my design and executed it perfectly. Very clean environment and friendly staff.'
            ],
            [
                'author_name' => 'Manoj Bagh',
                'author_initials' => 'MB',
                'avatar_color' => 'bg-green-600',
                'rating' => 5,
                'relative_time' => '4 months ago',
                'content' => 'Great experience getting my first tattoo here! They were very patient and guided me through the entire process. The final piece looks incredible and healed perfectly.'
            ],
            [
                'author_name' => 'indronil biswas',
                'author_initials' => 'IB',
                'avatar_color' => 'bg-red-600',
                'rating' => 5,
                'relative_time' => 'a month ago',
                'content' => 'Outstanding artistry! The detailing on my portrait tattoo is unbelievable. Definitely coming back for more ink soon.'
            ],
            [
                'author_name' => 'praveen sahu',
                'author_initials' => 'PS',
                'avatar_color' => 'bg-yellow-600',
                'rating' => 5,
                'relative_time' => '2 months ago',
                'content' => 'Very professional setup and extremely talented artists. They maintain excellent hygiene standards and make sure you are comfortable throughout the session.'
            ],
            [
                'author_name' => 'Yashwant Rao Mohite',
                'author_initials' => 'YM',
                'avatar_color' => 'bg-indigo-600',
                'rating' => 5,
                'relative_time' => '5 months ago',
                'content' => 'Loved the vibe of the studio. The tattoo artist was very skilled and brought my idea to life flawlessly. Highly recommend Chinhari Tattoo!'
            ],
        ];

        foreach ($reviews as $review) {
            \App\Models\Review::create($review);
        }

        // Initialize cache with real stats
        \Illuminate\Support\Facades\Cache::forever('google_rating', 4.9);
        \Illuminate\Support\Facades\Cache::forever('google_review_count', 37);
    }
}
