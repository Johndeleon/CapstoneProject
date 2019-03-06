@extends('layouts.app1')

@section('title')
  CSS | Programs Maintenance
@endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">
@endsection

@section('scriptstop')
<script type="text/javascript" src="{{ asset('js/class/programs.class.js') }}"></script>
@endsection

@section('content')
{{ csrf_field() }}
<div class="container-fluid">
  <div class="row">

    {{-- ADD PROGRAMS SECTION --}}
    <div class="col-md-5">
      <div class="card ct-card">

        <div class="card-header ct-header py-reduced-1">
          <small>
            <i class="fa fa-cog" aria-hidden="true"></i> Programs Settings
          </small>
          {{-- <i class="fa fa-cog" aria-hidden="true"></i>
           Programs Settings --}}
        </div>

        <div class="card-body">
          
          <h5>Add Programs</h5>
          <hr>

          <div class="alert alert-danger" hidden="true">
            
          </div>

          <form id="addProgramData">
            @csrf
            {{-- title, description, levels, year --}}
            <div class="form-group">
              <small class="ct-small-font">Academic Year</small>

              <select class="form-control required" name="academic_year">
                <option disabled="true" selected="selected">
                  Select academic year
                </option>

                @if (count($acadYears) > 0)

                  @foreach($acadYears as $item)
                    <option value="{{ $item->id }}">{{ $item->academic_year }}</option>
                  @endforeach

                @else
                  <option disabled="true">No data detected</option>
                @endif

              </select>
            </div>

            <div class="form-group">
              <small class="ct-small-font"> Program Title </small>
              <input type="text" class="form-control tobe-reset required" name="title" placeholder="Course name">
            </div>

            <div class="form-group">
              <small class="ct-small-font"> Program Description (optional)</small>
              <textarea class="form-control tobe-reset required" name="description" placeholder="Course description" title="Add description to the course"></textarea>
            </div>

            <div class="form-group">
              <small class="ct-small-font"> Levels </small>
              <input type="text" class="form-control tobe-reset required" maxlength="1" name="level" title="Input how many level this course has">
            </div>

            {{-- Buttons --}}
            <button class="btn btn-default btn-circle btn-md reset bg-gray" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>

            <button type="submit" id="addProgram" class="btn btn-danger pull-right">
              Store this program 
              <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </button>
          </form>

        </div>
        
      </div>
    </div>


    {{-- PROGRAMS TABLE --}}
    <div class="col-md-7">
      
      <div class="card ct-card">
        <div class="card-header ct-header py-reduced-1">
          {{-- <i class="fa fa-table" aria-hidden="true"></i> 
          &nbspPrograms Table --}}
          <small>
            <i class="fa fa-table" aria-hidden="true"></i> 
            Programs Table
          </small>

        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dt_program">
              <thead>
                <tr>
                  <th width="25%">Subject Title</th>
                  <th>Description</th>
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
              
              <form method="POST" action="/admin/programs/import-programs" name="import-programs" enctype="multipart/form-data">
                @csrf
                {{-- SELECT EXCEL FILE --}}
                  <div class="form-group">
                    <small class="ct-small-font"> From </small>
                    <input type="file" class="form-control tobe-reset required" name="excelFile" placeholder="Excel File">
                  </div>
                  <button type="submit" id="importProgram" class="btn btn-danger pull-right">
                    Import this to Database 
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </button>
              </form>
              
            </div>

            </div>
    </div>
</div>
</div>

{{-- Show/Update modal --}}
<div class="modal fade show" id="editData" tabindex="-1" role="dialog" aria-labelledby="">
  <div class="modal-dialog modal-sm-3 ct-modal-def" role="document">
    <div class="modal-content">

      <div class="modal-header ct-modal-head py-reduced">
        <h6 class="modal-title text-bold" id=""> 
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp Program's Data Update
        </h6>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <form id="updateProgramData"> 
          @csrf
        
          <div class="form-group">
            <small class="ct-small-font">Academic Year</small>
            <input type="text" id="sc_academic_year" class="form-control" name="academic_year" readonly="readonly">
          </div>

          <div class="form-group">
            <small class="ct-small-font">Program Title</small>
            <input id="sc_title" type="text" name="title" class="form-control empty-me">
          </div>

          <div class="form-group">
            <small class="ct-small-font">Program Description</small>
            <textarea id="sc_description" class="form-control empty-me" name="description" rows="3"></textarea>
          </div>

          <div class="form-group">
            <small class="ct-small-font">Levels</small>
            <input id="sc_level" type="text" name="level" maxlength="1" class="form-control" readonly="readonly">
          </div>

          <input id="idtype" type="hidden" name="idtype" value="">
          <button type="submit" id="u_btn" class="btn btn-primary pull-right" title="Click to update your data">
            <i class="fa fa-save" aria-hidden="true"></i>
             Update and Exit
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
    programMaintenance.init();
    allMaintenance.dataTableBtn();
  });

</script>

@endsection
