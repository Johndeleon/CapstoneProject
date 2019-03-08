@extends('layouts.app1')

@section('title') CSS | Teachers Maintenance @endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/class/teachers.css') }}">
@endsection

@section('content')

<div class="container-fluid">
  <div class="row">

    <div class="col-md-5">
      <div class="card ct-card reload-page">
        <div class="card-header ct-header py-reduced-1">
          {{-- <i class="fa fa-cog" style="font-size: 1.1rem" aria-hidden="true"></i>&nbsp Teacher settings --}}
          <small>
            <i class="fa fa-cog" style="font-size: 0.9rem" aria-hidden="true"></i>
            Teacher settings
          </small>
        </div>

        <form id="id-addTeacher">
          @csrf
          <div id="firstForm" class="card-body">
              
            <h5>Add Teachers</h5>
            <hr>

            <div class="form-group">
              <small class="ct-small-font">First Name</small>
              <input id="id-firstname" class="form-control reset" type="text" name="first_name">
            </div>

            <div class="form-group">
              <small class="ct-small-font">Last Name</small>
              <input id="id-lastname" class="form-control reset" type="text" name="last_name">
            </div>

            <div class="form-group">
              <small class="ct-small-font">Contact</small>
              <input id="id-contact" class="form-control reset" type="text" name="contact">
            </div>

            <div class="form-group">
              <small class="ct-small-font">Email</small>
              <input id="id-email" class="form-control reset" type="text" name="email">
            </div>

            <div class="form-group">
              <small class="ct-small-font">Address (optional)</small>
              <input id="id-address" class="form-control reset" type="text" name="address">
            </div>

            <button id="goAvaiDays" class="btn btn-primary pull-right">Add teachers available day &nbsp <i class="fa fa-arrow-right" aria-hidden="true"></i></button>

            <button name="form-1" class="btn btn-default btn-circle btn-md reset bg-gray" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>

          </div> {{-- End of card-body --}}

          <div id="secondForm" class="card-body">
              
            <h5>Add teacher's available days <a href="" id="backFirstForm" class="pull-right" title="Go back" style="font-size: 0.9em"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></h5> 
            <hr>

            <div id="info" class="card mb-3">
              <div class="card-header">
                <b class="text-danger"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> &nbsp Information</b>

                <button type="button" id="close-1" class="close" title="Remove information section" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>

              <div class="card-body">

                <small class="info-small">
                  <p>
                    • &nbsp Time format is always on military time.
                  </p>
                </small>

                <small class="info-small">
                  <p>
                    • &nbsp An empty inputs will be considered not available day for the teacher.
                  </p>
                </small>

                <small class="info-small">
                  <p>
                    • &nbsp Inputting an accurate data can lead to an accurate results.
                  </p>
                </small>
              </div>
            </div>
          
            <div class="alert alert-danger error">
              
            </div>

            <div class="form-group">
              <small class="ct-small-font pb-2">Monday</small>
              <div class="row">

                <div class="col-md-5">
                  <input class="form-control reset-2-f" maxlength="5" type="text" name="mon_time1" placeholder="Start time" value="8:00">
                </div>
                
                <div class="col-md-5">
                  <input class="form-control reset-2-f reset-2-fs read-only" maxlength="5" type="text" name="mon_time2" placeholder="Finish time" value="20:00">
                </div>

                <div class="col-md-2">
                  <input type="checkbox" style="height: 1.3em; width: 1.3em; margin-top: 25%" name="cb_monday" class="checkbox">
                </div>

              </div>
            </div>

            <div class="form-group">
              <small class="ct-small-font">Tuesday</small>
              <div class="row">
                <div class="col-md-5">
                  <input class="form-control reset-2-f" maxlength="5" type="text" name="tue_time1" placeholder="Start time" value="8:00">
                </div>
                
                <div class="col-md-5">
                  <input class="form-control reset-2-f reset-2-fs" maxlength="5" type="text" name="tue_time2" placeholder="Finish time" value="20:00">
                </div>

                <div class="col-md-2">
                  <input type="checkbox" style="height: 1.3em; width: 1.3em; margin-top: 25%" name="cb_tuesday" class="checkbox">
                </div>

              </div>
            </div>

            <div class="form-group">
              <small class="ct-small-font">Wednesday</small>
              <div class="row">
                <div class="col-md-5">
                  <input class="form-control reset-2-f" maxlength="5" type="text" name="wed_time1" placeholder="Start time" value="8:00">
                </div>
                
                <div class="col-md-5">
                  <input class="form-control reset-2-f reset-2-fs" maxlength="5" type="text" name="wed_time2" placeholder="Finish time" value="20:00">
                </div>

                <div class="col-md-2">
                  <input type="checkbox" style="height: 1.3em; width: 1.3em; margin-top: 25%" name="cb_wednesday" class="checkbox">
                </div>

              </div>
            </div>

            <div class="form-group">
              <small class="ct-small-font">Thursday</small>
              <div class="row">
                <div class="col-md-5">
                  <input class="form-control reset-2-f" maxlength="5" type="text" name="thu_time1" placeholder="Start time" value="8:00">
                </div>
                
                <div class="col-md-5">
                  <input class="form-control reset-2-f reset-2-fs" maxlength="5" type="text" name="thu_time2" placeholder="Finish time" value="20:00">
                </div>

                <div class="col-md-2">
                  <input type="checkbox" style="height: 1.3em; width: 1.3em; margin-top: 25%" name="cb_thursday" class="checkbox">
                </div>

              </div>
            </div>

            <div class="form-group">
              <small class="ct-small-font">Friday</small>
              <div class="row">
                <div class="col-md-5">
                  <input class="form-control reset-2-f" type="text" maxlength="5" name="fri_time1" placeholder="Start time" value="8:00">
                </div>
                
                <div class="col-md-5">
                  <input class="form-control reset-2-f reset-2-fs" maxlength="5" type="text" name="fri_time2" placeholder="Finish time" value="20:00">
                </div>

                <div class="col-md-2">
                  <input type="checkbox" style="height: 1.3em; width: 1.3em; margin-top: 25%" name="cb_friday" class="checkbox">
                </div>

              </div>
            </div>

            <div class="form-group">
              <small class="ct-small-font">Saturday</small>
              <div class="row">
                <div class="col-md-5">
                  <input class="form-control reset-2-f" type="text" maxlength="5" name="sat_time1" placeholder="Start time" value="8:00">
                </div>
                
                <div class="col-md-5">
                  <input class="form-control reset-2-f reset-2-fs" type="text" maxlength="5" name="sat_time2" placeholder="Finish time" value="20:00">
                </div>

                <div class="col-md-2">
                  <input type="checkbox" style="height: 1.3em; width: 1.3em; margin-top: 25%" name="cb_saturday" class="checkbox">
                </div>
              </div>
            </div>

            <button name="form-2" class="btn btn-default btn-circle btn-md reset bg-gray" title="Reset Form"><i class="fa fa-refresh" aria-hidden="true"></i></button>

            {{-- <a href="" id="backFirstForm" class="pull-right" title="Go back" style="font-size: 1.2em"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> --}}

            <button id="id-addTeacher-btn" type="submit" class="btn btn-danger pull-right">Store this teacher &nbsp <i class="fa fa-arrow-right" aria-hidden="true"></i></button>

          </div> {{-- End of card-body --}}

        </form>

      </div>
    </div>

    <div class="col-md-7 mx-auto">
      <div class="card ct-card">
        <div class="card-header ct-header py-reduced-1">
          {{-- <i class="fa fa-user" style="font-size: 1.1rem" aria-hidden="true"></i>&nbsp Teacher's Table --}}
          <small>
            <i class="fa fa-user" style="font-size: 0.9rem" aria-hidden="true"></i>
            Teacher's Table
          </small>
        </div>

        <div class="card-body">

          <div class="table-responsive">
            <table class="table table-bordered" id="dt-teacher">
              <thead>
                <tr>
                  <th>Fullname</th>
                  <th>Contact</th>
                  <th>Email</th>
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
{{-- IMPORT TEACHERS FROM EXCEL --}}
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
              
              <form method="POST" action="/admin/teachers/import-teachers" name="import-teachers" enctype="multipart/form-data">
                @csrf
                {{-- SELECT EXCEL FILE --}}
                  <div class="form-group">
                    <small class="ct-small-font"> From </small>
                    <input type="file" class="form-control tobe-reset required" name="excelFile" placeholder="Excel File">
                  </div>
                  <button type="submit" id="importTeachers" class="btn btn-danger pull-right">
                    Import this to Database 
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </button>
              </form>
              
            </div>

            </div>
    </div>
</div>
<div class="row">
{{-- IMPORT AVAILABLETIME FROM EXCEL --}}
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
              
              <form method="POST" action="/admin/teachers/import-available-time" name="import-available-time" enctype="multipart/form-data">
                @csrf
                {{-- SELECT EXCEL FILE --}}
                  <div class="form-group">
                    <small class="ct-small-font"> From </small>
                    <input type="file" class="form-control tobe-reset required" name="excelFile" placeholder="Excel File">
                  </div>
                  <button type="submit" id="importAvailableTime" class="btn btn-danger pull-right">
                    Import this to Database 
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </button>
              </form>
              
            </div>

            </div>
    </div>
</div>
</div>

<!-- xx ADD ACADEMICYEAR modal -->
<div class="modal fade show" id="editData" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-sm-3 ct-modal-def" role="document">
      <div class="modal-content">

          <div class="modal-header ct-modal-head py-reduced">
              
              <h6 class="modal-title text-bold" id=""> 
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> &nbsp Teacher's data update
              </h6>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>

          </div>

          <form id="updateTeacherData">
            <div class="modal-body">
              
              @csrf

              <input type="hidden" id="upd_id" name="id" value="">
              <input type="hidden" id="" name="type" value="teacher">

              <div class="form-group">
                <small class="ct-small-font">First Name</small>
                <input id="upd_firstName" type="text" class="form-control empty-me" name="first_name">
              </div>

              <div class="form-group">
                <small class="ct-small-font">Last Name</small>
                <input id="upd_lastName" type="text" class="form-control empty-me" name="last_name">
              </div>

              <div class="form-group">
                <small class="ct-small-font">Contact</small>
                <input id="upd_contact" type="text" class="form-control empty-me" name="contact">
              </div>

              <div class="form-group">
                <small class="ct-small-font">Email</small>
                <input id="upd_email" type="text" class="form-control empty-me" name="email">
              </div>

              <div class="form-group">
                <small class="ct-small-font">Address</small>
                <textarea id="upd_address" class="form-control empty-me" rows="2" name="address"></textarea>
              </div>

              <button type="submit" id="u_btn" class="btn btn-primary pull-right mb-3" title="Change something to enabled this button" disabled><i class="fa fa-save" aria-hidden="true"></i> &nbspUpdate Data</button>

            </div>
          </form>

      </div>
    </div>
</div>

  {{-- Add Teacher Modal --}}
  <div class="modal fade show" id="addTeacher" tabindex="-1" role="dialog" aria-labelledby="">
      <div class="modal-dialog modal-lg cat-add-modal" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h6 class="modal-title">
              Add teachers
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body cat-mb">
            <div class="row">
              <div class="card col-md-6">
                <div class="card-body">
                  <form id="saveID" action="{{ URL::to('store/teacher') }}" class="form-group" method="post">

                    {{ csrf_field() }}
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
                      <textarea name="description" class="form-control" id="" rows="3" required></textarea>
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
                    <button id="submitBtn" class="btn btn-success float-right ml-3" type="submit" name="button" disabled>Save</button>
                    <input id="saveAvaDay" type="hidden" name="available_days" value="">
                  </form>
                </div>
              </div>

              <div class="col-md-6 card">
                <div class="card-body cat-modal-body">

                </div>
              </div>



















            </div>
          </div>


        </div>
      </div>
  </div>





  @section('scriptstop')
  <script src="{{ asset('js/class/teachers.class.js') }}"></script>
  @endsection

  @section('scripts')
    <script type="text/javascript">
      window.onload = function() {
        teacherMaintenance.init();
      }
    </script>
  @endsection


  {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
  <script src="{{ asset('js/jquery/jquery-ui.js') }}"></script>


  <script type="text/javascript">
      $(document).ready(function() {

        $(document).find('#slide').each(function() {
          $(this).slider();
        });

         /* DATATABLE FOR TEACHER */
         $('#myTable').DataTable();

         $('.checkbox').prop('checked', true);

         /* CHECKING ALL THE CHECKED CHECKBOX AND INSERTING INSIDE THE MODAL */
         var checkbox = $('.checkbox');
         var checkedCheckbox = [];
         var dayName;

         $('#addTeacher-btn').click(function() {
             $('.checkbox:checked').each(function() {
               checkedCheckbox.push($(this).attr('data-id'));
             });

            /* SHOW ALL THE CHECKED DATA */
            for (var i = 0; i < checkedCheckbox.length; i++) {
              if (checkedCheckbox[i] == 1) {
                dayName = "Monday";
                $('.cat-modal-body').append(
                  '<div class="form-group select-day">'+
                    '<div class="row">'+
                      '<label class="col-md-4">'+ dayName +': </label>'+
                      '<input type="text" class="form-control col-md-3 mr-2">'+
                      '<input type="text" class="form-control col-md-3">'+
                      '<div class="col-md-12">'+
                        '<div id="slide"></div>'+
                      '</div>'+
                    '</div>' +

                  '</div>'
                );




              }
              else if (checkedCheckbox[i] == 2) {
                  dayName = "Tuesday";
                  $('.cat-modal-body').append(
                    '<div class="form-group select-day">'+
                      '<label>'+ dayName +': <b></b></label>'+
                      '<div class="slider">'+
                      '</div>'+
                    '</div>'
                  );
              }
              else if (checkedCheckbox[i] == 3) {
                  dayName = "Wednesday";
                  $('.cat-modal-body').append(
                    '<div class="form-group select-day">'+
                      '<label>'+ dayName +': <b></b></label>'+
                      '<div class="slider">'+
                      '</div>'+
                    '</div>'
                  );
              }
              else if (checkedCheckbox[i] == 4) {
                  dayName = "Thursday";
                  $('.cat-modal-body').append(
                    '<div class="form-group select-day">'+
                      '<label>'+ dayName +': <b></b></label>'+
                      '<div class="slider">'+
                      '</div>'+
                    '</div>'
                  );
              }
              else if (checkedCheckbox[i] == 5) {
                  dayName = "Friday";
                  $('.cat-modal-body').append(
                    '<div class="form-group select-day">'+
                      '<label>'+ dayName +': <b></b></label>'+
                      '<div class="slider">'+
                      '</div>'+
                    '</div>'
                  );
              }
              else if (checkedCheckbox[i] == 6) {
                  dayName = "Saturday";
                  $('.cat-modal-body').append(
                    '<div class="form-group select-day">'+
                      '<label>'+ dayName +': <b></b></label>'+
                      '<div class="slider">'+
                      '</div>'+
                    '</div>'
                  );
              }
            }
         });

         /* IF CLICKED CLOSE THEN EMPTY DATA */
         $('.close').click(function() {
            $(document).find('.select-day').each(function() {
                $(this).remove();
            });
         });


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
  </script> --}}


@endsection
