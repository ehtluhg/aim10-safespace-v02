@extends('layouts.app')

@section('title', "Your Profile")

@section('content')

<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">Your Profile</h1>
                <hr>

            </div>
        </div>
    </div>
    <!-- Hero Section Ends Here -->

    <!-- Form Section Starts Here-->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <form method="POST" action="{{ url('profile') }}" id="add-post">
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
                            <div class="row g-2 mb-3">
                                <div class="col-md">
                                    <label>Username:</label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="text" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label>Email Address:</label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="email" name="email" readonly value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif

                        @if(Auth::check())
                        <li class="wow fadeInUp" data-wow-delay="1.4s">
                            <div class="row g-3 mb-3">
                                <div class="col-md">
                                    <label>First Name:</label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="text" name="first_name" value="{{ Auth::user()->userDetails->first_name ?? ''}}" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label>Middle Initial: <span class="text-muted">(Optional)</span></label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="text" name="middle_name" value="{{ Auth::user()->userDetails->middle_name ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label>Last Name:</label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="text" name="last_name" value="{{ Auth::user()->userDetails->last_name ?? ''}}" required>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="wow fadeInUp" data-wow-delay="1.6s">
                            <div class="row g-2 mb-3">
                                <div class="col-md">
                                    <label>Phone Number:</label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="text" placeholder="09XXXXXXXXX" name="phone_number" value="{{ Auth::user()->userDetails->phone_number ?? ''}}" required>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <label>Birthdate:</label>
                                    <div class="textarea wow fadeInUp">
                                        <input type="date" name="birthdate" value="{{ Auth::user()->userDetails->birthdate ?? ''}}" required>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="wow fadeInUp" data-wow-delay="1.8s">
                            <label>Pronouns:</label>
                            <select name="gender" class="form-control">                               
                                <option value="">-- Select Pronouns --</option>
                                <option value="1">He/Him</option>
                                <option value="2">She/Her</option>
                                <option value="3">They/Them</option>
                                <option value="4">Others...</option>
                            </select>
                        </li>

                        <!-- <li class="wow fadeInUp" data-wow-delay="2s">
                            <label for="user-file">Profile Picture:</label>
                            <div class="textarea wow fadeInUp">
                                <input type="file" name="file_id" value="">
                            </div>
                        </li> -->
                    </ul>

                    <button type="submit" name="user-submit" id="submit" class="send wow fadeInUp" data-wow-delay="2.2s">Save Details</button>

                    @else
                    <br>

                    <h2 class="wow fadeInUp" data-wow-delay="1.2s">Please log in first...</h2>

                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Form Section Ends Here -->
</div>


@endsection