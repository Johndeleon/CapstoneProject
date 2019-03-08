<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> @yield('title') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <!-- Bootstrap 4.0 -->
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap-4.0.0/dist/css/bootstrap.min.css') }}">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="{{ asset('css/bower_components/bootstrap/dist/css/bootstrap.min.css') }}"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('css/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('css/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/ownStyle/app1.css') }}">

  {{-- DATA TABLES PLUGINS --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('css/plugins/datatables/dataTables.bootstrap4.css') }}">

  {{-- SELECT2 PLUGINS --}}
  <link href="{{ asset('css/plugins/select2/select2.min.css') }}" rel="stylesheet"> 
  <link href="{{ asset('css/plugins/select2/select2-bootstrap4.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/all.class.css') }}">

@yield('styles')

  <!-- Morris chart -->
  <!-- <link rel="stylesheet" href="{{ asset('css/bower_components/morris.js/morris.css') }}"> -->
  <!-- jvectormap -->
  <!-- <link rel="stylesheet" href="{{ asset('css/bower_components/jvectormap/jquery-jvectormap.css') }}"> -->
  <!-- Date Picker -->
  <!-- <link rel="stylesheet" href="{{ asset('css/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"> -->
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="{{ asset('css/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}"> -->
  <!-- bootstrap wysihtml5 - text editor -->
  <!-- <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}

  <style type="text/css">
    .pink {
      background: pink;
    }
  </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/admin/dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>CSS</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Class Scheduling System</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      {{-- INSERT THE USER STATUS --}}
      @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        <li class="nav-item">
            @if (Route::has('register'))
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        </li>

      @else
        <div class="position-relative logout-btn">
          <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              <i class="fa fa-user" aria-hidden="true"></i>&nbsp {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </div>
        </div>

      @endguest
      

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        {{-- <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li> --}}

        {{-- Dashboard --}}
        <li class="active">
          <a href="/admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>  

        {{-- Maintenance --}}
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Maintenance</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/programs"><i class="fa fa-book" aria-hidden="true"></i> Programs</a></li>
            <li><a href="/admin/teachers"><i class="fa fa-users" aria-hidden="true"></i> Teachers</a></li>
            <li><a href="/admin/courses"><i class="fa fa-circle-o"></i> Courses</a></li>
            <li><a href="/admin/rooms"><i class="fa fa-building-o" aria-hidden="true"></i> Rooms</a></li>
          </ul>
        </li>

        {{-- Generates Schedule Module --}}
        <li>
          <a href="/admin/generate-form-schedules">
            <i class="fa fa-calendar-o" aria-hidden="true"></i> <span>Generate Schedule</span>
            <span class="pull-right-container">
              
            </span>
          </a>
        </li>        

        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Maintenance</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Programs</a></li>
            <li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Teachers</a></li>
            <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Courses</a></li>
            <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Rooms</a></li>
          </ul>
        </li>
        <li>
          <a href="/admin/courses">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> --}}

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer> -->
</div> <!-- ./wrapper -->

<script src="{{ asset('js/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrapjs/bootstrap-4.0.0/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/class/all.class.js') }}"></script>
@yield('scriptstop')
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootbox/bootbox.js') }}"></script>
@yield('scripts')

<!-- Bootstrap 3.3.7 -->
<!-- <script src="{{ asset('js/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script> -->
<!-- Morris.js charts -->
<!-- <script src="{{ asset('js/bower_components/raphael/raphael.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/bower_components/morris.js/morris.min.js') }}"></script> -->
<!-- Sparkline -->
<!-- <script src="{{ asset('js/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script> -->
<!-- jvectormap -->
<!-- <script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{{ asset('js/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script> -->
<!-- daterangepicker -->
<!-- <script src="{{ asset('js/bower_components/moment/min/moment.min.js') }}"></script> -->
<!-- <script src="{{ asset('js/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script> -->
<!-- datepicker -->
<!-- <script src="{{ asset('js/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<!-- <script src="{{ asset('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script> -->
<!-- Slimscroll -->
<!-- <script src="{{ asset('js/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script> -->
<!-- FastClick -->
<script src="{{ asset('js/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('js/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('js/dist/js/pages/dashboard.js') }}"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('js/dist/js/demo.js') }}"></script> -->
</body>
</html>
