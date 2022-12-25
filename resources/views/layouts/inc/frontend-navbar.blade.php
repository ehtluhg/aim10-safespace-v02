<!-- Navigation Bar Starts Here -->
<style>
    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #0f0f0f;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        color: #fff;
        padding: 10px;
        font-size: 15px;
    }
</style>

<nav>
    <span id="brand">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/img/ss_logo_white.png') }}" alt="" width="30" height="30">
        </a>
        <a href="index.html">safespace</a>
    </span>

    <ul id="menu">
        <li><a href="index.html">HOME</a></li>
        <li class="dropdown"><a href="categories.html" class="dropdown-toggle">CATEGORIES</a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @php
                    $categories = App\Models\Category::where('status', '1')->get();
                @endphp
                @foreach($categories as $catitem)
                    <li><a class="dropdown-item" href="#">{{ $catitem->name }}</a></li>
                @endforeach
            </ul>
        </li>

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