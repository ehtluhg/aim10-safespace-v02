@extends('layouts.app')

@section('title', "safespace —— Home")

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
    <br><br><br>

    <h6>LATEST POSTS</h6>

    <div class="vertical"></div>
    <br>

    <div class="whitespace"></div>
    <div class="whitespace"></div>

    @foreach($latest_post as $latest_post_item)
    <div style="padding: 5px 100px;">
        <h2 class="wow fadeInUp" data-wow-delay="1.2s"><a href="{{ url('category/' . $latest_post_item->category->id . '/' . $latest_post_item->id) }}" style="text-decoration: none; color: #fff;">{{ $latest_post_item->title }}</a></h2>
        <h4 class="wow fadeInUp" data-wow-delay="1.4s"><span style="color: gray;">By</span> {{ $latest_post_item->user->name }}</h4>

        <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $latest_post_item->category->name }}</span>

        <br><br>

        <div class="row">
            <div>
                <p class="wow fadeInUp" data-wow-delay="1.4s">DATE POSTED:</p>
                <p class="wow fadeInUp" data-wow-delay="1.6s" style="color: gray;">{{ $latest_post_item->created_at->format('m-d-Y') }}</p>
            </div>
        </div>

        <br>

        <hr style="opacity: 5%;">

        <br>
    </div>

    @endforeach

    <!-- <div class="row">
        <div class="col-lg-8"></div>

        <div class="col-lg-4 post post1 wow fadeInUp" onclick="location.href='post.html'"></div>
    </div>

    <div class="whitespace"></div>

    <div class="row">
        <div class="col-lg-6 post post2 wow fadeInUp" onclick="location.href='post.html'"></div>

        <div class="col-lg-6"></div>
    </div>

    <div class="whitespace"></div>

    <div class="row">
        <div class="col-lg-7"></div>

        <div class="col-lg-4 post post3 wow fadeInUp" onclick="location.href='post.html'"></div>

        <div class="col-lg-1"></div>
    </div>

    <div class="whitespace"></div>

    <div class="row">
        <div class="col-lg-1"></div>

        <div class="col-lg-5 post post4 wow fadeInUp" onclick="location.href='post.html'"></div>

        <div class="col-lg-6"></div>
    </div> -->

    <div class="whitespace"></div>

    <br><br><br>

    <h6>CATEGORIES</h6>

    <div class="vertical"></div>
    <br>

    <div class="whitespace"></div>
    <div class="whitespace"></div>

    @foreach($all_categories as $all_cat)
    <h4 class="wow fadeInUp text-decoration-none text-center" data-wow-delay="1.4s" onclick="location.href='{{ url('category/' . $all_cat->id) }}'">{{ $all_cat->name }}</h4>
    @endforeach

    @endsection