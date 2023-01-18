@extends('layouts.app')

@section('title', "Your Friends")

@section('content')

<!-- Post Section Starts Here-->
<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">Your Friends</h1>
                <hr>
                
                @if(Auth::check())
                <h3 class="wow fadeInUp" data-wow-delay="1s">Friends
                    @if($friendsCount != 0)
                    <span class="badge bg-dark">{{ $friendsCount }}</span>
                    @endif
                </h3>
                <hr style="opacity: 5%;">
                @forelse($friendsList as $friends)
                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">{{ $friends->requestedBy->name }}</h4>

                    <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $friends->requestedBy->email }}</span>



                    <br>

                    <div class="mt-3">
                        <button type="button" class="wow fadeInUp btn btn-outline-success btn-sm" data-wow-delay="1.6s"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                            </svg> FRIENDS</button>
                        <a href="{{ url('unfriend/' . $friends->requestedBy->id) }}"><button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">UNFRIEND</button></a>
                    </div>
                    <hr style="opacity: 5%;">

                </div>

                @empty
                <br>

                <div>
                    <h4 class="wow fadeInUp text-muted" data-wow-delay="1.4s">No friends yet :(</h4>
                </div>

                <br>

                @endforelse
                <h3 class="wow fadeInUp" data-wow-delay="1s">Friend Requests
                    @if($requestsCount != 0)
                    <span class="badge bg-danger">{{ $requestsCount }}</span>
                    @endif
                </h3>
                <hr style="opacity: 5%;">
                @forelse($friendRequestsList as $friendRequests)
                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">{{ $friendRequests->requestedBy->name }}</h4>

                    <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $friendRequests->requestedBy->email }}</span>



                    <br>

                    <div class="mt-3">
                        <a href="{{ url('accept-friend/' . $friendRequests->requestedBy->id ) }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">ACCEPT</button></a>
                        <a href="{{ url('cancel/' . $friendRequests->requestedBy->id ) }}"><button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">CANCEL</button></a>
                    </div>

                    <hr style="opacity: 5%;">

                </div>

                @empty
                <br>

                <div>
                    <h4 class="wow fadeInUp text-muted" data-wow-delay="1.4s">No pending requests yet :(</h4>
                </div>

                <br>

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