@extends('layout')

@section('title')
    Edit Post
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/login.css') }}">

<h1 class="tit">Edit Post</h1>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="con">
    <form action="{{ route('posts.update',$post->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{$post->title}}" >
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description : </label>
            <textarea class="form-control" id="exampleInputPassword1" name="desc" rows="3" >{{$post->desc}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="exampleInputPassword1" name="image" >
        </div>
        <button type="submit" class="btn btn-signin">Edit 
            your Post</button>
    </form>
</div>
@endsection
