@extends('layouts.app')

@section('title', "$category->name")

@section('content')

<!-- Post Section Starts Here-->
<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">{{ $category->name }}</h1>
                <hr>
                @forelse($post as $postitem)
                <h2 class="wow fadeInUp" data-wow-delay="1.2s"><a href="{{ url('category/' . $category->id . '/' . $postitem->id) }}" style="text-decoration: none; color: #fff;">{{ $postitem->title }}</a></h2>
                <h4 class="wow fadeInUp" data-wow-delay="1.4s"><span style="color: gray;">By</span> {{ $postitem->user->name }}</h4>

                <br><br>

                <div class="row">
                    <div class="col-lg-4">
                        <p class="wow fadeInUp" data-wow-delay="1.4s">DATE POSTED:</p>
                        <h6 class="wow fadeInUp" data-wow-delay="1.6s">{{ $postitem->created_at->format('m-d-Y') }}</h6>
                    </div>

                    <!-- <div class="col-lg-4">
                        <p class="wow fadeInUp" data-wow-delay="1.4s">CATEGORY:</p>
                        <h6 class="wow fadeInUp" data-wow-delay="1.6s">{{ $category->name }}</h6>
                    </div> -->
                </div>

                <hr style="opacity: 5%;">

                <!-- <p class="wow fadeInUp" data-wow-delay="1.6s">{{ $postitem->description }}</p> -->

                @empty
                <br><br>
                <h1 class="wow fadeInUp" data-wow-delay="1.2s" style="text-align: center;">There are no posts yet :(</h1>
                <br><br>
                @endforelse

                <div class="pagination wow fadeInUp" data-wow-delay="1.8s">
                    {{ $post->links() }}
                </div>
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
</style>

<!-- Post Section Ends Here -->

@endsection