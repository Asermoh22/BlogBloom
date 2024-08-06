@extends('layout')

@section('title')
    Categories
@endsection

@section('content')
<link rel="stylesheet" href="{{ url('css/login.css') }}">
<h1 style="color: white">Categories : </h1>
@foreach ($categories as $category)
    <h3>{{$category->namecat}}</h3>
@endforeach
@endsection