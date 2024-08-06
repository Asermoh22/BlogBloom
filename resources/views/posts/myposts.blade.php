@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ url('css/main.css') }}">

<div class="container mt-4">
    <h1>your Posts : {{Auth::user()->name}}</h1>

    @if($posts->isEmpty())
        <p>You have not shared any posts yet.</p>
    @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-5 mb-4" id="st">
                    <div class="card" style="width : 25rem; background-color: rgb(22, 22, 22);">
                        <div>
                            @foreach ($post->categories as $cat)
                                <h5 style="color: palevioletred; display: inline-block; padding: 5px;">
                                    {{ $cat->namecat }}
                                </h5>
                            @endforeach
                        </div>
                        <img class="card-img-top" src="{{ asset('uploads/posts/' . $post->img) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title" style="color: palevioletred">{{ $post->title }}</h5>
                            @auth
                            <p class="card-text" style="color: white">{{ $post->desc }}</p>
                            @endauth
                            @auth
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary" id="nm">Detailed</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
