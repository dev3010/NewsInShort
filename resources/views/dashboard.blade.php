@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <h1 class="text-3xl font-bold mb-8 text-gray-800">Choose News Category</h1>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($categories as $category)
            {{-- Correct route name: news.category --}}
            <a href="{{ route('news.category', ['category' => $category]) }}" 
               class="bg-white rounded-lg shadow-md p-6 transform transition duration-300 hover:scale-105 hover:shadow-xl">
                <div class="text-center">
                    <div class="mb-4">
                        <span class="text-4xl">
                            @switch($category)
                                @case('business') 💼 @break
                                @case('entertainment') 🎭 @break
                                @case('health') 🏥 @break
                                @case('science') 🔬 @break
                                @case('sports') ⚽ @break
                                @case('technology') 💻 @break
                                @default 📰
                            @endswitch
                        </span>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ ucfirst($category) }} News
                    </h2>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection