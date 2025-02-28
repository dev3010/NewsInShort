@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Navigation -->
    <div class="mb-8 overflow-x-auto scrollbar-hide">
        <div class="flex space-x-4 pb-2">
            @foreach($allCategories as $cat)
                <a href="{{ route('news.category', ['category' => $cat]) }}" 
                   class="px-4 py-2 min-w-max rounded-lg text-sm font-medium transition-colors
                          {{ $currentCategory === $cat ? 
                             'bg-blue-600 text-white shadow-md' : 
                             'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ ucfirst($cat) }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Page Title -->
    <h1 class="text-3xl font-bold mb-6 text-gray-800">
        {{ ucfirst($currentCategory) }} News
    </h1>

    <!-- News Grid -->
    @if(count($articles) > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($articles as $article)
            <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                <div class="relative aspect-video">
                    <img src="{{ $article['urlToImage'] ?? asset('images/news-placeholder.jpg') }}" 
                         class="w-full h-full object-cover"
                         alt="{{ $article['title'] ?? 'News image' }}">
                </div>

                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">
                        {{ Str::limit($article['title'] ?? 'No title available', 70) }}
                    </h2>
                    <p class="text-gray-600 mb-4 text-sm">
                        {{ Str::limit($article['description'] ?? 'No description available', 120) }}
                    </p>
                    <div class="flex justify-between items-center text-sm">
                        <a href="{{ $article['url'] }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            Read Full Article
                        </a>
                        <div class="text-right">
                            <p class="text-gray-500">
                                {{ \Carbon\Carbon::parse($article['publishedAt'])->diffForHumans() }}
                            </p>
                            <p class="text-xs text-gray-400">
                                {{ $article['source']['name'] ?? 'Unknown source' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 bg-gray-50 rounded-xl">
        <div class="mb-4 text-gray-500">
            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <p class="text-gray-500 mb-4">No articles found in this category</p>
        <a href="{{ route('dashboard') }}" 
           class="text-blue-600 hover:text-blue-800 font-medium">
            Return to Dashboard
        </a>
    </div>
    @endif
</div>
@endsection