@extends('layouts.app1')

@section('title')
  CSS | Room Maintenance
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">
@endsection

@section('scriptstop')
<script src="{{ asset('js/class/rooms.class.js') }}"></script>
@endsection
  
@section('content')

  <div class="container-fluid">
  	<div class="row mb-3">

		{{-- Adding Section --}}
		<div class="col-md-5">
			<div class="card ct-card">

				<div class="card-header ct-header py-reduced-1">
					<small>
						<i class="fa fa-cog" aria-hidden="true"></i> Rooms Settings
					</small>
				</div>

				<div class="card-body">
					<h5>Add Available Rooms</h5>
					<hr>

					<div class="alert alert-danger" hidden="true">
						
					</div>

					{{-- INFORMATION SECTION --}}
					<div id="info" class="card mb-3">

						<div class="card-header py-reduced ">
							<span class="text-danger">
								<i class="fa fa-lightbulb-o" aria-hidden="true"></i> Information
							</span>

							<button type="button" id="close-1" class="close" title="Remove information section" aria-label="Close">
							  <span aria-hidden="true">×</span>
							</button>
						</div>

						<div class="card-body">
							<small class="info-small">
								<p>
									• &nbsp Add all the rooms that can be used by the college students.
								</p>
							</small>

							<small class="info-small">
								<p>
									• &nbsp By indicating the start time of room, the system can recognize the hard conflicts and can give an accurate results.
								</p>
							</small>

							<small class="info-small">
								<p>
									• &nbsp The time format must be on military time.
								</p>
							</small>
						</div>

					</div>

					{{-- FORM SECTION --}}
					<form id="addRoom">
						@csrf

						<div class="form-group">
							<small class="ct-small-font">Room name</small>
							<input type="text" name="room_name" class="form-control tobe-reset req">
						</div>

						<div class="form-group">
							<small class="ct-small-font">Room type</small>
							
							<select class="select2 form-control tobe-reset" name="room_type">
								<option selected="selected" disabled="true"> Select the type of the room </option>
								<option value="1">Normal Room</option>
								<option value="2">Laboratory Room</option>
							</select>

						</div>

						<div class="row">
							
							<div class="form-group col-md-6">
								<small class="ct-small-font">Start time</small>
								<input type="text" name="start_time" class="form-control tobe-reset req" maxlength="4" placeholder="Available time">
							</div>

							<div class="form-group col-md-6">
								<small class="ct-small-font">End time</small>
								<input type="text" name="end_time" class="form-control tobe-reset req" maxlength="4" placeholder="End of availability">
							</div>

						</div>

						<button class="btn btn-default btn-circle btn-md reset bg-gray" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>

						<button type="submit" id="a_btn" class="btn btn-danger pull-right" disabled="true">Store this room &nbsp<i class="fa fa-arrow-right" aria-hidden="true"></i> </button>

					</form>


				</div>
				
			</div>
		</div>

		{{-- ROOMS TABLE --}}
  		<div class="col-md-7">
  			
  			<div class="card ct-card">
  				
  				<div class="card-header ct-header py-reduced-1">
  					<small>
  						<i class="fa fa-table" aria-hidden="true"></i> Lists of available rooms
  					</small>
  				</div>

  				<div class="card-body">
  					
					<div class="table-responsive">
						<table id="dt-rooms-table" class="table table-hover table-bordered">
							
							<thead>
								<tr>
									<th>Room Name</th>
									<th width="15%">Start Time</th>
									<th width="15%">End Time</th>
								</tr>
							</thead>

							<tbody>
								
							</tbody>

						</table>
					</div>

  				</div>

  			</div>

  		</div>

  	</div>
	  <div class="row">
{{-- IMPORT PROGRAMS FROM EXCEL --}}
    <div class="col-md-5">
            <div class="card ct-card">
                <div class="card-header ct-header py-reduced-1">
              <small>
                <i class="fa fa-cog" aria-hidden="true"></i> Import From Excel
              </small>
              {{-- <i class="fa fa-cog" aria-hidden="true"></i>
              Import from Excel --}}
            </div>

            <div class="card-body">
              <h5>Select Excel File</h5>
              <hr>
              
              <form method="POST" action="/admin/rooms/import-rooms" name="import-rooms" enctype="multipart/form-data">
                @csrf
                {{-- SELECT EXCEL FILE --}}
                  <div class="form-group">
                    <small class="ct-small-font"> From </small>
                    <input type="file" class="form-control tobe-reset required" name="excelFile" placeholder="Excel File">
                  </div>
                  <button type="submit" id="importRoom" class="btn btn-danger pull-right">
                    Import this to Database 
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </button>
              </form>
              
            </div>

            </div>
    </div>
</div>
  </div>

	{{-- Update Room Data --}}
	<div class="show fade modal" id="editData" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm-3 ct-modal-def" role="document">
	    <div class="modal-content">

	      <div class="modal-header ct-modal-head py-reduced">
	         <small class="info-small text-light">
	         	<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
	         	Updating Room Data
	         </small>

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">
	      	<form id="updateRoomData">
		        @csrf

		        <div class="form-group">
		        	<small class="ct-small-font">
		        		Room name
		        	</small>
		        	<input type="text" id="sc_room_name" class="form-control if-change" name="room_name">
		        </div>

		        <div class="form-group">
		        	<small class="ct-small-font">
		        		Room type
		        	</small>
		        	
		        	<select id="sc_room_type" class="form-control if-change" name="room_type">
		        		<option value="1">Normal Room</option>
		        		<option value="2">Laboratory Room</option>
		        	</select>
		        </div>

		        <div class="row">
		        	
		        	<div class="form-group col-md-6">
		        		<small class="ct-small-font">
		        			Start time
		        		</small>
		        		<input type="text" id="sc_start_time" maxlength="4" class="form-control if-change" placeholder="time_start" name="start_time">
		        	</div>

		        	<div class="form-group col-md-6">
		        		<small class="ct-small-font">
		        			Finish time
		        		</small>
		        		<input type="text" id="sc_finish_time" maxlength="4" class="form-control if-change" placeholder="time_finish" name="finish_time">
		        	</div>

		        </div>

				<input type="hidden" name="idtype" id="idtype">
		        <button type="submit" id="roomBtn" class="btn btn-primary pull-right" disabled="true" title="Change something in any fields will enabled this button">
		        	<i class="fa fa-save" aria-hidden="true"></i> Update your data
		        </button>
		    </form>
		  </div>

	    </div>
	  </div>
	</div>

@endsection

{{-- SCRIPTS HERE --}}
@section('scripts')
<script type="text/javascript">
	
	$(function() {
	    roomMaintenance.init();
	    allMaintenance.dataTableBtn();
	});

</script>
@endsection