@extends('layouts.app1')

@section('title') CSS | Dashboard @endsection

@section('alertNotif')
<!-- Notification Section-->
<div class="ct-notif-sec">
    <a href="#" id="notif-alert" class="position-relative" role="button">
    <i class="fa fa-exclamation ct-notif-item" style="color: red" aria-hidden="true"></i>
    
    <!-- Badge -->
    <span id="notif-alert-count" class="badge badge-secondary ct-badge"></span>
    </a>

    <!-- <a href="#" class="position-relative" role="button">
    <i class="fa fa-envelope ct-notif-item" aria-hidden="true"></i> -->

    <!-- Badge -->
    <!-- <span class="badge badge-secondary ct-badge1" hidden></span>
    </a> -->
</div>

<!-- Notification Active Panel -->
<div class="ct-notif-panel card-1">

    <div class="no-sched-label mb-3"> Alert: No schedule detected </div>
    
</div>
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/class/dashboard.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/class/customization.class.css') }}">

<style type="text/css">
    .ct-teacher-filter {
      font-size: 14px;
      font-weight: bold;
    }

    .ct-input-filter {
      padding: 5px 4px;
      width: 53%;
    }

    /* Tables */
    .ct-table-filt {
      border: 2px solid #357da8 !important;
    }

    .ct-table-filt > thead {
      background: #357da8;
      color: #eee;
    }

    .ct-table-filt > thead > tr > th {
      border-bottom: 1px solid #357da8 !important;
    }


    .ct-table-filt > tbody {
      background: #e7e7e7;
    }

    .ct-table-filt > tbody > tr > td {
      margin: 0;
      padding: 0;
    }
</style>
@endsection

@section('scriptstop') 
<script src="{{ asset('js/class/dashboard.class.js') }}"></script>
@endsection

@section('sidebar')
    sidebar-collapse
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
                    <div class="mt-2 del-all" style="margin-left: 6px;">
                        <input type="checkbox" id="mult-delete" class="check-pointer mb-0" name="mult-delete">
                        <label for="mult-delete" class="check-pointer">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </label>
                    </div>

                </div>

                <div class="col-md-10">

                    <div class="form-group sin-del mt-2 text-dark mb-0">
                        <span class="font-del pointer multiple-del" style="color: #b5aeb1"><i class="fa fa-trash mr-1" style="color: #b5aeb1" aria-hidden="true"></i> Delete</span>
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
                                    <td id="course-{{ $item->id }}" class="viewLevels" data-target="#viewSchedule" data-toggle="modal" title="Program Title">
                                        <b id="course-1">{{ $item->title }}</b>
                                    </td>
                                    <td width="15%" style="color: #bb777d;" title="Date Created"> {{ $item->created_at }} </td>
                                    <td width="5%">
                                        <div class="text-center text-danger" style="font-size: 1rem;">
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
        <div class="row py-2 mb-2" style="background: #182125;">
            {{-- Dark background buttons --}}
            <div class="btn-wrapper ml-auto">
                <a href="#filterTeacher" id="viewTeacher" class="btn btn-secondary btn-circle text-dark mr-1" style="background: #dfe6e9" data-toggle="modal" title="Schedule Filter">
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
                    teacher's schedule viewer
                </small>
            </div>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="card card-body mb-3">
                
                <form id="teacher-filters">
                    <div class="row mb-3">
                    
                        @csrf
                        <div class="col-md-3 ct-teacher-filter mb-4">
                            <label class="pt-1 mr-1">Academic Year: </label>
                            <select class="ct-input-filter select3" name="ay" style="width: 90%">

                                @if(count($academicYears))
                                    @foreach ($academicYears as $item)
                                        <option value="{{ $item->id }}"> {{ $item->academic_year }} </option>
                                    @endforeach

                                @else
                                    
                                @endif
                                
                            </select>
                        </div>

                        <div class="col-md-3 ct-teacher-filter">
                            <label class="pt-1 mr-1">Semester: </label>
                            <select class="ct-input-filter select3" name="sem" style="width: 90%">
                                <option value="1"> 1st Semester</option>
                                <option value="2"> 2nd Semester</option>
                            </select>
                        </div>

                        <div class="col-md-3 ct-teacher-filter">
                            <label class="pt-1 mr-1">Program: </label>
                            <select id="filt-prog" class="ct-input-filter select3" name="prog" style="width: 90%">
                                @if (count($programs))
                                    <option value="">Empty</option>
                                    
                                    @foreach($programs as $item)
                                        <option value="{{ $item->id }}"> {{ $item->title }} </option>
                                    @endforeach

                                @else

                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 ct-teacher-filter">
                            <label class="pt-1 mr-1">Year Level: </label>
                            <select id="filt-lev" class="ct-input-filter select3" name="year_level" style="width: 90%" disabled>
                                <option class="filt-yl-val def" value="">Empty</option>
                                <option class="filt-yl-val" value="1">1st Year</option>
                                <option class="filt-yl-val" value="2">2nd Year</option>
                                <option class="filt-yl-val" value="3">3rd Year</option>
                                <option class="filt-yl-val" value="4">4th Year</option>
                                <option class="filt-yl-val" value="5">5th Year</option>
                            </select>
                        </div>

                        <div class="col-md-3 ct-teacher-filter">
                            <label class="pt-1 mr-1">Instructor: </label>
                            <select class="ct-input-filter select3" name="teacher" style="width: 90%">
                                @if (count($teachers))
                                    <option value="">Empty</option>
                                    
                                    @foreach($teachers as $item)
                                        <option value="{{ $item->first_name }} {{ $item->last_name }}"> {{ $item->first_name }} {{ $item->last_name }} </option>
                                    @endforeach

                                @else

                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 ct-teacher-filter">
                            <label class="pt-1 mr-1">Rooms: </label>
                            <select class="ct-input-filter select3" name="rooms" style="width: 90%">
                                @if (count($rooms))
                                    <option value="">Empty</option>
                                    
                                    @foreach($rooms as $item)
                                        <option value="{{ $item->room_name }}"> {{ $item->room_name }} </option>
                                    @endforeach

                                @else

                                @endif
                            </select>
                        </div>
                    </div>
                </form>

                <div class="col-md-12">
                    <button id="filter-now" class="btn btn-sm btn-primary pull-right" title="Click to the selected teacher schedules.">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filter Data
                    </button>
                </div>

            </div> {{-- End of Card --}}
            
            <div id="teacherSchedule">

            </div>

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
            <div class="" style="height: 100%; line-height: 25px;">
                <small>
                    <i class="fa fa-plus" aria-hidden="true"></i> &nbsp
                    Add Academic Year
                </small>
            </div>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="container">
                <div class="alert alert-danger" hidden>
                    
                </div>

                <form id="storeAcadYear">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6 mx-auto">
                            <small class="ct-small-font">Year starts</small>
                            <input type="text" id="year-start" maxlength="4" class="form-control a_empty" name="year_start" title="Insert the current academic year">
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

@endsection


{{-- Scripts --}}
@section('scripts')
<script type="text/javascript">

    // $(function() {
    //     $(document).ready(function(){
    //         dashboardMaintenance.init();
    //     });
    // });
     
    $(function() {
        $(document).ready(function(){
            setTimeout(dashboardMaintenance.init, 1000);
        });
    });

</script>
@endsection