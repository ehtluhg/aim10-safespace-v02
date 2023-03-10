@extends('layouts.app')

@section('title', "Categories")

@section('content')

<!-- Post Section Starts Here-->
<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

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

                @forelse($categories as $all_cat)


                <div class="card mt-3" onclick="location.href='{{ url('category/' . $all_cat->id) }}'">
                    @if($all_cat->image != NULL)
                    <img src="{{ asset('uploads/category/' . $all_cat->file->file_name) }}" class="card-img-top" alt="..." style="height: 200px; object-fit:cover">
                    @else
                    <img src="{{ asset('assets/img/site_logo_black.png') }}" class="card-img-top" alt="..." style="height: 200px; object-fit:cover">
                    @endif
                    <div class="card-body">
                        <h4 class="wow fadeInUp text-decoration-none text-center card-title" data-wow-delay="1.4s" style="color:#0f0f0f" onclick="location.href='{{ url('category/' . $all_cat->id) }}'">{{ $all_cat->name }}</h4>
                        <p class="wow fadeInUp text-decoration-none text-center card-text" data-wow-delay="1.6s">{!! $all_cat->description !!}</p>
                    </div>
                </div>

                @empty
                <h4 class="wow fadeInUp text-decoration-none text-center card-title" data-wow-delay="1.4s" style="color:#0f0f0f">There are no categories yet...</h4>


                @endforelse

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