<?php $__env->startSection('content'); ?>
  <?php echo e(csrf_field()); ?>


  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">

          <div class="card-header">Teachers
            <button class="item btn  btn-info" data-toggle="modal" data-target="#addTeacher">Add Teacher</button>
          </div>

          <div class="modal fade show" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form action="addteacher" method="post">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="">Create Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <label for="firstName">First Name</label>
                      <input name="first_name" type="text" class="form-control" id="" required>
                    </div>

                    <div class="form-group">
                      <label for="lastName">Last Name</label>
                      <input name="last_name" type="text" class="form-control" id="" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" class="form-control" id="" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="contactNumber">Contact Number</label>
                      <input name="contact_number" type="text" class="form-control" id="" min=1 required>
                    </div>

                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input name="email" type="email" class="form-control" id="" min=1 required>
                    </div>

                    <div class="form-group">
                      <div> <label for="Email">Available Days</label> </div>
                      <div> <input type=checkbox>Everyday>  </div>
                      <div> <input type=checkbox>Monday>    </div>
                      <div> <input type=checkbox>Tuesday>   </div>
                      <div> <input type=checkbox>Wednesday> </div>
                      <div> <input type=checkbox>Thursday>  </div>
                      <div> <input type=checkbox>Friday>    </div>
                      <div> <input type=checkbox>Saturday>  </div>
                      <div> <input type=checkbox>Sunday>    </div>
                    </div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                    <button type="submit" class="btn btn-info">Create</button>
                  </div>

                </div>
              </form>
            </div>
          </div>


          <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="modal fade show" id="editTeacher<?php echo e($teacher->id); ?>" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form  method="POST" action="/editteacher/<?php echo e($teacher->id); ?>">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="">Edit Teacher</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <label for="firstName">First Name</label>
                      <input name="first_name" type="text" class="form-control" id="" value="<?php echo e($teacher->first_name); ?>"required>
                    </div>

                    <div class="form-group">
                      <label for="lastName">Last Name</label>
                      <input name="last_name" type="text" class="form-control" id="" value="<?php echo e($teacher->last_name); ?>" required>
                    </div>

                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" class="form-control" id="" rows="3" required><?php echo e($teacher->address); ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="contactNumber">Contact Number</label>
                      <input name="contact_number" type="text" class="form-control" id="" min=1  value="<?php echo e($teacher->contact_number); ?>"required>
                    </div>

                    <div class="form-group">
                      <label for="Email">Email</label>
                      <input name="email" type="email" class="form-control" id="" value="<?php echo e($teacher->email); ?>" required>
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

          <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="modal fade show" id="deleteTeacher<?php echo e($teacher->id); ?>" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">

                <div class="modal-header">
                  <h1 class="lead">Delete Teacher?</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                  <form action="deleteteacher/<?php echo e($teacher->id); ?>" method="get">
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

<?php echo $__env->make('layouts.app2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>