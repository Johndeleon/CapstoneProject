<nav class="navbar static-top navbar-expand-lg navbar-light nav mb-3 border-bottom">
        {{-- <a class="navbar-brand ml-5 mr-5" href="{{ url('home') }}"><img src="{{ asset('img/logo.png') }}" width="100px"></a> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="lnr lnr-menu"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @if (Auth::check())
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item mr-2 ml-2">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                </ul>
            @endif
            <ul class="navbar-nav mr-5">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('register') }}">{{ __('Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span class="ml-2 lnr lnr-chevron-down"></span></a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if (Auth::user()->authority == 2)
                                <a class="dropdown-item" href="{{ url('/superadmin/dashboard') }}" role="button">Superadmin Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ url('/profile') }}" role="button">My Profile</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}" role="button">Logout</a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>