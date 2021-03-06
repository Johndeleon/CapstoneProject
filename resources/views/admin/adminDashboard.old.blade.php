@extends('layouts.app1')

@section('styles')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="{{ asset('css/myDesign.css') }}">
@endsection

@section('content')
<!-- .container>.row>.col-md-offset-3.col-md-6 -->

<div class="container-fluid">
	<div class="row">

		<div class="col-md-9">
			<div class="row">
				@if(count($programs))
				<!-- SHOW PROGRAMS -->

				@foreach($programs as $program)
					<div class="col-md-4 mb-4">
						<div class="card card-body card-size text-center">

							<div class="cat-cover">
								<div class="row col-md-11 mx-auto" style="margin-top: 27%">
									@for($i=1; $i <= $program->levels; $i++)
										<a class="mb-2 btn btn-primary cat-btn-s mx-auto" href="{{ $program->title }}{{ $i }}" {{ $hasSchedule[$program->id][$i] }}>
											{{ $i }}
										</a>
									@endfor
								</div>
							</div>

							<h2 class="cat-h2">{{ $program->title }}</h2>
						</div>
					</div>

				{{-- <div class="col-md-4 mb-2">
					<div class="card text-align">
						<div class="card-body">
							<h2>{{$program->title}}</h2>
						</div>

						<div class="card-footer">
							<div class="row ml-3 mr-3">
							@for($i=1;$i<=$program->levels;$i++)
								<div class="col-md-3">
									<a href="{{$program->title}}{{$i}}"><button class="btn btn-primary" {{$hasSchedule[$program->id][$i]}}>{{$i}}</button>
								</div>
							@endfor
							</div>
						</div>
					</div>
				</div> --}}
				@endforeach


				@else
					<!-- SHOW ENCOURAGING TEXT -->
					<h2 class="flex-center full-height">What PROGRAMS your education offers.</h2>
				@endif
			</div>
		</div>

		<!-- SELECT, STORE, DELETE ACADEMIC YEAR FOR USER CURRENT DATE -->
		<div id="academic-wrapper" class="col-md-3 ml-auto">
			<div class="card">
					<!-- xx -->
			    <div id="academic-name" class="card-header">Academic Year
			    	<a class="float-right" href="" data-toggle="modal" data-target="#addAcademicYear"><i class="fa fa-plus" aria-hidden="true"></i></a>
			    </div>

			    <div class="card-body">
			        <div class="panel-body">
			          <ul id="ulAdd" class="list-group">
			          	@if (count($academicYears))
			          		@foreach($academicYears as $acadYr)
					          		<!-- xx add hover delete btn -->
					      				<li class="list-group-item acadYr-items">
						      				 {{ $acadYr->academic_year }}
													 <a id="deleteItem" href="#" class="pull-right">
													 <i class="fa fa-trash" aria-hidden="true"></i>
						      				 <input type="hidden" value="{{ $acadYr->id }}"></a>
					      				</li>
			            	@endforeach
			          	@else
			          		<li class="list-group-item">No academic year detected</li>
			          	@endif
			          </ul>
			        </div>
			    </div>
			</div>
			{{ csrf_field() }}

      <!-- xx ADD ACADEMICYEAR modal -->
			<div class="modal fade show" id="addAcademicYear" tabindex="-1" role="dialog" aria-labelledby="">
			    <div class="modal-dialog" role="document">
			      <div class="modal-content">

			          <div class="modal-header">
			              <h6 class="modal-title">
			                Academic Year
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

@endsection

@section('scripts')

<!-- Script Tag -->
<script type="text/javascript">
	$(document).ready(function() {
		/* MERGING THE GIVEN DATE */
		var merge;

		$('#addAcadYr').click(function() {
			// merge = $('#inputAcadYr').val() + ' - ' + $('#date-autofill').val();
			var text = merge

			$.post('/academic-year', {'academicYear': text, '_token':$('input[name=_token]').val() }, function(data, status) {
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

			$.post('/delete', {
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

@endsection