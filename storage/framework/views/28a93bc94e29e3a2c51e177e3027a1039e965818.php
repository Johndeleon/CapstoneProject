<?php $__env->startSection('title'); ?>
  Program Page
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head'); ?>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
<?php echo e(csrf_field()); ?>


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header"> <span style="margin-top: 3px">Programs</span>
          <button class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addProgram">
            Add Program
          </button>
        </div>

        <div class="row">
          <div class="col-md-12">

            <div class="table-responsive table">

              <table class="table-bordered">
                <tr class="text-center">
                  <th width="28%">Subject Title</th>
                  <th width="55%">Description</th>
                  <th width="12%">Action</th>
                </tr>

                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <?php echo e($program->title); ?>

                      
                    </td>

                    <td>
                      <?php echo e($program->description); ?>

                    </td>

                    <td>
                      <button class="item btn  btn-info" data-toggle="modal" role="Edit" title="Edit" data-target="#editProgram<?php echo e($program->id); ?>">
                        <i class="fa fa-edit" aria-hidden="true"></i>
                      </button>

                      <button class="item btn  btn-danger" data-toggle="modal" role="Delete" title="Delete" data-target="#deleteProgram<?php echo e($program->id); ?>">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </table>

            </div>

          </div>
        </div>










        
        <div class="modal fade show" id="addProgram" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

              <div class="modal-header"> <h5 class="modal-title" id="">Create Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <form action="/admin/addprogram" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="modal-body">
                  <div class="form-group">
                    <label for="programTitle">Program Name</label>
                    <input name="title" type="text" class="form-control" id="" required>
                  </div>
                  <div class="form-group">
                    <label for="programDescription">Description</label>
                    <textarea name="description" class="form-control" id="" rows="3" required></textarea>
                  </div>
                  <div class="form-group">
                    <label for="programLevels">Levels</label>
                    <input name="levels" type="number" class="form-control" id="" min=1 required>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                  <button type="submit" class="btn btn-info">Create</button>
                </div>
              </form>

            </div>
          </div>
        </div>


        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade show" id="editProgram<?php echo e($program->id); ?>" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog modal-lg" role="document">
            <form  method="POST" action="/editprogram/<?php echo e($program->id); ?>">
            <?php echo e(csrf_field()); ?>

              <div class="modal-content">

                <div class="modal-header"> <h5 class="modal-title" id="">Edit Program</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <div class="modal-body">
                  <div class="form-group">
                    <label for="programName">Program Name</label>
                    <input name="title" type="text" class="form-control" id="" value="<?php echo e($program->title); ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="programDescription">Program Description</label>
                    <textarea name="description" class="form-control" id="" rows="3" required><?php echo e($program->description); ?></textarea>
                  </div>

                  <div class="form-group">
                    <label for="levels">Levels</label>
                    <input name="levels" type="number" class="form-control" id="" value="<?php echo e($program->levels); ?>" min=1 required>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                  <button type="submit" class="btn btn-info">Save</button>
                </div>

              </div>
            </form>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade show" id="deleteProgram<?php echo e($program->id); ?>" tabindex="-1" role="dialog" aria-labelledby="">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">

              <div class="modal-header"> <h1 class="lead">Delete Course?</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>

                <form action="deleteprogram/<?php echo e($program->id); ?>" method="get">
                  <button type="submit" class="btn btn-danger">Delete</button>
                </form>
              </div>

            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>