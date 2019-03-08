var selectedTeacher = [];

$(function() {

  var mes = function(data=null) {
    if (data != null) {
      alert(data)

    } else {
      alert('me')

    }
  }

  var generateScheduleForm = function() {
    $(document).on('submit', '#generateScheduleForm', function(event) {
      event.preventDefault();

      var data = $(this).serialize();
      
      bootbox.confirm('<div> Are you sure do you want to generate a form in this Course? </div>', function(e) {

        if (e) {

          $.ajax({
            type: 'POST',
            url: '/admin/generate-form-schedules/generate-form',
            data: data,
            cache: false,
            dataType: 'json',
            success: function(data) {

              if (data.status == false) {

              } else if (data.status == 'no data') {

              } else {
                var total = data.title.length;

              }

              if (data.status === 'no data') {
                bootbox.alert('<div> <b class="text-danger">No data inputted in your course table. </b> <p></p> <p>• '+ data.message +'</p></div>');

              } else if (data.status.status == true) {
                bootbox.alert('<div> Form successfully generated. </div>');

                $(document).find('#a_form').hide();
                $('#ay').attr('disabled', true);
                $('#sem').attr('disabled', true);
                $('#prog').attr('disabled', true);
                $('#lev').attr('disabled', true);

                $('#selected_program').text(data.status.program_name);

                $.each(data.title, function(index, val) {
                  addToForm(val);
                });

                disabledWeeklyMeetings()
                teacherHasValue()
                enGenerateButton(total)
                generateSchedule()

                $('#generateSchedule').attr('hidden', false);
                $('.alert').attr('hidden', true);

              } else if (data.status == false) {

                $('.alert-danger').empty();

                $.each(data.errors, function(key, val){
                  errors(val)
                });

              }
            }
          });

        }

      });
    });
  }

  var addToForm = function(title) {
    var option = '';

    var idCounter = 0;
    $.each(title.teachers ,function(index, el) {
      option += '<option value="'+ title.teacher_id[idCounter] +'"> '+ el.teacher +' </option>';
      idCounter++;
    });

    var form = '<div class="card card-body card-1 mb-3">'+

                  '<div class="form-group row">'+
                    '<label class="col-md-3 col-form-label text-right">Subject: </label>'+
                    '<div class="col-md-9">'+
                      '<input type="text" id="'+ title.title_id +'" value="'+ title.title +'" class="form-control1 subject" name="subjects" disabled>'+
                    '</div>'+
                  '</div>'+

                  '<div id="manipulate-meeting">'+
                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label text-right">Teacher: </label>'+
                      '<div class="col-md-9">'+
                        '<select class="form-control1 teacher req" style="border-radius: 2px" name="teachers" required>'+
                          '<option selected disabled> Select a teacher </option>'+
                          option +
                        '</select>'+
                      '</div>'+
                    '</div>'+

                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label text-right">Subject Total Hours: </label>'+
                      '<div class="col-md-9">'+
                        '<input type="text" class="form-control1 total-hours req" style="border-radius: 2px" name="" value="" required>'+
                      '</div>'+
                    '</div>'+

                    '<div class="form-group row">'+
                      '<label class="col-md-3 col-form-label text-right">Weekly meeting: </label>'+
                      '<div class="col-md-9">'+
                        '<input type="text" class="form-control1 meeting req" style="border-radius: 2px" name="" value="" required>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                  

                  '<div class="form-group row">'+
                  '<label class="col-md-3 col-form-label text-right">Room Type: </label>'+
                    '<div class="col-md-9">'+
                      '<select class="form-control1 room-type" name="room-type" required>'+
                        // '@foreach ($roomTypes as $roomType)'+
                        //     '<option value="{{$roomType->id}}">{{ $roomType->room_type }}</option>'+
                        // '@endforeach'+
                        '<option value="1"> Normal Room </option>'+
                        '<option value="2"> Laboratory Room </option>'+
                      '</select>'+
                    '</div>'+
                  '</div>'+

                '</div>';

    $('#form-wrapper').prepend(form);
  }

  var errors = function(error) {
    $('.alert-danger').attr('hidden', false);
    $('.alert-danger').append('<small class="info-small text-light"> <i class="fa fa-warning" aria-hidden="true"></i> &nbsp'+ error +'</small> <br>');
  }

  var showLevels = function() {
    $(document).on('change', '#prog', function(event) {
      event.preventDefault();
      var data = $(this).val();

      $.ajax({
        type: 'GET',
        url: '/admin/generate-form-schedules/get-data',
        data: {
          id: data,
          '_token': $('input[name=_token]').val(),
        },
        dataType: 'json',
        success: function(data) {

          if (data.status == true) {
            $('#lev').empty();

            for (var i = 1; i <= data.level; i++) {
              $('#lev').append('<option>'+ i +'</option>');
            }

          }

        }
      });

    });
  }

  generateScheduleForm()
  showLevels()

  /** DISABLE FUNCTION FOR EVERY TEACHER WHICH HAVE NO VALUE */
  var disabledWeeklyMeetings = function() {
    $(document).find('.teacher').each(function() {
      var teacher = $(this).val();

      if (teacher == null) {
        var meeting = $(this).parents('#manipulate-meeting').find('.meeting');

        meeting.attr('disabled', true);
      }

    });
  }

  /* CHECKER IF TEACHER HAVE VALUE */
  var teacherHasValue = function() {
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

      });
    });
  }

  var reqCounter = 0;
  var enGenerateButton = function(total) {
    $(document).on('keyup', '.req', function(event) {
      event.preventDefault();
      var totalAmountReq = (total * 3);

      $(document).find('.req').each(function(index, el) {
        
        if ($(this).val() != null && $(this).val() != '') {

          reqCounter++;
        }

      });

      if (reqCounter == totalAmountReq) {

        $('#generateSchedule').attr('disabled', false);
        $('#generateSchedule').attr('title', 'Click here to start the generating process.');

      } else {

        $('#generateSchedule').attr('disabled', true);
        $('#generateSchedule').attr('title', 'Fill-up all the box in the form to enable this button');
      }

      reqCounter = 0;
      
    });
  }

  var generateSchedule = function() {
    $(document).on('click', '#generateSchedule', function(event) {
      event.preventDefault();
      
      bootbox.confirm('<div> Do you want to start the generation of schedules? There is no coming back. </div>', function(e) {

        if (e) {

          var courses = [];
          var teachers = [];
          var total_hours = [];
          var meeting = [];
          var roomtype = [];

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
              var value = $(this).attr('id');
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
              // location.reload();
            }
          );
          
        }

      });
    });
  }

});