<?php $__env->startSection('head'); ?>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/myDesign.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<!-- .container>.row>.col-md-offset-3.col-md-6 -->

<div class="container-fluid">
	<div class="row">

		<div class="col-md-9">
			<div class="row">
				<?php if(count($programs)): ?>
				<!-- SHOW PROGRAMS -->
				<div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h1>BSIS</h1>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
								<div class="col-md-3">
									<button class="btn btn-primary">1</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">2</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">3</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">4</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h1>ABB</h1>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
								<div class="col-md-3">
									<button class="btn btn-primary">1</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">2</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">3</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">4</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h1>BSAT</h1>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
								<div class="col-md-3">
									<button class="btn btn-primary">1</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">2</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">3</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">4</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h1>ACT</h1>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
								<div class="col-md-3">
									<button class="btn btn-primary">1</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">2</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">3</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">4</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h1>IC</h1>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
								<div class="col-md-3">
									<button class="btn btn-primary">1</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">2</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">3</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">4</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h1>BSA</h1>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
								<div class="col-md-3">
									<button class="btn btn-primary">1</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">2</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">3</button>
								</div>

								<div class="col-md-3">
									<button class="btn btn-primary">4</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				
				<?php else: ?>
					<!-- SHOW ENCOURAGING TEXT -->
					<h2 class="flex-center full-height">What PROGRAMS your education offers.</h2>
				<?php endif; ?>
			</div>
		</div>
			
		<!-- SELECT, STORE, DELETE ACADEMIC YEAR FOR USER CURRENT DATE -->
		<div id="academic-wrapper" class="col-md-3 ml-auto">
			<div class="card">
				<!-- xx -->
                <div id="academic-name" class="card-header">Academic Year 2018-2019 
                	<a class="float-right" href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></a>
                </div>

                <div class="card-body">
                    <div class="panel-body">
                      <ul id="ulAdd" class="list-group">
                      	<?php if(count($academicYears)): ?>
                      		<?php $__currentLoopData = $academicYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acadYr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      			<!-- xx add hover delete btn -->
                  				<li class="list-group-item acadYr-items">
                  				 <?php echo e($acadYr->academic_year); ?> <a id="deleteItem" href="#" class="pull-right"><i class="fa fa-trash" aria-hidden="true"></i>
                  				 <input type="hidden" value="<?php echo e($acadYr->id); ?>"></a>
                  				</li>
	                      	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                    <?php else: ?>
	                    	<li class="list-group-item">No items detected</li>
                      	<?php endif; ?>
                      </ul>
                    </div>
                </div>
            </div>
            <?php echo e(csrf_field()); ?>


            <!-- xx modal -->
			<div class="modal fade show" id="myModal" tabindex="-1" role="dialog" aria-labelledby="">
			    <div class="modal-dialog" role="document">
			      <div class="modal-content">

			          <div class="modal-header">
			              <h6 class="modal-title">
			                Academic Year 2018-2019
			              </h6>
			              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                  <span aria-hidden="true">×</span>
			              </button>
			          </div>

			          <div class="modal-body">
			          	<div class="form-group">
			              <!-- <span>Academic Year</span> -->
			              <div class="form-group">
			              	<div class="row">
			              		<input id="inputAcadYr" type="number" placeholder="Academic Year" name="acadYr" class="form-control col-md-4 ml-3">
			              		<span class="ml-1 mr-1"> - </span>
			              		<input type="text" class="form-control col-md-4" id="date-autofill" disabled>
			              	</div>
			              </div>
			          	</div>
			          </div>

			          <div class="modal-footer">
			              <button id="addAcadYr" type="submit" class="btn btn-outline-dark" data-dismiss="modal">Save</button>
			          </div>

			      </div>
			    </div>
			</div>
		</div>

	</div>
</div>

<!-- Script Tag -->
<script type="text/javascript">
	$(document).ready(function() {
		var merge;

		$('#addAcadYr').click(function() {
			var text = merge;

			$.post('academic-year', {'academicYear': text, '_token':$('input[name=_token]').val() }, function(data) {
				$('#ulAdd').load(location.href + ' #ulAdd');
			});

			$('#inputAcadYr , #date-autofill').val('');
		});

		function AcademicMerge(useInp, autfil) {
			var input = useInp;
			var auto = autfil;

			console.log(input + ' - ' + auto);
		}

		$(document).on('click', '.acadYr-items', function(e) {
			var currYr = $(this).text();
			var atag = $('div#academic-name').find('a');

			$('div#academic-name').text('Academic Year '+ currYr);
			$('div#academic-name').append(atag);
		});

		$(document).on('click', '#deleteItem', function() {
			var delId = $(this).find('input').val();

			$.post('delete', {
				'id': delId, '_token':$('input[name=_token]').val()
			}, function(data) {
				$('#ulAdd').load(location.href + ' #ulAdd');
			});
		});

		$('#inputAcadYr').keyup(function() {
			var input = $(this).val();
			var increments = 1;
			var add;

			if(input != "") {
				add = parseInt(input) + parseInt(increments);
			}

			$('#date-autofill').val(add);
			merge = input + ' - ' + add;
		});

	});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>