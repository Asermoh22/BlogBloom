@extends('layout')

@section('title')
    New Category
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/login.css') }}">

<h1 class="tit">Edit Category</h1>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="con">
    <form action="{{ route('category.update',$category->id) }}" method="post" >
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Name :</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="namecat"  value="{{$category->namecat}}">
        </div>
     
        <button type="submit" class="btn btn-signin">Edit category</button>
    </form>
</div>
@endsection
