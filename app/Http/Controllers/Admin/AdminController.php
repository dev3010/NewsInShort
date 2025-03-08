<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AdminController extends Controller
{
    // public function index()
    // {
    //     return view('admin.dashboard');
    // }


// app/Http/Controllers/AdminController.php


public function index()
    {
        $faker = Factory::create();

        // 1. Fetch real news from NewsAPI
        $apiKey = env('NEWSAPI_API_KEY'); // Add to .env: NEWSAPI_API_KEY=be4ca9a66fc4426a997c4f343cbb282a
        $response = Http::get('https://newsapi.org/v2/top-headlines', [
            'country' => 'us',
            'category' => 'general',
            'apiKey' => $apiKey
        ]);

        // 2. Process API response
        $recentNews = [];
        
        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? [];
            
            foreach (array_slice($articles, 0, 5) as $article) {
                $recentNews[] = [
                    'title' => $article['title'] ?? 'No title',
                    'category' => 'General', // From API category parameter
                    'source' => $article['source']['name'] ?? 'Unknown source',
                    'date' => isset($article['publishedAt']) 
                             ? \Carbon\Carbon::parse($article['publishedAt'])->format('Y-m-d')
                             : now()->format('Y-m-d')
                ];
            }
        } else {
            // Fallback to dummy data if API fails
            for ($i = 0; $i < 5; $i++) {
                $recentNews[] = [
                    'title' => $faker->sentence,
                    'category' => $faker->randomElement(['Technology', 'Sports', 'Business']),
                    'source' => $faker->company,
                    'date' => $faker->date('Y-m-d')
                ];
            }
        }

        // 3. Other dashboard data
        $stats = [
            'total_articles' => $faker->numberBetween(100, 200), // Now shows real count
            'total_users' => User::count(),
            'top_category' => 'General' // Update this if using multiple categories
        ];

        $activities = [
            "Fetched " . count($recentNews) . " news articles from NewsAPI",
            "User '{$faker->name}' registered",
            "Category 'General' updated"
        ];

        return view('admin.dashboard', compact('stats', 'recentNews', 'activities'));
    }

}