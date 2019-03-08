@extends('layouts.app1')

@section('title') CSS | Teachers Maintenance @endsection

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">
@endsection

@section('scripts')

@endsection

@section('content')

  <div class="container-fluid mb-5">
      <div class="row">

        <div class="col-md-11 mx-auto">
          <div class="card bg-me">
            <div class="card-header cat-header">
              <a href="#" class="float-right" style="font-size: 13px">
                <i class="fa fa-window-minimize" aria-hidden="true"></i>
              </a>
              <a href="#addTeacher" id="addTeacher-btn" data-toggle="modal" class="float-right px-3 mr-3 cat-tab-btn">
                  <i class="fa fa-user mr-1" aria-hidden="true"></i>
                Add Teacher
              </a>
            </div>

            <div class="table-responsive">
              <table class="cat-table table bg-dark table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Contact Number</th>
                    <th>Email</th>
                    <th>Address</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($teachers as $teacher)
                    <tr>
                      <td>{{ $teacher->id }}</td>
                      <td>{{ $teacher->first_name }} {{ $teacher->last_name }}</td>
                      <td>{{ $teacher->contact_number }}</td>
                      <td>{{ $teacher->email }}</td>
                      <td>{{ $teacher->address }}</td>
                    </tr>
                  @endforeach
                </tbody>

              </table>
            </div>
          </div>

        </div>

      </div>
  </div>

<!-- xx ADD ACADEMICYEAR modal -->
<div class="modal fade show cat-ay-modal" id="setTime" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">

          <div class="modal-header">
              <h6 class="modal-title">
                Set start time and end time
              </h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
              </button>
          </div>

          <div class="modal-body cat-modal-body">
              {{-- <div class="form-group">
                <label>Monday: <b>7:00 - 20:00</b></label>
                <div class="slider">

                </div>
              </div> --}}
          </div>

          <div class="modal-footer">

          </div>

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







  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
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
  </script>


@endsection
