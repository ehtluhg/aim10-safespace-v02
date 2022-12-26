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

                <!-- Form Section Starts Here-->

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 px-5">
                            <h3 class="wow fadeInUp" data-wow-delay="1s">Latest Comments</h3>
                            <hr style="opacity: 5%;">
                            <div class="comment-container">
                                @forelse($post->comments as $comment)
                                <h4 class="wow fadeInUp" data-wow-delay="1.2s">
                                    @if($comment->user)
                                    {{ $comment->user->name }}
                                    @endif
                                </h4>
                                <h6 class="wow fadeInUp" data-wow-delay="1.4s"><span style="color: gray;">Commented on: </span>{{ $comment->created_at->format('m-d-Y') }}</h6>

                                <br><br>

                                <div class="row">
                                    <span class="wow fadeInUp" data-wow-delay="1.6s">{!! $comment->comment_body !!}</span>
                                </div>

                                @if(Auth::check() && Auth::id() == $comment->user_id)
                                <!-- For checking if user is logged in -->
                                <br><br>
                                <button type="button" class="btn btn-outline-light btn-sm">Edit</button>
                                <button type="button" value="{{ $comment->id }}" class="deleteComment btn btn-outline-danger btn-sm">Delete</button>
                                @endif

                                <hr style="opacity: 2%;">

                                </div>
                                
                                @empty
                                <br><br>
                                <h3 class="wow fadeInUp" data-wow-delay="1.2s">There are no comments yet...</h3>
                                <br><br>
                            
                            @endforelse
                            <br>
                            <form name="add-post" id="add-post" method="post" action="{{ url('comments') }}">
                                @csrf

                                <ul>
                                    <!-- <li class="wow fadeInUp" data-wow-delay="1.4s">
                                        <label for="post-title">Title:</label>
                                        <div class="textarea wow fadeInUp">
                                            <input type="text" name="post-title" id="post-title" value="" required>
                                        </div>
                                    </li>

                                    <li class="wow fadeInUp" data-wow-delay="1.6s">
                                        <label for="post-category">Category:</label>
                                        <div class="textarea wow fadeInUp">
                                            <input type="text" name="post-category" id="post-category" value="" required>
                                        </div>
                                    </li> -->

                                    @if(session('message'))
                                    <div class="alert alert-dark" role="alert">{{ session('message') }}</div>
                                    @endif
                                    <li class="wow fadeInUp" data-wow-delay="1.8s">
                                        <label for="post-content">Leave a comment...</label>
                                        <div class="textarea wow fadeInUp">
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <textarea type="text" name="comment_body" rows="6" id="post-content" value="" required></textarea>
                                        </div>
                                    </li>

                                    <!-- <li class="wow fadeInUp" data-wow-delay="2s">
                                        <label for="post-file">File Upload:</label>
                                        <div class="textarea wow fadeInUp">
                                            <input type="file" name="post-file" id="post-file" value="">
                                        </div>
                                    </li> -->
                                </ul>

                                <button type="submit" name="comment-submit" class="send wow fadeInUp btn btn-outline-light btn-lg" data-wow-delay="2.2s">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Form Section Ends Here -->

                <!-- <div class="comment-area mt-4">
                    <div class="card card-body">
                        <h6 class="card-title">
                            Leave a comment...
                        </h6>
                        <form action="" method="POST">
                            <textarea name="comment_body" class="form-control" rows="5" required></textarea>
                            <button type="submit">Submit</button>
                        </form>
                    </div>

                    <div class="card card-body">
                        <div class="detail-area">
                            <h6 class="user-name">
                                User One
                                <small class="ms-3 text-primary">Commented on: 3-8-2022</small>
                            </h6>
                            <p class="user-comment">
                                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore magnam dolor excepturi. Aperiam totam, dolore animi accusamus hic amet saepe soluta, vel facilis in aspernatur tempore similique repudiandae fugiat reiciendis?
                            </p>
                        </div>
                        <div>
                            <a class="btn btn-link text-dark px-3 mb-0" href="#"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>
                                Edit
                            </a>
                            <a href="#" onclick="return confirm('Do you want to delete this category and its posts?');" class="btn btn-link text-danger text-gradient px-3 mb-0"><i class="far fa-trash-alt me-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div> -->
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

@section('scripts')

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.deleteComment', function() {

            if (confirm('Do you want to delete this comment?')) {
                var thisClicked = $(this);
                var comment_id = thisClicked.val();

                $.ajax({
                    type: "POST",
                    url: "/delete-comment",
                    data: {
                        'comment_id': comment_id
                    },
                    success: function(res) {
                        if (res.status == 200) {
                            thisClicked.closest('.comment-container').remove();
                            alert(res.message);
                        } else {
                            alert(res.message);
                        }
                    }
                })
            }
        });
    });
</script>

@endsection