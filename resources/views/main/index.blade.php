@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ url('css/main.css') }}">

<nav class="navbar navbar-light" style="background-color: rgb(39, 39, 39); height : 80px;">
    @auth
    <h3 style="color: white; position: relative; left : 1280px; top : 5px">{{ Auth::user()->name }}</h3>
    @endauth

    <a class="navbar-brand" id="nav" style="color: white;">
        @auth
        <a href="{{ route('users.logout') }}" class="btn btn-danger" id="logo">Logout</a>
        @endauth
        @guest
        <a href="{{ route('users.login') }}" class="btn btn-danger" id="logo">Login</a>
        @endguest
    </a>
</nav>

<input type="text" placeholder="Search" id="se" style="color: white">
<h1 id="st">Our Stories</h1>

<div id="AllPosts" class="AllPosts">
    <div class="row">
        @foreach ($posts as $item)
            <div class="col-md-5 mb-4" id="st">
                <div class="card" style="width : 25rem; background-color: rgb(22, 22, 22);">
                    <div>
                        @foreach ($item->categories as $cat)
                            <h5 style="color: palevioletred; display: inline-block; padding: 5px;">
                                {{ $cat->namecat }}
                            </h5>
                        @endforeach
                    </div>
                    <img class="card-img-top" src="{{ asset('uploads/posts/' . $item->img) }}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title" style="color: palevioletred">{{ $item->title }}</h5>
                        @auth
                        <p class="card-text" style="color: white">{{ $item->desc }}</p>
                        @endauth
                        @auth
                        <a href="{{ route('posts.show', $item->id) }}" class="btn btn-primary" id="nm">Detailed</a>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="sidebar">
    <h3 id="head">BlogBloom</h3>
    <div class="navigation">
        <ul>
            <li>
                <a href="{{ route('posts.create') }}">
                    <span class="fa fa-plus-square"></span>
                    <span>Create Post</span>
                </a>
            </li>
            <li>
                <a href="{{route('posts.myposts')}}">
                    <span class="fa fa-heart"></span>
                    <span>My Posts</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="fa fa-eye"></span>
                    <span>About Us</span>
                </a>
            </li>
        </ul>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if(session('alert'))
            alert('{{ session('alert') }}');
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        $('#se').keyup(function() {
            let keyword = $(this).val();
            let url = "{{ route('posts.search') }}" + "?keyword=" + encodeURIComponent(keyword);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#AllPosts').empty(); // Clear the existing posts

                    // Check if data is an array and not empty
                    if (Array.isArray(data) && data.length) {
                        data.forEach(element => {
                            $('#AllPosts').append(`
                                <div class="row">
                                    <div class="col-md-5 mb-4" id="st">
                                        <div class="card" style="width : 25rem; background-color: rgb(22, 22, 22);">
                                            <img class="card-img-top" src="{{ asset('uploads/posts/') }}/${element.img}" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title" style="color: palevioletred">${element.title}</h5>
                                                @auth
                                                <p class="card-text" style="color: white">${element.desc}</p>
                                                @endauth
                                                @auth
                                                <a href="{{ route('posts.show', '') }}/${element.id}" class="btn btn-primary" id="nm">Detailed</a>
                                                @endauth
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        $('#AllPosts').append('<p>No posts found</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ', status, error);
                }
            });
        });
    });
</script>
@endsection
