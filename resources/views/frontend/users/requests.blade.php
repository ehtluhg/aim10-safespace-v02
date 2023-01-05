@extends('layouts.app')

@section('title', "Your Followers")

@section('content')

<!-- Post Section Starts Here-->
<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">Your Followers</h1>
                <hr>
                @if(Auth::check())
                @forelse($friendRequestsList as $friendRequests)
                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">{{ $friendRequests->requestedBy->name }}</h4>

                    <span class="wow fadeInUp badge text-bg-dark" data-wow-delay="1.4s">{{ $friendRequests->requestedBy->email }}</span>



                    <br>

                    <!-- <div class="mt-3">
                        <a href="{{ url('accept-friend/' . $friendRequests->requestedBy->id ) }}"><button type="button" class="wow fadeInUp btn btn-outline-light btn-sm" data-wow-delay="1.6s">ACCEPT</button></a>
                        <button type="button" class="wow fadeInUp btn btn-outline-danger btn-sm" data-wow-delay="1.6s">CANCEL</button>
                    </div> -->

                    <hr style="opacity: 5%;">

                </div>

                @empty
                <br>

                <div>
                    <h4 class="wow fadeInUp" data-wow-delay="1.4s">No followers yet :(</h4>
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