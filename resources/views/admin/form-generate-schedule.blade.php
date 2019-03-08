@extends('layouts.app1')

@section('title') CSS | Form Generate Schedule @endsection

@section('styles') <link rel="stylesheet" href="{{ asset('css/GSDesign.css') }}"> @endsection

@section('scriptstop') <script src="{{ asset('js/class/form-generate-schedule.class.js') }}"></script> @endsection

{{-- Main Content --}}
@section('content')
<style>
  .py-reduced {
      padding-top: 0.5rem !important;
      padding-bottom: 0.5rem !important;
  }

  .card-1 {
      box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
      transition: all 0.3s cubic-bezier(.25,.8,.25,1);
  }
  .card-1:hover {
      box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
  }

  @media (min-width: 768px) {
  .modal-xl {
      width: 75%;
      max-width:1200px;
      }
  }

  .select3 {
      border-radius: 3px;
      border-color: #d7dce1;
      padding: 6px;
      background: #f1f3f5;
  }

  .form-control1 {
    background-color:#FFFFFF;
    background-image:none;
    border:1px solid #CCCCCC;
    border-radius:4px;
    box-shadow:rgba(0, 0, 0, 0.0745098) 0 1px 1px inset;
    color:#555555;
    display:block;
    font-size:14px;
    height:34px;
    line-height:1.42857;
    padding:6px 12px;
    transition:border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    width:100%;
  }
</style>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-12">
      <a href="/admin/dashboard" class="pull-right btn btn-primary btn-circle btn-md mb-4" style="line-height: 37px; font-size: 1rem" title="Back">
        <i class="fa fa-arrow-left"></i>
        {{-- <button class="btn btn-sm btn-info mb-4 float-right" type="button" name="button">Back</button> --}}
      </a>

      <a href="/admin/generate-form-schedules">
        <button class="btn btn-secondary mr-2 btn-circle btn-md float-right bg-gray" type="button" name="button" title="Reset Form">
          <i class="fa fa-refresh" aria-hidden="true"></i>
        </button>
      </a>
    </div>

    {{-- xx 1 --}}
    <div class="col-md-5">

      <div class="card ct-card">
        
        <div class="card-header ct-header py-reduced-1">
          <small class="info-small text-light">
            <i class="fa fa-cog" style="font-size: 1rem" aria-hidden="true"></i>
            Schedule Settings
          </small>
        </div>

        <div class="card-body">

          <div class="alert alert-danger" hidden>
            
          </div>
          
          <form id="generateScheduleForm">
            @csrf

            <div class="row">
              
              <div class="form-group col-md-6">
                <small class="ct-small-font">Academic Year</small>

                <select id="ay" class="form-control1 academic_year" name="academic_year">
                  @if (count($academicYears))
                    <option selected disabled>Select academic year</option>

                    @foreach($academicYears as $item)
                      <option value="{{ $item->id }}">{{ $item->academic_year }}</option>
                    @endforeach
                    
                  @else
                    <option selected disabled>You need to add academic year first</option>
                  @endif

                </select>
              </div>

              <div class="form-group col-md-6">
                <small class="ct-small-font">Semester</small>

                <select id="sem" class="form-control1 semester" name="semester">
                  <option disabled selected>Select semester</option>
                  <option value="1"> 1st Semester </option>
                  <option value="2"> 2nd Semester </option>
                </select>
              </div>

            </div>

              
            <div class="form-group">
              <small class="ct-small-font">Course</small>

              <select id="prog" class="form-control1 program" name="program">
                
                @if (count($programs))
                  <option disabled selected>Select course</option>

                  @foreach($programs as $item)
                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                  @endforeach

                @else
                  <option disabled selected>Add some programs in your Program Module</option>
                @endif

              </select>
            </div>

            <div class="row clearfix">
              <div class="form-group col-md-6">
                <small class="ct-small-font">Level</small>

                <select id="lev" class="form-control1 level" name="level">
                  <option disabled selected>Select your program first</option>
                </select>
              </div>
            </div>

            <button type="submit" id="a_form" class="btn btn-danger pull-right" title="Click here to generate a form for your Courses">
              Generate Schedule Form  <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </button>
          </form>

        </div>

      </div>

    </div>

    {{-- xx 2 --}}
    <div class="col-md-7">
      {{-- COURSES, TEACHERS, TOTAL HOURS, MEETINGS, ROOMTYPE  --}}
      <div class="card ct-card">
        
        <div class="card-header ct-header py-reduced-1">
          <small class="info-small text-light">
            <i class="fa fa-wpforms" aria-hidden="true" style="font-size: 1rem"></i>
             Schedule Form for <span id="selected_program"> *---* </span>
          </small>
        </div>

        <div id="form-wrapper" class="card-body">

          <button id="generateSchedule" class="btn bg-blue btn-circle btn-md pull-right" title="Fill-up all the box in the form to enable this button" disabled hidden>
            <i class="fa fa-save" aria-hidden="true"></i>
          </button>
          
          {{-- <div class="card card-body">

            <div class="form-group row">
              <label class="col-md-3 col-form-label text-right">Subject: </label>
              <div class="col-md-9">
                <select class="form-control1 subject" name="courses" style="border-radius: 2px" required>
                  @foreach ($courses as $course)
                      <option value="{{ $course->id }}">{{ $course->title }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div id="manipulate-meeting">
              <div class="form-group row">
                <label class="col-md-3 col-form-label text-right">Teacher: </label>
                <div class="col-md-9">
                  <select class="form-control1 teacher" style="border-radius: 2px" name="teachers" required>
                        <option value="">-- Choose a teacher --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label text-right">Subject Total Hours: </label>
                <div class="col-md-9">
                  <input type="text" class="form-control1 total-hours" style="border-radius: 2px" name="" value="" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-form-label text-right">Weekly meeting: </label>
                <div class="col-md-9">
                  <input type="text" class="form-control1 meeting" style="border-radius: 2px" name="" value="" required>
                </div>
              </div>
            </div>
            

            <div class="form-group row">
            <label class="col-md-3 col-form-label text-right">Room Type: </label>
              <div class="col-md-9">
                <select class="form-control1 room-type" name="room-type" required>
                  @foreach ($roomTypes as $roomType)
                      <option value="{{$roomType->id}}">{{ $roomType->room_type }}</option>
                  @endforeach
                </select>
              </div>
            </div>

          </div> --}}

        </div>

      </div>

    </div>




  </div>
</div>

<!-- xx ALERT USER IF HE IS SURE -->
<div class="modal fade show" id="promtUser" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

          <div class="modal-header" style="border-bottom: none;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <p>Are you want this data to be automatically generated?</p>
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-danger mr-auto" data-dismiss="modal">No</button>
              <button id="confSaveData" type="button" class="btn btn-info" data-dismiss="modal">Yes</button>
          </div>

      </div>
    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')


@endsection