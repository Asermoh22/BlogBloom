@extends('layout')

@section('title')
    {{$post->title}}
@endsection

@section('content')
<link rel="stylesheet" href="{{url('css/login.css')}}">


<nav class="navbar navbar-light" style="background-color: rgb(39, 39, 39); height : 80px;">
    <h3 style="color: white; position: relative; left :1180px ;top :5px">{{ Auth::user()->name }}</h3>

    <a class="navbar-brand" id="nav" style="color: white;">

    <a href="{{route('posts.edit',$post->id)}}" class="btn btn-danger" style="position: relative; left :400px">Edit Post</a>
            <a href="{{route('posts.delete',$post->id)}}" class="btn btn-danger" id="mm">Delete Post</a>


    </a>

</nav>
<img style="position: relative; left : 460px ;   width : 600px; height : 600px;"  id="image_card" src="{{ asset('uploads/posts/' . $post->img) }}">

<div style="background-color: rgb(22, 22, 22);     border-radius: 9px;" >
<h1 style="color: white; margin-top :50px" >    {{$post->title}}</h1>
    <h3 style="margin-top :20px; margin-bottom : 20px">    {{$post->desc}}</h3>
    <span class="fa fa-clock"></span>
    <p style="color: white; display: inline-block; margin: 0;">created : {{$post->created_at->format('F d, Y h:i A')}}</p>
</div>
@endsection