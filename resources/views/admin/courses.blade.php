@extends('layouts.app1')

@section('title')
  CSS | Course Maintenance
@endsection

@section('styles') <link rel="stylesheet" type="text/css" href="{{ asset('css/class/courses.css') }}"> @endsection

@section('scriptstop') <script src="{{ asset('js/class/courses.class.js') }}"></script> @endsection


@section('content')

<div class="container-fluid">
  <div class="row">
    
    <div class="col-md-5">
      
      <div class="card ct-widget">
        
        <div class="card-header ct-header py-reduced-1">
          {{-- Add new subjects --}}
          <small>
            <i class="fa fa-cog" style="font-size: 0.9rem" aria-hidden="true"></i>
            Course Settings
          </small>
        </div>

        <form id="addNewCourse">
          @csrf
          <div class="card-body">

            {{-- First Card --}}
            <div class="card ct-card mb-3">

              <div class="card-header ct-header py-reduced" style="text-transform: none;">
                <small class="info-small text-light">
                  Select specific courses to bind the subjects
                </small>
              </div>

              <div class="card-body">
                <div class="form-group row">

                  <div class="col-md-6 mb-2">
                    <small class="ct-small-font">Academic Year</small>
                    <select class="form-control" name="ay" id="acadYr">
                      <option value="" selected="selected"></option>
                      
                      @foreach($ay as $item)
                        <option value="{{ $item->id }}"> {{ $item->academic_year }} </option>
                      @endforeach

                    </select>
                  </div>

                  <div class="col-md-6 mb-2">
                    <small class="ct-small-font">Semester</small>
                    <select class="form-control" name="sem" style="width: 100%" id="sem">
                      <option value="" selected="selected"></option>
                      <option value="1">1st Semester</option>
                      <option value="2">2nd Semester</option>
                    </select>
                  </div>

                  <div class="col-md-12 mb-2">
                    <small class="ct-small-font">Course</small>
                    <select class="form-control" name="course" id="program">
                      <option value="" selected="selected" disabled="true">Select Course</option>

                      @foreach ($programs as $item)
                        <option value="{{ $item->id }}">{{ $item->title }}</option>
                      @endforeach

                    </select>
                  </div>

                  <div class="col-md-12">
                    <small class="ct-small-font">Year Level</small>
                    <select class="form-control" name="level" id="level" title="Select your course field first.">

                    </select>
                  </div>
                  
                </div>
              </div>

            </div> {{-- End of first card --}}

            {{-- Second Card --}}
            <div class="card ct-card">
              
              <div class="card-header ct-header py-reduced" style="text-transform: none;">
                <small class="info-small text-light">
                  Add your courses
                </small>
              </div>

              <div class="card-body">
                <small class="ct-small-font">Course Code</small>
                <input type="text" class="form-control mb-2 emp-form" name="code" placeholder="Subject Code">

                <small class="ct-small-font">Course Title</small>
                <input type="text" class="form-control mb-2 emp-form" name="title" placeholder="Subject Title">

                <div class="form-group">
                  <small class="ct-small-font">Capable Teachers</small>
                  <select id="sel-teacher" multiple="multiple" name="teacher[]" class="form-control" data-allow-clear="0">
                    
                    @foreach($teachers as $item)
                      <option value="{{ $item->first_name }} {{ $item->last_name }}"> {{ $item->first_name }} {{ $item->last_name }} </option>
                    @endforeach

                  </select>
                </div>

                <button type="submit" class="btn btn-danger form-control" style="text-transform: uppercase;" id="addBtn"> <b>Save and form clear</b> </button>

              </div>
            </div> {{-- End of 2nd Card --}}

            <div class="alert alert-danger mt-2 error" hidden="true">
            
            </div>
          </div>
        </form>
      </div>

    </div>

    <div class="col-md-7">
      
      <div class="card ct-widget">
        
        <div class="card-header ct-header py-reduced-1">
          <small>
            <i class="fa fa-table" aria-hidden="true"></i>
            Course Table
          </small>
        </div>

        <div class="card-body">
          <h5 class="title">Subjects List</h5>
          <hr>

          <div class="table-responsive">
            <table class="table table-bordered table-light table-hover" id="dt-list-courses">

              <thead>
                <tr>
                  <th width="25%">Course Code</th>
                  <th>Course Title</th>
                  <th width="15%">Teachers Available</th>
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
</div>

<div class="modal fade show" id="editData" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog ct-modal-def" role="document">
      <div class="modal-content">

          <div class="modal-header ct-modal-head py-reduced">
              <h6 class="modal-title text-bold" id=""> 
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp Subject's data update
              </h6>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>

          <div class="modal-body">
            
            <form id="updateData">
              @csrf

              {{-- readonly inputs [ay, sem]--}}
              <div class="card card-body mb-3">
                <div class="row">
                  
                  <div class="form-group col-md-6">
                    <small class="ct-small-font"> Academic Year </small>
                    <input type="text" id="sc_ay" class="form-control" name="academic_year" readonly="readonly">
                  </div>

                  <div class="form-group col-md-6">
                    <small class="ct-small-font"> Semester </small>
                    <input type="text" id="sc_sem" class="form-control" name="semester" readonly="readonly">
                  </div>

                </div>

                <div class="form-group">
                  <small class="ct-small-font"> Subject </small>
                  <input type="text" id="sc_course" class="form-control" name="course" readonly="readonly">
                </div>

              </div>

              <div class="card card-body mb-3">
                
                <div class="form-group">
                  <small class="ct-small-font"> Course Code </small>
                  <input type="text" id="sc_code" class="form-control req" name="code">
                </div>

                <div class="form-group">
                  <small class="ct-small-font"> Course Title </small>
                  <input type="text" id="sc_title" class="form-control req" name="title">
                </div>

                <hr>
                <h5>Capable Teachers</h5>

                <div id="sc_teachers">
                  <ul id="sc_teachers_ul">
                    
                  </ul>
                </div>
                
              </div>

              <input type="hidden" id="typeid" name="idtype">
              <button type="submit" id="u_btn" class="pull-right btn btn-primary" title="Change the inputs you want to proceed." disabled="true">
                <i class="fa fa-save" aria-hidden="true"></i>
                 Update and exit
              </button>

            </form>

          </div>

      </div>
    </div>
</div>

@endsection


@section('scripts')

<script type="text/javascript">
  
  $(function() {
    allMaintenance.dataTableBtn();
  });

</script>

@endsection
