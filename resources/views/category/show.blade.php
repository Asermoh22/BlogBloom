@extends('layout')

@section('title')
    Categories
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/login.css') }}">

<h1>{{$category->id}}</h1>

    <h1>{{$category->namecat}}</h1>

    <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger">Delete</a>
    <a href="{{route('category.edit',$category->id)}}" class="btn btn-danger">Edit</a>

    <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>

@endsection