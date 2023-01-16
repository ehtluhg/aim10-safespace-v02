@extends('layouts.app')

@section('title', 'About safespace')

@section('content')

<div class="container">
    <div class="hero-content">
        <br><br>

        <div class="row">
            <div class="col-lg-12">
                <br>

                <h1 class="wow fadeInUp" data-wow-delay="1s">About Us</h1>
                <hr>

                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 about image wow fadeInUp" data-wow-delay="1s">
                                    <img src="{{ asset('assets/img/ss_logo_white.png') }}">
                                </div>
                            </div>
                        </div>
                        <br>

                        <h2 class="wow fadeInUp" data-wow-delay="1.1s">safespace</h2>
                        <h4 class="wow fadeInUp text-muted" data-wow-delay="1.1s">where everyone's thoughts matter</h4>
                        
                        <br>
                        <p class="wow fadeInUp" data-wow-delay="1.2s">At <strong>safespace</strong>, we strive to provide our users with the sanctuary they deserve in order to share their ideas with the rest of the world. safespace is the only blog website where you can talk about and engage with individuals who share your interests. We believe that freedom of expression is essential for connecting with and collaborating with others. As a result, we developed this secure platform for critical voices. We want to broaden your worldview by providing you with diverse thoughts and opinions that are equally essential but often hidden in the depths of the internet.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection