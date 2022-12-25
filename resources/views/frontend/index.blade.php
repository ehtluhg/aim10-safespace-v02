@extends('layouts.app')

@section('content')
    <div class="wrapper">

        <!-- Navigation Bar Starts Here -->
        <nav>
            <span id="brand">
                <a href="index.html">safespace</a>
            </span>

            <ul id="menu">
                <li><a href="index.html">HOME</a></li>
                <li><a href="categories.html">CATEGORIES</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="profile.html">PROFILE</a></li>
                <li><a href="login.html" style="color: gray">LOGIN</a></li>
            </ul>

            <div id="toggle">
                <div class="span">MENU</div>
            </div>

        </nav>

        <div id="resize">
            <div class="close-btn">CLOSE</div>

            <ul id="menu">
                <li><a href="index.html">HOME</a></li>
                <li><a href="categories.html">CATEGORIES</a></li>
                <li><a href="about.html">ABOUT</a></li>
                <li><a href="profile.html">PROFILE</a></li>
                <li><a href="login.html" style="color: gray">LOGIN</a></li>
            </ul>
        </div>
        <!-- Navigation Bar Ends Here -->

        <!-- Hero Section Starts Here-->
        <div class="hero">
            <div class="header">
                <h1 class="line anim-typewriter">where everyone's thoughts matter</h1>
            </div>
        </div>

        <div class="scroll-down"></div>
        <!-- Hero Section Ends Here -->

        <!-- Posts Section Starts Here-->
        <div class="container-fluid">
            <br><br><br>

            <h6>FEATURED POSTS</h6>

            <div class="vertical"></div>
            <br>

            <div class="whitespace"></div>
            <div class="whitespace"></div>

            <div class="row">
                <div class="col-lg-8"></div>

                <div class="col-lg-4 post post1 wow fadeInUp" onclick="location.href='post.html'"></div>
            </div>

            <div class="whitespace"></div>

            <div class="row">
                <div class="col-lg-6 post post2 wow fadeInUp" onclick="location.href='post.html'"></div>

                <div class="col-lg-6"></div>
            </div>

            <div class="whitespace"></div>

            <div class="row">
                <div class="col-lg-7"></div>

                <div class="col-lg-4 post post3 wow fadeInUp" onclick="location.href='post.html'"></div>

                <div class="col-lg-1"></div>
            </div>

            <div class="whitespace"></div>

            <div class="row">
                <div class="col-lg-1"></div>

                <div class="col-lg-5 post post4 wow fadeInUp" onclick="location.href='post.html'"></div>

                <div class="col-lg-6"></div>
            </div>


            <div class="whitespace"></div>

            <!-- Footer Starts Here -->
            <div class="footer">
                <div class="container">
                    <br><br>

                    <div class="collab">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="wow fadeInUp">Got something on your mind? Share it with us.</p>
                            </div>
                        </div>
                    </div>

                    <br>

                    <div class="hr">
                        <div class="row"></div>
                    </div>

                    <br><br>

                    <div class="info">
                        <div class="row">
                            <div class="col-lg-4" id="personal">
                                <p class="wow fadeInUp">Connect with us!</p>
                                <h4 class="wow fadeInUp" data-wow-delay="0.2s">fb @safespace</h4>
                                <br><br>
                            </div>

                            <div class="col-lg-4" id="media">
                                <p class="wow fadeInUp" data-wow-delay="0s">Follow us!</p>

                                <ul>
                                    <li id="fb" class="wow fadeInUp" data-wow-delay="0.4s">Facebook</li>
                                    <li id="ig" class="wow fadeInUp" data-wow-delay="0.6s">Instagram</li>
                                    <li id="tw" class="wow fadeInUp" data-wow-delay="0.8s">Twitter</li>
                                </ul>

                                <br><br>
                            </div>

                            <div class="col-lg-4" id="address">
                                <p class="wow fadeInUp" data-wow-delay="0s">Let's chat in person</p>
                                <h4 class="wow fadeInUp" data-wow-delay="0.2s">safespace@gmail.com</h4>
                                <br><br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Posts Section Ends Here -->
    </div>

    <!-- Greensock CDN -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.3/TweenMax.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
    <script type="text/javascript">

        // Navigation Starts Here
        $("#toggle").click(function () {
            $(this).toggleClass('on');
            $("#resize").toggleClass("active");
        });

        $("#resize ul li a").click(function () {
            $(this).toggleClass('on');
            $("#resize").toggleClass("active");
        });

        $(".close-btn").click(function () {
            $(this).toggleClass('on');
            $("#resize").toggleClass("active");
        });

        // Navigation Ends Here

        // Nav Animation Starts Here
        TweenMax.from("#brand", 1, {
            delay: 0.4,
            y: 10,
            opacity: 0,
            ease: Expo.easeInOut
        })

        TweenMax.staggerFrom("#menu li a", 1, {
            delay: 0.4,
            opacity: 0,
            ease: Expo.easeInOut
        }, 0.1);

        // Nav Animation Ends Here
    </script>

@endsection