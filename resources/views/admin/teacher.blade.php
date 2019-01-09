@extends('layouts.app1')

@section('body')
  <link rel="stylesheet" href="{{ asset('css/myDesign.css') }}">

  <div class="container mb-5">
      <div class="row justify-content-center">
          <div class="col-md-8">

              @if (session('added'))
                  <div id="SuccAdded" class="alert alert-success" role="alert">
                      {{ session('added') }}
                  </div>
              @endif
              <div class="card">
                <div class="card-body">
                    {{-- xx must be changed --}}
                    <h2>Teacher's Tab</h2>

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
                            <input class="form-control" type="text-area" name="address" value="" required>
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
                        <button id="manageData" type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#setTime" name="button">Time Setup</button>
                        <input id="saveAvaDay" type="hidden" name="available_days" value="">

                    </form>
                </div>
              </div>

          </div>
      </div>
  </div>

  <!-- xx ADD ACADEMICYEAR modal -->
  <div class="modal fade show" id="setTime" tabindex="-1" role="dialog" aria-labelledby="">
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


  <script type="text/javascript">
      $(document).ready(function() {
         $('.checkbox').prop('checked', true);

         /* CHECKING ALL THE CHECKED CHECKBOX AND INSERTING INSIDE THE MODAL */
         var checkbox = $('.checkbox');
         var checkedCheckbox = [];
         var dayName;

         $('#manageData').click(function() {
             $('.checkbox:checked').each(function() {
               checkedCheckbox.push($(this).attr('data-id'));
             });

             /* SHOW ALL THE CHECKED DATA */
             for (var i = 0; i < checkedCheckbox.length; i++) {
                if (checkedCheckbox[i] == 1) {
                    dayName = "Monday";
                    $('.cat-modal-body').append(
                      '<div class="form-group select-day">'+
                        '<label>'+ dayName +': <b></b></label>'+
                        '<div class="slider">'+
                        '</div>'+
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
