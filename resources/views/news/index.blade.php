@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Category Navigation -->
    <div class="mb-8 overflow-x-auto scrollbar-hide">
        <div class="flex space-x-4 pb-2">
            @foreach($allCategories as $cat)
            <a href="{{ route('news.category', ['category' => $cat]) }}" 
                style="
                    padding: 0.5rem 1rem; /* px-4 py-2 */
                    min-width: max-content; /* min-w-max */
                    border-radius: 0.5rem; /* rounded-lg */
                    font-size: 1.2rem; /* text-sm */
                    font-weight: 500; /* font-medium */
                    transition: all 0.2s; /* transition-colors */
                    {{ $currentCategory === $cat ? 
                       ' color: #2563EB; font-size: 1.425rem; font-weight: 700; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);' : 
                       'background-color: #F3F4F6; color: #374151;' }}
                    {{ $currentCategory !== $cat ? '&:hover { background-color: #E5E7EB; }' : '' }}">
                 {{ ucfirst($cat) }}
             </a>
            @endforeach
        </div>
    </div>
    <br>

    <!-- Page Title -->
    <h1 style="
    font-size: 1.875rem; /* text-3xl */
    font-weight: 700; /* font-bold */
    margin-bottom: 1.5rem; /* mb-6 */
    color: #1F2937; /* text-gray-800 */
    text-align: center; /* Center the text */
">
    {{ ucfirst($currentCategory) }} News
</h1>

    <!-- News Grid -->
    @if(count($articles) > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($articles as $article)
            <div class="bg-white rounded-l-sm overflow-hidden shadow-lg hover:shadow-xl transition-shadow" style="border-radius: 26px;">
                <div class="relative aspect-video">
                    <img src="{{ $article['urlToImage'] ?? asset('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR1tmKD2vGqY8MvaftlsaCBnty3HbCawgCK2w&s') }}" 
                         class="w-full h-full object-cover"
                         alt="{{ $article['title'] ?? 'News image' }}">
                </div>

                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">
                        {{ Str::limit($article['title'] ?? 'No title available', 70) }}
                    </h2>
                    <p class="text-gray-600 mb-4 text-lg">
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