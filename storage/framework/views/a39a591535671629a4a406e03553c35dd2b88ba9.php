<?php $__env->startSection('title'); ?>
  Rooms Page
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
  <?php echo e(csrf_field()); ?>


  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">

          <div class="card-header"><span style="line-height: 2em;">Rooms</span>
            <button class="item btn btn-info btn-sm float-right" data-toggle="modal" data-target="#addRoom">
              Add Room
            </button>
          </div>

          <div class="row">
            <div class="col-md-12 table-responsive">

              <table class="table table-bordered">
                <tr class="text-center">
                  <th>Room Name</th>
                  <th>Room Type</th>
                  <th>Room Available From</th>
                  <th>Room Available Until</th>
                  <th width="12.5%">Actions</th>
                </tr>

                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td>
                    <?php echo e($room->room_name); ?>

                  </td>

                  <td>
                    <?php echo e($room->room_type); ?>

                  </td>

                  <td>
                    <?php echo e($room->available_time_start); ?>

                  </td>

                  <td>
                    <?php echo e($room->available_time_finish); ?>

                  </td>

                  <td>
                    <button class="item btn  btn-info" data-toggle="modal" data-target="#editRoom<?php echo e($room->id); ?>">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </button>
                    <button class="item btn  btn-danger" data-toggle="modal" data-target="#deleteRoom<?php echo e($room->id); ?>">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </table>

            </div>
          </div>



          <div class="modal fade show" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form action="addroom" method="post">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="">Create Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <label for="roomName">Room Name</label>
                      <input name="room_name" type="text" class="form-control" id="" required>
                    </div>

                    <div class="form-group">
                      <label for="roomType">Room Type</label>

                      <select name="room_type" class="form-control" required>
                        <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option><?php echo e($roomType->room_type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="availableFrom">Available From</label>

                      <select name="available_from" class="form-control" required>
                        <?php for($i=0;$i<$count;$i++): ?>
                          <option><?php echo e($times[$i]); ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="availableFrom">Available Until</label>

                      <select name="available_until" class="form-control" required>
                        <?php for($i=0;$i<$count;$i++): ?>
                          <option><?php echo e($times[$i]); ?></option>
                        <?php endfor; ?>
                      </select>
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

          <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="modal fade show" id="editRoom<?php echo e($room->id); ?>" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-lg" role="document">
              <form  method="POST" action="/editroom/<?php echo e($room->id); ?>">
                <div class="modal-content">

                  <div class="modal-header">
                  <h5 class="modal-title" id="">Edit Room</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  </div>

                  <div class="modal-body">
                    <div class="form-group">
                      <label for="roomName">Room Name</label>
                      <input name="room_name" type="text" class="form-control" id="" value="<?php echo e($room->room_name); ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="roomType">Room Type</label>

                      <select name="room_type" class="form-control" required>
                        <?php $__currentLoopData = $roomTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option><?php echo e($roomType->room_type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="availableFrom">Available From</label>

                      <select name="available_from" class="form-control" required>
                        <?php for($i=0;$i<$count;$i++): ?>
                          <option><?php echo e($times[$i]); ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="availableFrom">Available Until</label>

                      <select name="available_until" class="form-control" required>
                        <?php for($i=0;$i<$count;$i++): ?>
                          <option><?php echo e($times[$i]); ?></option>
                        <?php endfor; ?>
                      </select>
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

          <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="modal fade show" id="deleteRoom<?php echo e($room->id); ?>" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="lead">Delete Room?</h1>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Discard</button>
                  <form action="deleteroom/<?php echo e($room->id); ?>" method="get">
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