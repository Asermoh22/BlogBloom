@extends('layout')

@section('title')
    New Post
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/login.css') }}">

<h1 class="tit">New Post</h1>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="con">
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="title" >
        </div>
        <div class="mb-3">
            <label for="desc" class="form-label">Description : </label>
            <textarea class="form-control" id="exampleInputPassword1" name="desc" rows="3" ></textarea>
        </div>
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" class="form-control-file" id="exampleInputPassword1" name="img" >
        </div>
        @foreach ($categories as $item)
        <div class="form-check">
           <input class="form-check-input" type="checkbox" value="{{$item->id}}" id="flexCheckDefault" style="position: relative; left :530px; top :100px" name="categries_ids[]" > 
           <label class="form-check-label" for="flexCheckDefault">
               {{$item->namecat}}
           </label>
         </div>
        @endforeach
        <button type="submit" class="btn btn-signin">Share Post</button>
    </form>
</div>
@endsection
