@extends('layouts.app')

@section('title', "Add Post")

@section('content')

<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">Add Post</h1>
                <hr>

            </div>
        </div>
    </div>
    <!-- Hero Section Ends Here -->

    <!-- Form Section Starts Here-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <form method="POST" action="{{ url('add-post') }}" enctype="multipart/form-data" id="add-post">
                    @csrf

                    <ul>
                        @if(session('message'))
                        <div class="alert alert-dark wow fadeInUp" data-wow-delay="1.2s" role="alert">{{ session('message') }}</div>
                        @endif

                        @if($errors->any())
                        <div class="alert alert-danger wow fadeInUp" data-wow-delay="1.2s" role="alert">
                            @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        @endif

                        @if(Auth::check())
                        <li class="wow fadeInUp" data-wow-delay="1.4s">
                            <div class="mb-3">
                                <label>Category:</label>
                                <select name="category_id" class="form-control" id="">
                                    @foreach ($category as $catitem)
                                    <option value="{{ $catitem->id }}">{{ $catitem->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </li>
                        @endif

                        <li class="wow fadeInUp" data-wow-delay="1.4s">
                            <div class="textarea mb-3">
                                <label>Post Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                        </li>

                        <li class="wow fadeInUp" data-wow-delay="1.6s">
                            <div class="textarea mb-3">
                                <label>Description</label>
                                <textarea name="description" id="summernote" rows="5" class="form-control"></textarea>
                            </div>
                        </li>

                        <!-- <li class="wow fadeInUp" data-wow-delay="1.8s">
                            <div class="mb-3">
                                <label>File Upload</label>
                                <input type="file" name="file_id" class="form-control">
                            </div>
                        </li> -->

                        <li class="wow fadeInUp" data-wow-delay="2s">
                            <div class="mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status" />
                            </div>
                        </li>
                    </ul>

                    <button type="submit" name="post-submit" id="submit" class="send wow fadeInUp" data-wow-delay="2.2s">Add Post</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Form Section Ends Here -->
</div>


@endsection