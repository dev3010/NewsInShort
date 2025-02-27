@extends('layouts.app')
@section('content')
<div class = 'container'>
    @foreach ($articles as $article)
    <div class = 'card mb-3'>
        <div class = 'card-body' >
            <h5 class = 'card-title'>
                {{$article->title}}
            </h5> 
            <p class = 'card-text'>
                {{Str::limit($article -> content,200)}}
            </p>
            <small>Source: {{$article->source->name}}</small>
        </div>
    </div>
    @endforeach
    {{$articles->links()}}
</div>
@endsection