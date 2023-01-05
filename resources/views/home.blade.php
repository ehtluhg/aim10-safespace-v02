@extends('layouts.app')

@section('title', "Welcome to safespace!")

@section('content')
<!-- Hero Section Starts Here-->
<div class="hero">
    <div class="header">
        <h1 class="line anim-typewriter">where everyone's thoughts matter</h1>
    </div>
</div>



<div class="scroll-down"></div>
<!-- Hero Section Ends Here -->

<!-- Posts Section Starts Here-->
<div class="container-fluid">
    @if(session('message'))
    <br>
    <div class="mx-10 alert alert-dark" role="alert">{{ session('message') }}</div>
    <br>
    @endif

    @if($errors->any())
    <br>
    <div class="mx-10 alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <div>{{ $error }}</div>
        @endforeach
    </div>
    <br>
    @endif
    <br><br><br>


</div>
    @endsection