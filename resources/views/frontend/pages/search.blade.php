@extends('layouts.app')

@section('title', "Search Results")

@section('content')

<!-- Post Section Starts Here-->
<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">Search Results:</h1>
                <hr>
                @if(Auth::check())
                @forelse($searchUsers as $searchResult)
                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">{{ $searchResult->name }}</h4>
                    <!-- If user follows you back:
                    if(searchResult->id == friend_id)
                    <span class="wow fadeInUp badge rounded-pill text-bg-light" data-wow-delay="1.4s">FOLLOWS YOU</span>
                    endif -->
                    <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $searchResult->email }}</span>
                    <br>

                    @if(Auth::id() != $searchResult->id)
                    <div class="mt-3">
                        @if($friendStatus == "Friend Request Sent")
                        <button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">FOLLOWING</button>
                        <a href="{{ url('/unfollow/' . $searchResult->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">UNFOLLOW</button></a>
                        @elseif($friendStatus == "Unfriend")
                        <a href="{{ url('/add-friend/' . $searchResult->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">FOLLOW</button></a>
                        @else
                        <a href="{{ url('/add-friend/' . $searchResult->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">FOLLOW</button></a>
                        @endif
                    </div>
                    @else
                    <div class="mt-3">
                        <a href="{{ url('profile') }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">VIEW PROFILE</button></a>
                    </div>
                    @endif
                    <hr style="opacity: 5%;">

                </div>

                @empty
                <br>

                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">No users found ahu :(</h4>
                </div>

                <br>

                @endforelse

                @else
                <br>

                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">Log in first to find friends...</h4>
                </div>

                <br>

                @endif

                <div class="pagination wow fadeInUp" data-wow-delay="1.8s">
                    {{ $searchUsers->appends(request()->input())->links() }}
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