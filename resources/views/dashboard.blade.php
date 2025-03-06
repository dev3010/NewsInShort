<!-- dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <br><br>

    {{-- Include the index.blade.php file --}}
    @include('news.index', [
        'articles' => $articles ?? [],
        'currentCategory' => $currentCategory ?? 'general',
        'allCategories' => $allCategories ?? []
    ])
</div>
@endsection