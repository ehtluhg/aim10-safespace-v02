@extends('layouts.app')

@section('title', "$friend->name's Profile")

@section('content')

<!-- Post Section Starts Here-->
<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">User Profile</h1>
                <hr>
                @if(Auth::check())
                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">{{ $friend->name }}</h4>

                    <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $friend->email }}</span>



                    <br>

                    @if(Auth::id() != $friend->id)
                    <div class="mt-3">
                        @if($friendStatus == "Friend Request Sent")
                        <button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">FRIEND REQUEST SENT</button>
                        <!-- <a href="{{ url('/unfollow/' . $friend->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">UNFOLLOW</button></a> -->
                        @elseif($friendStatus == "Unfriend")
                        <button type="button" class="wow fadeInUp btn btn-outline-success btn-sm" data-wow-delay="1.6s"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                            </svg> FRIENDS</button>
                        <a href="{{ url('/unfriend/' . $friend->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">UNFRIEND</button></a>
                        @elseif($friendStatus == "Accept")
                        <a href="{{ url('/accept-friend/' . $friend->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">ACCEPT</button></a>
                        <a href="{{ url('cancel/' . $friend->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">CANCEL</button></a>
                        @else
                        <a href="{{ url('/add-friend/' . $friend->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">ADD FRIEND</button></a>
                        @endif
                    </div>
                    @else
                    <div class="mt-3">
                        <a href="{{ url('profile') }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">VIEW PROFILE</button></a>
                    </div>
                    @endif


                </div>

                <!-- Latest Posts -->
                <hr style="opacity: 5%;">

                <h1 class="wow fadeInUp" data-wow-delay="1s">Latest Posts</h1>
                <hr style="opacity: 5%;">
                @forelse($latest_post as $latest_post_item)
                <h2 class="wow fadeInUp" data-wow-delay="1.2s"><a href="{{ url('category/' . $latest_post_item->category->id . '/' . $latest_post_item->id . '/' . $latest_post_item->created_by) }}" style="text-decoration: none; color: #fff;">{{ $latest_post_item->title }}</a></h2>
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

                @empty
                <br><br>
                <h3 class="wow fadeInUp text-muted" data-wow-delay="1.2s">No more posts from this user...</h3>
                <br><br>
                <hr style="opacity: 5%;">

                @endforelse

                @else
                <br>

                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">Log in first to view details...</h4>
                </div>

                <br>

                @endif

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