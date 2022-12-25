@extends('layouts.app')

@section('title', "$post->title")

@section('content')

<!-- Post Section Starts Here-->

<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <hr>

                <h2 class="wow fadeInUp" data-wow-delay="1.2s"><a href="{{ url('category/' . $category->id . '/' . $post->id) }}" style="text-decoration: none; color: #fff;">{!! $post->title !!}</a></h2>
                <h4 class="wow fadeInUp" data-wow-delay="1.4s"><span style="color: gray;">By</span> {{ $post->user->name }}</h4>

                <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $category->name }}</span>

                <br><br>

                <div class="row">
                    <div class="col-lg-4">
                        <p class="wow fadeInUp" data-wow-delay="1.4s">DATE POSTED:</p>
                        <h6 class="wow fadeInUp" data-wow-delay="1.6s">{{ $post->created_at->format('m-d-Y') }}</h6>
                    </div>

                    <!-- <div class="col-lg-4">
                        <p class="wow fadeInUp" data-wow-delay="1.4s">CATEGORY:</p>
                        <h6 class="wow fadeInUp" data-wow-delay="1.6s">{{ $category->name }}</h6>
                    </div> -->
                </div>

                <br><br>
                <div class="row post-description">
                    <span class="wow fadeInUp" data-wow-delay="1.6s">{!! $post->description !!}</span>
                </div>
                <br><br>

                <hr>

                <h1 class="wow fadeInUp" data-wow-delay="1s">Latest Posts</h1>
                <hr style="opacity: 5%;">
                @foreach($latest_post as $latest_post_item)
                <h2 class="wow fadeInUp" data-wow-delay="1.2s"><a href="{{ url('category/' . $latest_post_item->category->id . '/' . $latest_post_item->id) }}" style="text-decoration: none; color: #fff;">{{ $latest_post_item->title }}</a></h2>
                <h4 class="wow fadeInUp" data-wow-delay="1.4s"><span style="color: gray;">By</span> {{ $latest_post_item->user->name }}</h4>

                <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $latest_post_item->category->name }}</span>

                <br><br>

                <div class="row">
                    <div class="col-lg-4">
                        <p class="wow fadeInUp" data-wow-delay="1.4s">DATE POSTED:</p>
                        <h6 class="wow fadeInUp" data-wow-delay="1.6s">{{ $latest_post_item->created_at->format('m-d-Y') }}</h6>
                    </div>

                    <!-- <div class="col-lg-4">
                        <p class="wow fadeInUp" data-wow-delay="1.4s">CATEGORY:</p>
                        <h6 class="wow fadeInUp" data-wow-delay="1.6s">{{ $category->name }}</h6>
                    </div> -->
                </div>

                <br>

                <hr style="opacity: 2%;">

                <br>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    .pagination>li>a {
        background-color: #0f0f0f;
        color: #fff;
    }

    .pagination {
        position: fixed;
    }

    .active>.page-link,
    .page-link.active {
        background-color: #fff;
        color: #0f0f0f;
        border-color: #fff;
    }

    .pagination .active a {
        color: #ffffff;
        cursor: default;
    }

    .pagination>li>a:focus,
    .pagination>li>a:hover,
    .pagination>li>span:focus,
    .pagination>li>span:hover {
        z-index: 3;
        color: #0f0f0f;
        background-color: #fff;
        border-color: #fff;
    }

    .pagination>.active>a {
        color: white;
        background-color: #0f0f0f !important;
        border: none !important;
    }

    .pagination>.active>a:hover {
        background-color: #0f0f0f !important;
        border: none;
    }

    .post-description {
        overflow-y: scroll;
        scrollbar-width: none;
    }

    .code-bg {
        width: fit-content;
        min-width: 100%;
        background-color: #0f0f0f !important;
        overflow-x: scroll !important;
        position: relative;
        padding: 1rem 1rem;
        margin-bottom: 1rem;
    }
</style>

<!-- Post Section Ends Here -->

@endsection