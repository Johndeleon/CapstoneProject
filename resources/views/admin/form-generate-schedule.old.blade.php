@extends('layouts.app1')

@section('title')
  Form Generate Schedule
@endsection

@section('body')
  <link rel="stylesheet" href="{{ asset('css/GSDesign.css') }}">

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

  {{ csrf_field() }}

  <div class="container-fluid">
    <a href="/admin/dashboard">
      <button class="btn btn-sm btn-info mb-4 float-right" type="button" name="button">Back</button>
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
                <select class="form-control1 academic_year" name="academic_year" required>
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
                <select class="form-control1 semester" name="semester">
                  <option>1</option>
                  <option>2</option>
                </select>
              </div>
            </div>

            {{-- SELECT PROGRAM --}}
            <div class="form-group row">
              <label class="col-md-5 col-form-label">Program: </label>
              <div class="col-md-6">
                <select class="form-control1 program" name="program">
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
                <select class="form-control1 level" name="level">
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

              <div class="col-md-11 mx-auto mb-4">
                
                <div class="card card-body card-1" style="border-radius: 2px; background: #f1f1f1;">

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

                </div>

              </div> {{-- End of card --}}

              <div class="col-md-11 mx-auto mb-4">
                              
                <div class="card card-body card-1" style="border-radius: 2px; background: #f1f1f1;">

                  {{-- <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                  </div> --}}

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

                </div>

              </div> {{-- End of card --}}





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
  var selectedTeacher = [];

  $(window).load(function() {
    var newForm = '<div class="col-md-10 mx-auto pt-4 on-air-form mb-4" style="border-top: 1px solid #e2e2e2; border-left: 5px solid blue">'+
                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label">Subject: </label>'+
                      '<div class="col-md-9">'+
                        '<select class="form-control subject" name="courses" required>'+
                          '@foreach ($courses as $course)'+
                              '<option value="{{ $course->id }}">{{ $course->title }}</option>'+
                          '@endforeach'+
                        '</select>'+
                      '</div>'+
                    '</div>'+

                    '<div id="manipulate-meeting">'+
                      '<div class="form-group row">'+
                        '<label class="col-md-3 col-form-label">Teacher: </label>'+
                        '<div class="col-md-9">'+
                          '<select class="form-control teacher" name="teachers" required>'+
                            '<option value="">-- Choose a teacher --</option>'+
                            '@foreach ($teachers as $teacher)'+
                                '<option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>'+
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


    /** DISABLE FUNCTION FOR EVERY TEACHER WHICH HAVE NO VALUE */
    $(document).find('.teacher').each(function() {
      var teacher = $(this).val();

      if (teacher == '') {
        var meeting = $(this).parents('#manipulate-meeting').find('.meeting');

        meeting.attr('disabled', true);
      }

    });

    var clickCounter = 0;
    $(document).on( 'click', '.teacher', function(e) {
        var currId = $(this).val();

        if (clickCounter == 0) {

          for (var i=0; i<selectedTeacher.length; i++) {
            if (currId == selectedTeacher[i]) {
              findTeachers(currId);
              break;
            }
          }

          clickCounter++;
        }
        else if (clickCounter == 1){
          console.log('two');
          clickCounter = 0;
        }
    });

    /* CHECKER IF TEACHER HAVE VALUE */
    $(document).find('.teacher').each(function() {
      $(this).on('change', function(event) {

        var teacher_id = $(this).val();

        if (teacher_id != '') {

          var meeting = $(this).parents('#manipulate-meeting').find('.meeting');
          meeting.attr('disabled', false);

          $.get('/getTeacherAvaiDays/'+ teacher_id , function(data, status) {
            meeting.attr('placeholder', 'The maximum days of this teacher is '+data);
            meeting.attr('min', 1);
            meeting.attr('max', data);
          });
        }

        removeSelectedTeacher(teacher_id);

      });
    });

    var findTeachers = function(currId = null) {
      $(document).find('.teacher').each(function() {
        $(this).on('change', function(event) {

          var teacher_id = $(this).val();

          if (teacher_id != '') {

            var meeting = $(this).parents('#manipulate-meeting').find('.meeting');
            meeting.attr('disabled', false);

            $.get('/getTeacherAvaiDays/'+ teacher_id , function(data, status) {
              meeting.attr('placeholder', 'The maximum days of this teacher is '+data);
              meeting.attr('min', 1);
              meeting.attr('max', data);
            });

            if (currId != null) {
              restoreDeSelectedTeacher(currId);
            }
          }

          removeSelectedTeacher(teacher_id);

        });
      });
    };

    /* FUNCTION FOR REMOVED SELECTED TEACHERS */
    var removeSelectedTeacher = function(id) {
      selectedTeacher.push(id);
      $(document).find('.teacher').each(function() {
        $(this).find('option').each(function() {
          var optValue = $(this).val();

          if (optValue == id) {
            $(this).hide("slow");
            // console.log('remove teacher: '+ selectedTeacher);
          }
        });
      });
    } 

    var restoreDeSelectedTeacher = function(id) {
      // selectedTeacher.push(id);
      selectedTeacher.splice($.inArray(id, selectedTeacher));
      $(document).find('.teacher').each(function() {
        $(this).find('option').each(function() {
          var optValue = $(this).val();

          if (optValue == id) {
            $(this).show();
            // console.log(selectedTeacher);
          }
        });
      });
    }





















    /* REMOVE SIDEBAR */
    $('#sidebar').remove();

    /* ADD SUBJECT FORM */
    var form = 0;
    $(document).on('click', '#addBtn', function(e) {
      $('#subj-card-body').append(newForm);
      $('#undoBtn').removeAttr('hidden');
      // xx add
        
      /* AUTOMATICALLY DISABLE THE INPUT FIELD OF WEEKLY MEETING */
      $(document).find('.teacher:last-child').each(function() {
        $(this).find('option').each(function() {
          var teacher_id = $(this).val();

          for (var i = 0; i < selectedTeacher.length; i++) {
            if (teacher_id == selectedTeacher[i]) {
              $(this).hide("slow");
            }
          }
        });

        var teacher = $(this).val();

        if (teacher == '') {
          var meeting = $(this).parents('#manipulate-meeting').find('.meeting');

          meeting.attr('disabled', true);
        }

      });
      findTeachers();
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
            // console.log(data);

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
