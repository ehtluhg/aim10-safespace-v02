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
        padding-right: 5px;
    }

    .dropdown-menu a {
        transition: all 500ms;
    }

    .dropdown-menu a:hover {
        background-color: #0f0f0f;
        color: gray;
        font-size: 17px;
        font-size-adjust: 20px;
    }
</style>

<nav>
    <span id="brand">
        <a class="navbar-brand" href="#">
            @php
            $settings = App\Models\Setting::find(1);
            @endphp

            @if($settings)
            <img src="{{ asset('uploads/settings/' . $settings->logo) }}" alt="" width="30" height="30">
            @endif
        </a>
        <a href="{{ url('/') }}">safespace</a>
    </span>



    <ul id="menu">
        <li><a href="{{ url('/') }}">HOME</a></li>
        <li class="dropdown"><a href="{{ url('categories') }}" class="dropdown-toggle">CATEGORIES</a>
            <ul class="text-uppercase dropdown-menu" aria-labelledby="navbarDropdown">
                @php
                $categories = App\Models\Category::where('status', '1')->get();
                @endphp
                @foreach($categories as $catitem)
                <li><a class="dropdown-item" href="{{ url('category/' . $catitem->id )}}">{{ $catitem->name }}</a></li>
                @endforeach
            </ul>
        </li>

        <li><a href="about.html">ABOUT</a></li>
        <li class="dropdown"><a href="{{ url('/profile') }}" class="dropdown-toggle">PROFILE</a>
            <ul class="text-uppercase dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ url('requests')}}">FRIEND REQUESTS</a></li>
            </ul>
        </li>

        <li>
            <form data-wow-delay="1.0s" class="d-flex wow fadeInUp" id="add-post" action="{{ url('search') }}" method="GET" role="search">
                <input class="form-control me-2" name="search" type="search" value="{{ Request::get('search') }}" placeholder="Find friends..." aria-label="Search">
                <button class="btn btn-outline-success btn-sm mx-2" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search mb-1" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg></button>
            </form>
        </li>

        @if(Auth::check())
        <li><button type="button" class="btn btn-outline-light btn-sm" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                LOGOUT
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
        @else
        <li><button type="button" class="btn btn-light btn-sm"><a href="{{ url('/login') }}">
                {{ __('LOGIN') }}
            </a>
            </button>
            <form method="POST" action="{{ route('login') }}">
                @csrf
            </form>
        </li>
        @endif
    </ul>

    <div id="toggle">
        <div class="span">MENU</div>
    </div>

</nav>

<div id="resize">
    <div class="close-btn">CLOSE</div>

    <ul id="menu">
        <li><a href="{{ url('/') }}">HOME</a></li>
        <li><a href="categories.html">CATEGORIES</a></li>
        <li><a href="about.html">ABOUT</a></li>
        <li><a href="profile.html">PROFILE</a></li>
        <li><a href="login.html" style="color: gray">LOGIN</a></li>
    </ul>
</div>
<!-- Navigation Bar Ends Here -->