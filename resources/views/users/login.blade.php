@extends('layout')

@section('title')
    Login Form
@endsection

@section('content')
<link rel="stylesheet" href="{{url('css/login.css')}}">


<h1 class="tit">BlogBloom</h1>
<a href="{{route('posts.index')}}" class="btn btn-dark" style="color: palevioletred; position: relative; left :230px; bottom :20px">Get Start</a>
@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    <p>{{ session('error') }}</p>
</div>
@endif
<div class="con">


    <form action="{{route('users.handellogin')}}" method="post">

        @csrf
            
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Email address</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{old('email')}}" >
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <a href="{{route('users.register')}}" id="crr">Create Account ?</a>
            <br>
            <h3 id="crr">Sign with : </h3>
            <a href="{{route('users.redirect')}}" id="crr"><i class="fa-brands fa-github" style="color: #B197FC;"></i></a>
          
            <a href="{{route('users.redirectgoog')}}" id="crr"><i class="fa-brands fa-google" style="color: #B197FC;"></i></a>
            <br>
            <button type="submit" class="btn btn-signin">Sign In</button>

          </form>
    
</div>

@endsection