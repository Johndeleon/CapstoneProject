@extends('layouts.app1')

@section('title')
  Form Generate Schedule
@endsection

@section('body')
  <link rel="stylesheet" href="{{ asset('css/GSDesign.css') }}">

  {{ csrf_field() }}

  <div class="container-fluid">
    <a href="/admin/dashboard">
      <button class="btn btn-sm btn-outline-dark mb-4 float-right" type="button" name="button">Back</button>
    </a>
    <div class="clearfix">

    </div>
    <div class="row">

      <div class="col-md-4">

        <div class="card">
          <div class="card-header">
            Select Academic year and Semester
          </div>

          <div class="card-body">

            {{-- ACADEMIC YEAR --}}
            <div class="form-group row">
              <label class="col-md-5 col-form-label">Academic Year: </label>
              <div class="col-md-6">
                <select class="form-control academic_year" name="academic_year" required>
                  @if (count($academicYears))
                    @foreach ($academicYears as $academicYear)
                        <option>{{ $academicYear->academic_year }}</option>
                    @endforeach
                  @else
                        <option>No data stored</option>
                  @endif
                </select>
              </div>
            </div>

            {{-- SEMESTER --}}
            <div class="form-group row">
              <label class="col-md-5 col-form-label">Semester: </label>
              <div class="col-md-6">
                <select class="form-control semester" name="semester">
                  <option>1</option>
                  <option>2</option>
                </select>
              </div>
            </div>

            {{-- SELECT PROGRAM --}}
            <div class="form-group row">
              <label class="col-md-5 col-form-label">Program: </label>
              <div class="col-md-6">
                <select class="form-control program" name="program">
                  @if (count($programs))
                    @foreach ($programs as $program)
                      <option>{{ $program->title }} </option>
                    @endforeach

                  @else
                      <option>No programs stored</option>
                  @endif
                </select>
              </div>
            </div>

            {{-- SELECT Level --}}
            <div class="form-group row">
              <label class="col-md-5 col-form-label">Level: </label>
              <div class="col-md-6">
                <select class="form-control level" name="level">
                  @for($i=1;$i<=5;$i++)
                  <option>{{$i}}</option>
                  @endfor
                </select>
              </div>
            </div>

          </div>
        </div>

      </div>

      <div class="col-md-8">
        {{-- COURSES, TEACHERS, TOTAL HOURS, MEETINGS, ROOMTYPE  --}}
        <div class="card">
          <div class="card-header">
            Courses to scheduled
          </div>

          <div id="subj-card-body" class="card-body row">

              <div class="col-md-10 mx-auto">
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Subject: </label>
                    <div class="col-md-9">
                      <select class="form-control subject" name="courses" required>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Teacher: </label>
                    <div class="col-md-9">
                      <select class="form-control teacher" name="teachers" required>
                        @foreach ($teachers as $teacher)
                            <option>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Subject Total Hours: </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control total-hours" name="" value="" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Weekly meeting: </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control meeting" name="" value="" required>
                    </div>
                  </div>

                  <div class="form-group row">
                  <label class="col-md-3 col-form-label">Room Type: </label>
                    <div class="col-md-9">
                      <select class="form-control room-type" name="room-type" required>
                        @foreach ($roomTypes as $roomType)
                            <option value="{{$roomType->id}}">{{ $roomType->room_type }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

              </div>

              <div class="col-md-10 mx-auto pt-4" style="border-top: 1px solid #e2e2e2">
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Subject: </label>
                    <div class="col-md-9">
                      <select class="form-control subject" name="courses" required>
                        @foreach ($courses as $course)
                            <option>{{ $course->title }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Teacher: </label>
                    <div class="col-md-9">
                      <select class="form-control teacher" name="teachers" required>
                        @foreach ($teachers as $teacher)
                            <option>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Subject Total Hours: </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control total-hours" name="" value="" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Weekly meeting: </label>
                    <div class="col-md-9">
                      <input type="text" class="form-control meeting" name="" value="" required>
                    </div>
                  </div>

                  <div class="form-group row">
                  <label class="col-md-3 col-form-label">Room Type: </label>
                    <div class="col-md-9">
                      <select class="form-control room-type" name="room-type" required>
                        @foreach ($roomTypes as $roomType)
                            <option value="{{$roomType->id}}">{{ $roomType->room_type }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
              </div>





          </div>

          <div class="btn-group col-md-4 mr-5 ml-auto">
            <a id="undoBtn" class="mx-auto text-center mb-3 form-gen-sched-btn" hidden>
              <i class="fa fa-undo" aria-hidden="true"></i>
            </a>

            <a id="addBtn" class="mx-auto text-center mb-3 form-gen-sched-btn">
              <i class="fa fa-plus" aria-hidden="true"></i>
            </a>

            <a id="saveBtn" data-target="#promtUser" data-toggle="modal" class="mx-auto text-center mb-3 form-gen-sched-btn">
              <i class="fa fa-save" aria-hidden="true"></i>
            </a>
          </div>


        </div> {{-- card end --}}
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




<script type="text/javascript">
  $(document).ready(function() {
    var newForm = '<div class="col-md-10 mx-auto pt-4 on-air-form" style="border-top: 1px solid #e2e2e2">'+
                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label">Subject: </label>'+
                      '<div class="col-md-9">'+
                        '<select class="form-control subject" name="courses" required>'+
                          '@foreach ($courses as $course)'+
                              '<option>{{ $course->title }}</option>'+
                          '@endforeach'+
                        '</select>'+
                      '</div>'+
                    '</div>'+

                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label">Teacher: </label>'+
                      '<div class="col-md-9">'+
                        '<select class="form-control teacher" name="teachers" required>'+
                          '@foreach ($teachers as $teacher)'+
                              '<option>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>'+
                          '@endforeach'+
                        '</select>'+
                      '</div>'+
                    '</div>'+

                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label">Subject Total Hours: </label>'+
                      '<div class="col-md-9">'+
                        '<input type="text" class="form-control total-hours" name="" value="" required>'+
                      '</div>'+
                    '</div>'+

                    '<div class="form-group row">' +
                      '<label class="col-md-3 col-form-label">Weekly meeting: </label>' +
                      '<div class="col-md-9">' +
                        '<input type="text" class="form-control meeting" name="" value="" required>' +
                      '</div>'+
                    '</div>'+

                    '<div class="form-group row">'+
                  '<label class="col-md-3 col-form-label">Room Type: </label>'+
                    '<div class="col-md-9">'+
                      '<select class="form-control room-type" name="room-type" required>'+
                        '@foreach ($roomTypes as $roomType)'+
                            '<option value="{{$roomType->id}}">{{ $roomType->room_type }}</option>'+
                        '@endforeach'+
                      '</select>'+
                    '</div>'+
                  '</div>'+

                  '</div>';























    /* REMOVE SIDEBAR */
    $('#sidebar').remove();

    /* ADD SUBJECT FORM */
    var form = 0;
    $(document).on('click', '#addBtn', function(e) {
      $('#subj-card-body').append(newForm);
      $('#undoBtn').removeAttr('hidden');
      form++;
    });

    /* UNDO SUBJECT FORM */
    $(document).on('click', '#undoBtn', function(e) {
      $(document).find('.on-air-form').last().remove();
      form--;

      if (form == 0) {
        $('#undoBtn').attr('hidden', 'true');
      }
    });

    /* SAVE BUTTON */
    var courses = [];
    var teachers = [];
    var total_hours = [];
    var meeting = [];
    var roomtype = [];

    $(document).on('click', '#confSaveData', function(e) {

        // SAVING THE VALUE OF ACADEMIC YEAR
        var acadYr = $(document).find('.academic_year').val();

        // SAVING THE VALUE OF SEMESTER
        var semester = $(document).find('.semester').val();

        // SAVING THE VALUE OF PROGRAM
        var program = $(document).find('.program').val();

        // SAVING THE VALUE OF LEVEL
        var level = $(document).find('.level').val();

        // ARRAY SAVING COURSES
        $(document).find('.subject').each(function() {
            var value = $(this).val();
            courses.push(value);
        });

        // ARRAY SAVING TEACHERS ASSIGNED
        $(document).find('.teacher').each(function() {
            var value = $(this).val();
            teachers.push(value);
        });

        // ARRAY SAVING TOTAL HOURS OF THE SUBJECT
        $(document).find('.total-hours').each(function() {
            var value = $(this).val();
            total_hours.push(value);
        });

        // ARRAY SAVING WEEKLY MEETING
        $(document).find('.meeting').each(function() {
            var value = $(this).val();
            meeting.push(value);
        });

        $(document).find('.room-type').each(function() {
            var value = $(this).val();
            roomtype.push(value);
        });

        $.post('/generate',
        {
          academic_year: acadYr,
          semester: semester,
          program_title: program,
          level: level,
          courses: courses,
          teachers: teachers,
          total_hours: total_hours,
          meeting: meeting,
          roomtype: roomtype,
          '_token': $('input[name=_token]').val()
        }
        , function(data, status){
            console.log(data);

            window.localStorage['programs'] = data;
            window.open('/admin/customize-schedules');
        }
        );

    });

    // console.log(courses);
    // console.log(teachers);
    // console.log(total_hours);
    // console.log(meeting);

  });
</script>
@endsection
