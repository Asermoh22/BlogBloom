@extends('layout')

@section('title')
    Register Form
@endsection

@section('content')
<link rel="stylesheet" href="{{url('css/login.css')}}">
<h1 class="tit">BlogBloom : Create Your Account</h1>

@if ($errors->any())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

{{-- <img src="{{ asset('97c47e881c027ca83232dfedaa734b53.jpg') }}" style="position: relative; top :90px; width : 300px; highet: 300px; left : 1100px"> --}}

<form action="{{route('users.handelregister')}}" method="post">

    @csrf
    <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{old('name')}}">
          </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="{{old('email')}}">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password">
        </div>
       
        <button type="submit" class="btn btn-primary" style="background-color: palevioletred; border-color: palevioletred;">Sign Up</button>
      </form>
@endsection