<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    protected $validCategories = [
        'general', 'business', 'entertainment', 
        'health', 'science', 'sports', 'technology'
    ];

    public function dashboard()
    {
        return $this->index('general');
    }

    public function welcome()
    {
        return $this->index('general');
    }

    public function index($category = 'general')
    {
        // Validate category
        if (!in_array($category, $this->validCategories)) {
            return redirect()->route('dashboard')
                ->with('error', 'Invalid news category');
        }

        // Fetch from NewsAPI
        $apiKey = config('services.newsapi.key');
        $response = Http::get("https://newsapi.org/v2/top-headlines", [
            'category' => $category,
            'country' => 'us',
            'apiKey' => $apiKey,
            'pageSize' => 100
        ]);

        // Handle API errors
        if (!$response->successful()) {
            return redirect()->route('dashboard')
                ->with('error', 'Failed to fetch news articles');
        }

        $newsData = $response->json();

        return view('news.index', [
            'articles' => $newsData['articles'] ?? [],
            'currentCategory' => $category,
            'allCategories' => $this->validCategories
        ]);
    }
}