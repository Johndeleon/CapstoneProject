<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fa-brands.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fa-regular.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fa-solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Linearicons-Free-v1.0.0/Web Font/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

    <script src="{{ asset('js/jquery/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('js/bootstrapjs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-ui.js') }}"></script>


    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style4.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->



    @yield('head')
    <style>
        .alert {
            bottom: 10px;
            right: 10px;
        }
        .pink {
          background: pink;
        }
        .black {
          background-color: black;
        }
    </style>

</head>
<body>

    <!-- SIDEBAR -->
    <div class="wrapper">
    @if($accessLevel == 1)
        @include('extends.sidebar')
    @elseif($accessLevel == 2)
        @include('extends.sidebarProgHead')
    @elseif($accessLevel == 3)
        @include('extends.sidebarTeacher')
    @endif
        <!-- Page Content  -->
        <div id="content">

          {{-- PAGE NAVIGATION BAR --}}
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">

              {{-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify">What is this?</i>
              </button> --}}

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                  @guest
                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('login') }}">{{ __('Login') }}</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="{{ url('register') }}">{{ __('Register') }}</a>
                    </li>

                    @else
                    <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="ml-2 lnr lnr-chevron-down"></span></a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if (Auth::user()->authority == 2)
                          <a class="dropdown-item" href="{{ url('/superadmin/dashboard') }}" role="button">Superadmin Dashboard</a>
                        @endif
                          {{-- <a class="dropdown-item" href="{{ url('/profile') }}" role="button">My Profile</a> --}}
                          <a class="dropdown-item" href="{{ url('/logout') }}" role="button">Logout</a>
                      </div>
                    </li>
                  @endguest


                <!-- <li class="nav-item">
                <a class="nav-link" href="#">Page</a>
                </li>-->
                </ul>
              </div>

            </div>
          </nav>

            @yield('body')

        </div>
    </div>

    <div class="container-fluid">
        @if(session('added'))
        <div class="alert alert-success alert-dismissible fade show position-fixed" role="alert">
            <strong>Success!</strong> {{ session('added') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(session('updated'))
        <div class="alert alert-primary alert-dismissible fade show position-fixed" role="alert">
            <strong>Success!</strong> {{ session('updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @elseif(session('deleted'))
        <div class="alert alert-danger alert-dismissible fade show position-fixed" role="alert">
            <strong>Success!</strong> {{ session('deleted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    </div>

    <!-- <footer class="footer mt-5">
        {{-- <div class="text-center py-4">
            © 2018 Copyright: La Verdad Christian College, BS Information System Batch 2019</a>
        </div> --}}
    </footer> -->

    <script type="text/javascript">
      @yield('footerScript')
    </script>

</body>
</html>
{{-- @author Kenneth @since December 10 @modified Kenneth @since December 10--}}
