@extends('layouts.app1')

@section('title') CSS | Dashboard @endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/class/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/class/customization.class.css') }}">
@endsection

@section('scriptstop') 
<script src="{{ asset('js/class/dashboard.class.js') }}"></script>
@endsection

{{-- Main Content --}}
@section('content')

<div class="container-fluid">
	<div class="row">

		{{-- Labels --}}
		<div class="col-md-9">
			<div class="row">

				<div class="col-md-12">
					<h3>Lists of Schedules Available</h3>
					<hr>
				</div>
				
				@if (count($programs))
					@foreach ($programs as $item)
						<div class="col-md-4 mb-4"> 

							<div class="card-label">
                                <span id="{{ $item->id }}" class="program-title">{{ $item->title }}</span>
                                <div id="schedules-level" class="row currSched">
                                    
                                </div>                    
                            </div>
									
						</div>

					@endforeach
					
				@else
                    
                    <div class="ct-placeholder">
                        <h4 class="empty-message">
                            What are the "Courses" your education offers?
                        </h4>
                    </div>

				@endif

				{{-- <div class="col-md-4"> 

					<nav>
					  <ul>
					    <li>BS Information System
					      <ul class="drop-menu menu-#{i}">
					        <a href="#viewSchedule" data-toggle="modal" data-backdrop="static" data-keyboard="false"> <li class="rounded-0"> BSIS 1 </li> </a>
					        <li> BSIS 2 </li>
					        <li> BSIS 3 </li>
					        <li> BSIS 4 </li>
					      </ul>
					    </li>
					  </ul>
					</nav>
							
				</div> --}}





			</div>
		</div>

		{{-- ADD ACADEMIC YEAR SECTION --}}
		<div class="col-md-3 ay-section">

            <div class="card ct-card">
                <div class="card-header ct-header py-reduced-1">
                    <small>
                        <i class="fa fa-cog" aria-hidden="true"></i>
                         Academic Filters
                    </small>

                    <a href="#addAcadYr" id="a_btn" class="btn btn-secondary btn-circle text-dark pull-right" style="background: #dfe6e9" data-toggle="modal">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="card-body">
                    <h6>Academic Year: <span id="sc_ay" class="text-bold">
                        @if (count($ay))
                            {{ $ay }}

                        @else
                            {{ " " }}

                        @endif
                    </span></h6>
                    <hr>

                    <form id="changeAY">
                        @csrf

                        <div class="form-group">
                            <small class="ct-small-font">Academic Year</small>

                            <select id="ay" class="select2 form-control sel-ay-enBtn" name="academic_year">
                                @if (count($academicYears))
                                    <option readonly value="not null"> Select an option </option>
                                    @foreach ($academicYears as $item)
                                        
                                        @if ($item->status == 1)
                                            <option value="{{ $item->id }}" selected> {{ $item->academic_year }} </option>

                                        @else 
                                            <option value="{{ $item->id }}"> {{ $item->academic_year }} </option>

                                        @endif

                                    @endforeach

                                @else
                                    <option value="0" disabled selected> No academic year found in your database. </option>

                                @endif

                            </select>
                        </div>

                        <div class="form-group">
                            <small class="ct-small-font">Semester</small>

                            <select id="sem" class="form-control sel-ay-enBtn" name="semester">
                                <option value="1"> 1st Semester </option>
                                <option value="2"> 2nd Semester</option>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="f_data" class="btn btn-danger" disabled>
                               <i class="fa fa-filter" aria-hidden="true"></i> Change Academic Year
                            </button>
                        </div>
                    </form>
                    
                </div>
            
            </div>

        </div>

	</div>
</div>


{{-- Add Academic Year Modal --}}
<div id="addAcadYr" class="modal show fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm-1 ct-modal-def" role="document">
    <div class="modal-content">

        <div class="modal-header ct-modal-head py-reduced">
            <small class="ct-small-font text-light" style="font-size: 1rem; font-weight: lighter;">
                <i class="fa fa-plus" aria-hidden="true"></i>
                 Add Academic Year
            </small>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="container">
                <h6> Type your current/future academic year </h6>
                <hr>

                <div class="alert alert-danger" hidden>
                    
                </div>

                <form id="storeAcadYear">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6 mx-auto">
                            <small class="ct-small-font">Year starts</small>
                            <input type="text" id="year-start" maxlength="4" class="form-control a_empty" name="year_start">
                        </div>


                        <div class="col-md-6 mx-auto">
                            <small class="ct-small-font">Year ends</small>
                            <input type="text" id="year-end" maxlength="4" class="form-control a_empty" name="year_end" readonly="readonly">
                        </div>
                    </div>

                    <button type="submit" id="a_acadYear" class="btn-danger btn pull-right" title="Click to add your inputted academic year">
                        <i class="fa fa-save" aria-hidden="true"></i>
                         Store Academic Year   
                    </button>
                </form>
            </div>

        </div>
      
    </div>
  </div>
</div>


{{-- Show Modal --}}
<div id="viewSchedule" class="modal show fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl ct-modal-def" role="document">
    <div class="modal-content">

      <div class="modal-header ct-modal-head py-reduced">
        <h6 id="sc_prog_title" class="modal-title text-bold"></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        
        <div class="row px-2">
        	<div class="card col-md-2 rounded-0">
        		<div class="row mb-2">
        		    <div class="card-header col-md-12 text-center rounded-0">
        		        Monday
        		    </div>
        		</div>

        		<div id="monday-1" class="row emptimize">
        			
        		</div>

        	</div>

        	<div class="card col-md-2 rounded-0">
        		<div class="row mb-2">
        		    <div class="card-header col-md-12 text-center rounded-0">
        		        Tuesday
        		    </div>
        		</div>

        		<div id="tuesday-2" class="row emptimize">
        			
        		</div>

        	</div>

        	<div class="card col-md-2 rounded-0">
        		<div class="row mb-2">
        		    <div class="card-header col-md-12 text-center rounded-0">
        		        Wednesday
        		    </div>
        		</div>

        		<div id="wednesday-3" class="row emptimize">
        			
        		</div>

        	</div>

        	<div class="card col-md-2 rounded-0">
        		<div class="row mb-2">
        		    <div class="card-header col-md-12 text-center rounded-0">
        		        Thursday
        		    </div>
        		</div>

        		<div id="thursday-4" class="row emptimize">
        			
        		</div>

        	</div>

        	<div class="card col-md-2 rounded-0">
        		<div class="row mb-2">
        		    <div class="card-header col-md-12 text-center rounded-0">
        		        Friday
        		    </div>
        		</div>

        		<div id="friday-5" class="row emptimize">
        			
        		</div>

        	</div>

        	<div class="card col-md-2 rounded-0">
        		<div class="row mb-2">
        		    <div class="card-header col-md-12 text-center rounded-0">
        		        Saturday
        		    </div>
        		</div>

        		<div id="saturday-6" class="row emptimize">
        			
        		</div>

        	</div>

        </div>

      </div>
      
    </div>
  </div>
</div>
@endsection


{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">
	
	$(function() {
		dashboardMaintenance.init();
	});

</script>
@endsection