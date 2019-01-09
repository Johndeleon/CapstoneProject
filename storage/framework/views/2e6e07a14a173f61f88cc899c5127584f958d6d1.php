<?php $__env->startSection('title'); ?>
    Schedules Generation
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/GSDesign.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="mx-auto col-md-12">
        <div class="row">

          <?php if(count($programs)): ?>
            <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <div class="col-md-3 mb-2">
                <div class="card text-align">
                  <div class="card-body">
                    <h1><?php echo e($program->title); ?></h1>
                  </div>

                  <div class="card-footer">
                    <div class="row ml-3 mr-3">
                      

                      <div class="col-md-3">
                        <a href="/admin/generate-form/<?php echo e($program->id); ?>">
                          <button class="btn btn-primary"><?php echo e($program->levels); ?></button>
                        </a>
                      </div>


                    </div>
                  </div>
                </div>
              </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>

          

        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>