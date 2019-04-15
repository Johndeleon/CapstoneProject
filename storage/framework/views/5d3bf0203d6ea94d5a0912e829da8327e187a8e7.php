<?php $__env->startSection('body'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/myDesign.css')); ?>">

  <div class="container mb-5">
      <div class="row justify-content-center">
          <div class="col-md-8">

              <?php if(session('added')): ?>
                  <div id="SuccAdded" class="alert alert-success" role="alert">
                      <?php echo e(session('added')); ?>

                  </div>
              <?php endif; ?>
              <div class="card">
                <div class="card-body">
                    
                    <h2>Teacher's Tab</h2>

                    <form id="saveID" action="<?php echo e(URL::to('store/teacher')); ?>" class="form-group" method="post">

                      <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                          <label for="">First Name</label>
                          <input class="form-control" type="text" name="firstname" value="" required>
                        </div>

                        <div class="form-group">
                          <label for="">Last Name</label>
                          <input class="form-control" type="text" name="lastname" value="" required>
                        </div>

                        <div class="form-group">
                          <label for="">Contact Number</label>
                          <input class="form-control" type="number" name="contactnumber" value="" required>
                        </div>

                        <div class="form-group">
                          <label for="">Email</label>
                          <input class="form-control" type="text" name="email" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input class="form-control" type="text-area" name="address" value="" required>
                        </div>

                        <div class="form-group">
                            <h5>Available Days</h5>

                            <div class="table-responsive text-center">
                                <table class="table table-striped table-bordered table-condensed">

                                    <tr>
                                      <th>Monday</th>
                                      <th>Tuesday</th>
                                      <th>Wednesday</th>
                                      <th>Thursday</th>
                                      <th>Friday</th>
                                      <th>Saturday</th>
                                    </tr>

                                    <tr>
                                      <td>
                                          <input class="checkbox" type="checkbox" data-id="1">
                                      </td>
                                      <td>
                                          <input class="checkbox" type="checkbox" data-id="2">
                                      </td>
                                      <td>
                                          <input class="checkbox" type="checkbox" data-id="3">
                                      </td>
                                      <td>
                                          <input class="checkbox" type="checkbox" data-id="4">
                                      </td>
                                      <td>
                                          <input class="checkbox" type="checkbox" data-id="5">
                                      </td>
                                      <td>
                                          <input class="checkbox" type="checkbox" data-id="6">
                                      </td>
                                    </tr>

                                </table>
                            </div>
                        </div>

                        <button id="submitBtn" class="btn btn-success float-right" type="submit" name="button">Save</button>
                        <input id="saveAvaDay" type="hidden" name="available_days" value="">

                    </form>
                </div>
              </div>

          </div>
      </div>
  </div>


  <script type="text/javascript">
      $(document).ready(function() {
         $('.checkbox').prop('checked', true);
         var idsArr = [];

         /* CHECKING ALL THE CHECKED CHECKBOX AND TAKES THE DATA-ID */
         $('#submitBtn').click(function() {
            $('.checkbox:checked').each(function() {
                idsArr.push($(this).attr('data-id'));
            });

            storeVal();
         });

         /* STORE A VALUE OF AVAILABLE DAYS IN HIDDEN INPUT WITH A ID OF SAVEAVADAY */
         function storeVal() {
            var strIds = idsArr.join("");

            $('#saveAvaDay').attr('value', strIds);
         }

         /* ERROR HIDE AND SHOW IN A SEC */
         $('#SuccAdded').delay(2000).fadeOut('slow');

      });
  </script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>