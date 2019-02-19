<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrapcss/bootstrap.min.css')); ?>">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fa-brands.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fa-regular.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fa-solid.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome-all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/fontawesome-free-5.0.10/web-fonts-with-css/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/Linearicons-Free-v1.0.0/Web Font/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/jquery-ui.css')); ?>">
    <script src="<?php echo e(asset('js/jquery/jquery-3.3.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrapjs/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery/jquery-ui.js')); ?>"></script>

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/style4.css')); ?>">
    <!-- <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>"> -->



    <?php echo $__env->yieldContent('head'); ?>
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
    <?php if($accessLevel == 1): ?>
        <?php echo $__env->make('extends.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($accessLevel == 2): ?>
        <?php echo $__env->make('extends.sidebarProgHead', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php elseif($accessLevel == 3): ?>
        <?php echo $__env->make('extends.sidebarTeacher', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
        <!-- Page Content  -->
        <div id="content">

          
          <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">

              

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                  <?php if(auth()->guard()->guest()): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo e(url('login')); ?>"><?php echo e(__('Login')); ?></a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="<?php echo e(url('register')); ?>"><?php echo e(__('Register')); ?></a>
                    </li>

                    <?php else: ?>
                    <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(Auth::user()->name); ?> <span class="ml-2 lnr lnr-chevron-down"></span></a>

                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <?php if(Auth::user()->authority == 2): ?>
                          <a class="dropdown-item" href="<?php echo e(url('/superadmin/dashboard')); ?>" role="button">Superadmin Dashboard</a>
                        <?php endif; ?>
                          <a class="dropdown-item" href="<?php echo e(url('/profile')); ?>" role="button">My Profile</a>
                          <a class="dropdown-item" href="<?php echo e(url('/logout')); ?>" role="button">Logout</a>
                      </div>
                    </li>
                  <?php endif; ?>


                <!-- <li class="nav-item">
                <a class="nav-link" href="#">Page</a>
                </li>-->
                </ul>
              </div>

            </div>
          </nav>

            <?php echo $__env->yieldContent('body'); ?>

        </div>
    </div>

    <div class="container-fluid">
        <?php if(session('added')): ?>
        <div class="alert alert-success alert-dismissible fade show position-fixed" role="alert">
            <strong>Success!</strong> <?php echo e(session('added')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php elseif(session('updated')): ?>
        <div class="alert alert-primary alert-dismissible fade show position-fixed" role="alert">
            <strong>Success!</strong> <?php echo e(session('updated')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php elseif(session('deleted')): ?>
        <div class="alert alert-danger alert-dismissible fade show position-fixed" role="alert">
            <strong>Success!</strong> <?php echo e(session('deleted')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
    </div>

    <!-- <footer class="footer mt-5">
        
    </footer> -->

    <script type="text/javascript">
      <?php echo $__env->yieldContent('footerScript'); ?>
    </script>

</body>
</html>

