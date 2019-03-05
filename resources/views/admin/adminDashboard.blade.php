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

<div class="row">

    <div class="col-md-10">
        
        @if (count($programs))
            <div class="mb-2">
                <span class="admin-title-desc">
                    Lists of Created Schedules
                </span>
            </div>

            {{-- for action buttons --}}
            <div class="row" style="border-bottom: 1px solid #d0dae6; border-top: 2px solid #d0dae6">
                <div class="col-md-2">

                    {{-- Btn for multiple delete --}}
                    <div class="mt-2 del-all" style="margin-left: 2px;">
                        <input type="checkbox" id="mult-delete" class="check-pointer mb-0" name="mult-delete">
                        <label for="mult-delete" class="check-pointer">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </label>
                    </div>

                </div>

                <div class="col-md-10">

                    <div class="form-group sin-del mt-2 text-dark mb-0">
                        <i class="fa fa-trash mr-1 text-danger multiple-del" aria-hidden="true"></i>
                        <span class="font-del pointer text-danger multiple-del">Delete</span>
                    </div>
                    
                </div>
            </div>
        
        @else

        @endif

        {{-- for available schedule table --}}
        <div class="row" style="max-height: 75vh;">
            
            @if (count($programs))
                <div class="table-responsive">
                    <table class="table table-hover pointer">

                        <tbody class="admin-tbody">
                            
                            @foreach ($programs as $item)
                                <tr>
                                    <td width="5%">
                                        <div class="text-center">
                                            <input type="checkbox" id="{{ $item->id }}" class="cat-checkbox mb-0 checkbox" name="delete">
                                        </div>
                                    </td>
                                    <td id="course-{{ $item->id }}" class="viewLevels" data-target="#viewSchedule" data-toggle="modal" title="Course Title">
                                        <b id="course-1">{{ $item->title }}</b>
                                    </td>
                                    <td width="15%" style="color: #bb777d;" title="Date Created"> {{ $item->created_at }} </td>
                                    <td width="5%">
                                        <div class="text-center text-danger" style="font-size: 1rem">
                                            <i id="del-{{ $item->id }}" class="fa fa-trash delete-me" aria-hidden="true" title="Delete"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>

            @else
                <div class="ct-placeholder">
                    <h4 class="empty-message">
                        What are the "Courses" your education offers?
                    </h4>
                </div>

            @endif

        </div>


    </div>

    <div class="col-md-2 ay-section">
        <div class="row py-2 mb-2" style="background: #222d32;">
            {{-- Dark background buttons --}}
            <div class="btn-wrapper ml-auto">
                <a href="#filterTeacher" id="" class="btn btn-secondary btn-circle text-dark mr-1" style="background: #dfe6e9" data-toggle="modal" title="Teacher Filter">
                    <i class="fa fa-user" aria-hidden="true"></i>
                </a>

                <a href="#addAcadYr" id="a_btn" class="btn btn-secondary btn-circle text-dark mr-2" style="background: #dfe6e9" data-toggle="modal">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        
        <div class="row">
            <div class="container">
                <span class="font-right-sidebar">Academic Filters &nbsp<i class="fa fa-filter" aria-hidden="true"></i></span>
                <hr>

                {{-- Current Academic Year info --}}
                <div class="text-center">
                    @if(count($ay))

                        <span class="font-right-sidebar" style="font-weight: lighter">Academic Year: 
                            <br>
                            <span id="sc_ay" class="text-bold">
                                @if (count($ay))
                                    {{ $ay }}

                                @else
                                    {{ " " }}

                                @endif
                            </span>
                        </span>

                    @else

                        <span class="font-right-sidebar" style="font-weight: lighter">Add the current year today!
                            <br>
                            <span id="sc_ay" class="text-bold">
                                @if (count($ay))
                                    {{ $ay }}

                                @else
                                    {{ " " }}

                                @endif
                            </span>
                        </span>

                    @endif
                </div>

                <hr>

                <form id="changeAY">
                    @csrf
                    <div class="form-group mb-2">
                        {{-- <small class="ct-small-font">Academic Year</small> --}}
                        <span class="font-right-sidebar" style="font-weight: lighter">Academic Year</span>

                        <select id="ay" class="select2 form-control1 sel-ay-enBtn" name="academic_year">
                            @if (count($academicYears))
                                <option readonly value="not null" disabled> Select an option </option>
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

                    <div class="form-group mb-3">
                        {{-- <small class="ct-small-font">Semester</small> --}}
                        <span class="font-right-sidebar" style="font-weight: lighter;">Semester</span>

                        <select id="sem" class="form-control1" name="semester">
                            <option value="1"> 1st Semester </option>
                            <option value="2"> 2nd Semester</option>
                        </select>
                    </div>

                    {{-- Filter Button --}}
                    <div class="text-center">
                        <button type="submit" id="f_data" class="btn btn-danger form-control" title="Change some settings to enable this button." disabled>
                           Save Changes
                        </button>
                    </div>
                </form>

            </div>
        </div> {{-- row --}}
    </div>

	{{-- <div class="col-md-10">
		<div class="row">

            <span class="admin-title-desc">
                Lists of Created Schedules
            </span>

            <div class="col-md-12 pink">
                <div class="row">
                    
                    <div class="col-md-2"></div>

                    <div class="col-md-10"></div>

                </div>
            </div>

		</div>
	</div> --}}

	

</div>

{{-- Teacher's View Filter xxteacher --}}
<div id="filterTeacher" class="modal show fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl ct-modal-def" role="document">
    <div class="modal-content">

        <div class="modal-header ct-modal-head py-reduced">
            <div class="" style="height: 100%; line-height: 25px;">
                <i class="fa fa-user"></i> &nbsp 
                <small>
                    Teacher's Schedules
                </small>
            </div>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            
        </div>
      
    </div>
  </div>
</div>


{{-- View Schedules v_1 --}}
<div id="viewSchedule" class="modal show fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl ct-modal-def" role="document">
    <div class="modal-content">

        <div class="modal-header ct-modal-head py-reduced">
            <div class="" style="height: 100%; line-height: 25px;">
                <i class="fa fa-circle-o"></i> &nbsp 
                <small>
                     Course Levels
                </small>
            </div>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body pt-0 pb-0">
            <div class="row">

                <div class="col-md-1 card rounded-0 nav-levels">
                    
                    <div class="lev-wrapper">
                        <div id="item-container" class="row">
                            {{-- <button class="btn btn-primary form-control rounded-0 py-2 mb-2">
                                1
                            </button> --}}
                        </div>
                    </div>
                    
                </div>

                {{-- View section of chosen course level --}}
                <div id="schedule-wrapper" class="col-md-11 bg-light">

                    

                </div>
                
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