@extends('layouts.app1')

@section('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/customization.css') }}">
@endsection

@section('title')

@endsection

@section('body')
    <script>
        var data = window.localStorage["programs"];
        var currentDay;
        var datas;

        $(window).on('load', function() {
            data = $.parseJSON(data);
            var academic_year = data[0].academic_year_id;
            var semester = data[0].semester;
            var program_id = data[0].program_id;
            
            $('button').one('click', function() {
                $.post('/getGeneratedSchedule', {

                    academic_year_id: academic_year,
                    semester: semester,
                    program_id: program_id,
                    '_token': $('input[name=_token]').val(),

                }, function(data, textStatus, xhr) {
                    showInitialSchedule(data)
                });
            }); 
            
            var getGeneratedSchedule = function() {
                $.post('/getGeneratedSchedule', {

                    academic_year_id: academic_year,
                    semester: semester,
                    program_id: program_id,
                    '_token': $('input[name=_token]').val(),

                }, function(data, textStatus, xhr) {
                    showInitialSchedule(data)
                });
            }


            var showInitialSchedule = function(data) {

                var sortedData = data.sort(function(obj1, obj2) {
                    return obj1.time_start - obj2.time_start;
                });

                sortedData.forEach(function(item) {
                    var time = item.time_start + ' - ' + item.time_finish;

                    $.post('/getRealData', {

                        id: item.id,
                        teacher:  item.teacher_id,
                        room:     item.room_id,
                        ay:       item.academic_year_id,
                        program:  item.program_id,
                        semester: item.semester,
                        course:   item.course_id,
                        '_token': $('input[name=_token]').val(),

                    }, function(data, status) {

                      if (item.day_of_week == 1) { // Monday
                        var subjectWrapper = '<div class="card card-schedule col-md-12 border-left-0 border-right-0 rounded-0 bg-light p-0" style="min-height: 140px;">'+
                                                '<a href="#" class="edit px-2 pink ml-auto" style="font-size: 12px;">Edit</a><a href="#" class="done px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a><a href="" class="saving px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<input id="sched-id" value="'+data.names.id+'" hidden>'+
                                                    '<input id="day" class="day1" value="1" hidden>'+
                                                    '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                    '<input id="program" class="" value="'+ data.names.program +'" hidden>'+
                                                    '<input id="semester" class="" value="'+ data.names.semester +'" hidden>'+

                                                    '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                        
                                                    '</select>'+

                                                    '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                    '<div class="course"> <b>'+ data.names.course +'</b> </div>'+
                                                    '<input id="teacher_id" value="'+data.names.teacher_id+'" hidden>'+
                                                    '<div class="teacher">'+ data.names.teacher +'</div>'+

                                                    '<div class="time rem">'+ time +'</div>'+
                                                    '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                    '<select id="notAvailableTime" class="time editForm" style="width: 80%; margin-bottom: 3px;" hidden>'+

                                                    '</select>'+
                                                    '<div class="timeHide" style="display: none;">'+
                                                        '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                        '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                    '</div>'+

                                                    '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                    '<div class="room rem">'+ data.names.room +'</div>'+
                                                    '<select id="showRooms" class="editForm" style="width: 50%;" hidden>'+
                                                        '<option value="'+ item.room_id +'" selected>'+ data.names.room +'</option>'
                                                    '<select>'+
                                                '</div>'+
                                            '</div>';

                        $('#monday').append(subjectWrapper);
                      }    

                      else if (item.day_of_week == 2) {
                        var subjectWrapper = '<div class="card card-schedule col-md-12 border-left-0 border-right-0 rounded-0 bg-light p-0" style="min-height: 140px;">'+
                                                '<a href="#" class="edit px-2 pink ml-auto" style="font-size: 12px;">Edit</a><a href="#" class="done px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a><a href="" class="saving px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<input id="sched-id" value="'+data.names.id+'" hidden>'+
                                                    '<input id="day" class="day1" value="1" hidden>'+
                                                    '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                    '<input id="program" class="" value="'+ data.names.program +'" hidden>'+
                                                    '<input id="semester" class="" value="'+ data.names.semester +'" hidden>'+

                                                    '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                        
                                                    '</select>'+

                                                    '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                    '<div class="course"> <b>'+ data.names.course +'</b> </div>'+
                                                    '<input id="teacher_id" value="'+data.names.teacher_id+'" hidden>'+
                                                    '<div class="teacher">'+ data.names.teacher +'</div>'+

                                                    '<div class="time rem">'+ time +'</div>'+
                                                    '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                    '<select id="notAvailableTime" class="time editForm" style="width: 80%; margin-bottom: 3px;" hidden>'+

                                                    '</select>'+
                                                    '<div class="timeHide" style="display: none;">'+
                                                        '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                        '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                    '</div>'+

                                                    '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                    '<div class="room rem">'+ data.names.room +'</div>'+
                                                    '<select id="showRooms" class="editForm" style="width: 50%;" hidden>'+
                                                        '<option value="'+ item.room_id +'" selected>'+ data.names.room +'</option>'
                                                    '<select>'+
                                                '</div>'+
                                            '</div>';

                        $('#tuesday').append(subjectWrapper);
                      }

                      else if (item.day_of_week == 3) {
                        var subjectWrapper = '<div class="card card-schedule col-md-12 border-left-0 border-right-0 rounded-0 bg-light p-0" style="min-height: 140px;">'+
                                                '<a href="#" class="edit px-2 pink ml-auto" style="font-size: 12px;">Edit</a><a href="#" class="done px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a><a href="" class="saving px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<input id="sched-id" value="'+data.names.id+'" hidden>'+
                                                    '<input id="day" class="day1" value="1" hidden>'+
                                                    '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                    '<input id="program" class="" value="'+ data.names.program +'" hidden>'+
                                                    '<input id="semester" class="" value="'+ data.names.semester +'" hidden>'+

                                                    '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                        
                                                    '</select>'+

                                                    '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                    '<div class="course"> <b>'+ data.names.course +'</b> </div>'+
                                                    '<input id="teacher_id" value="'+data.names.teacher_id+'" hidden>'+
                                                    '<div class="teacher">'+ data.names.teacher +'</div>'+

                                                    '<div class="time rem">'+ time +'</div>'+
                                                    '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                    '<select id="notAvailableTime" class="time editForm" style="width: 80%; margin-bottom: 3px;" hidden>'+

                                                    '</select>'+
                                                    '<div class="timeHide" style="display: none;">'+
                                                        '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                        '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                    '</div>'+

                                                    '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                    '<div class="room rem">'+ data.names.room +'</div>'+
                                                    '<select id="showRooms" class="editForm" style="width: 50%;" hidden>'+
                                                        '<option value="'+ item.room_id +'" selected>'+ data.names.room +'</option>'
                                                    '<select>'+
                                                '</div>'+
                                            '</div>';

                        $('#wednesday').append(subjectWrapper);
                      }

                      else if (item.day_of_week == 4) {
                        var subjectWrapper = '<div class="card card-schedule col-md-12 border-left-0 border-right-0 rounded-0 bg-light p-0" style="min-height: 140px;">'+
                                                '<a href="#" class="edit px-2 pink ml-auto" style="font-size: 12px;">Edit</a><a href="#" class="done px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a><a href="" class="saving px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<input id="sched-id" value="'+data.names.id+'" hidden>'+
                                                    '<input id="day" class="day1" value="1" hidden>'+
                                                    '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                    '<input id="program" class="" value="'+ data.names.program +'" hidden>'+
                                                    '<input id="semester" class="" value="'+ data.names.semester +'" hidden>'+

                                                    '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                        
                                                    '</select>'+

                                                    '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                    '<div class="course"> <b>'+ data.names.course +'</b> </div>'+
                                                    '<input id="teacher_id" value="'+data.names.teacher_id+'" hidden>'+
                                                    '<div class="teacher">'+ data.names.teacher +'</div>'+

                                                    '<div class="time rem">'+ time +'</div>'+
                                                    '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                    '<select id="notAvailableTime" class="time editForm" style="width: 80%; margin-bottom: 3px;" hidden>'+

                                                    '</select>'+
                                                    '<div class="timeHide" style="display: none;">'+
                                                        '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                        '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                    '</div>'+

                                                    '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                    '<div class="room rem">'+ data.names.room +'</div>'+
                                                    '<select id="showRooms" class="editForm" style="width: 50%;" hidden>'+
                                                        '<option value="'+ item.room_id +'" selected>'+ data.names.room +'</option>'
                                                    '<select>'+
                                                '</div>'+
                                            '</div>';

                        $('#thursday').append(subjectWrapper);
                      }

                      else if (item.day_of_week == 5) {
                        var subjectWrapper = '<div class="card card-schedule col-md-12 border-left-0 border-right-0 rounded-0 bg-light p-0" style="min-height: 140px;">'+
                                                '<a href="#" class="edit px-2 pink ml-auto" style="font-size: 12px;">Edit</a><a href="#" class="done px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a><a href="" class="saving px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<input id="sched-id" value="'+data.names.id+'" hidden>'+
                                                    '<input id="day" class="day1" value="1" hidden>'+
                                                    '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                    '<input id="program" class="" value="'+ data.names.program +'" hidden>'+
                                                    '<input id="semester" class="" value="'+ data.names.semester +'" hidden>'+

                                                    '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                        
                                                    '</select>'+

                                                    '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                    '<div class="course"> <b>'+ data.names.course +'</b> </div>'+
                                                    '<input id="teacher_id" value="'+data.names.teacher_id+'" hidden>'+
                                                    '<div class="teacher">'+ data.names.teacher +'</div>'+

                                                    '<div class="time rem">'+ time +'</div>'+
                                                    '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                    '<select id="notAvailableTime" class="time editForm" style="width: 80%; margin-bottom: 3px;" hidden>'+

                                                    '</select>'+
                                                    '<div class="timeHide" style="display: none;">'+
                                                        '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                        '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                    '</div>'+

                                                    '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                    '<div class="room rem">'+ data.names.room +'</div>'+
                                                    '<select id="showRooms" class="editForm" style="width: 50%;" hidden>'+
                                                        '<option value="'+ item.room_id +'" selected>'+ data.names.room +'</option>'
                                                    '<select>'+
                                                '</div>'+
                                            '</div>';

                        $('#friday').append(subjectWrapper);
                      }

                      else if (item.day_of_week == 6) {
                        var subjectWrapper = '<div class="card card-schedule col-md-12 border-left-0 border-right-0 rounded-0 bg-light p-0" style="min-height: 140px;">'+
                                                '<a href="#" class="edit px-2 pink ml-auto" style="font-size: 12px;">Edit</a><a href="#" class="done px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a><a href="" class="saving px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                                '<div class="card-body text-center" style="font-size: 13px">'+
                                                    '<input id="sched-id" value="'+data.names.id+'" hidden>'+
                                                    '<input id="day" class="day1" value="1" hidden>'+
                                                    '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                    '<input id="program" class="" value="'+ data.names.program +'" hidden>'+
                                                    '<input id="semester" class="" value="'+ data.names.semester +'" hidden>'+

                                                    '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                        
                                                    '</select>'+

                                                    '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                    '<div class="course"> <b>'+ data.names.course +'</b> </div>'+
                                                    '<input id="teacher_id" value="'+data.names.teacher_id+'" hidden>'+
                                                    '<div class="teacher">'+ data.names.teacher +'</div>'+

                                                    '<div class="time rem">'+ time +'</div>'+
                                                    '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                    '<select id="notAvailableTime" class="time editForm" style="width: 80%; margin-bottom: 3px;" hidden>'+

                                                    '</select>'+
                                                    '<div class="timeHide" style="display: none;">'+
                                                        '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                        '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                    '</div>'+

                                                    '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                    '<div class="room rem">'+ data.names.room +'</div>'+
                                                    '<select id="showRooms" class="editForm" style="width: 50%;" hidden>'+
                                                        '<option value="'+ item.room_id +'" selected>'+ data.names.room +'</option>'
                                                    '<select>'+
                                                '</div>'+
                                            '</div>';

                        $('#saturday').append(subjectWrapper);
                      }
                    }); // POST FUNCTION
                }); // END OF FOREACH
            }

            $(document).find('.card-schedule').hover(function() {
                $(this).hide();
            });


            // xxedit
            var seldayCounter = 0;
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();

                // Hide all edits btn to prevent errors
                $(document).find('.edit').each(function(index, el) {
                    $(this).attr('hidden', true);
                });

                // show selection bar for available days
                $(this).siblings('.card-body').find('#selectDay').prop('hidden', false);
                $(this).siblings('.card-body').find('#selectDay').show();
                $(this).siblings('.card-body').find('.timeHide').css("display", "block");

                // Hide the edit button and show Done button
                $(this).hide('fast');
                $(this).siblings('.done').attr('hidden', false);
                $(this).siblings('.done').show();

                // HIDES TEXT BOX
                $(this).siblings('.card-body').find('.rem').each(function() {
                    $(this).hide();
                });

                // SHOW INPUT BOX
                $(this).siblings('.card-body').find('.editForm').each(function(index, el) {
                    $(this).prop('hidden', false);
                });
                $(this).siblings('.card-body').find('.editForm').each(function(index, el) {
                    $(this).show();
                });

                $(this).parent('.card-schedule').each(function() {
                    var teacher = $(this).find('#teacher_id').val();
                    var selday = $(this).find('#selectDay');
                    var selrooms = $(this).find('#showRooms');
                    var selnotavaitime = $(this).find('#notAvailableTime');
                    var currday = $(this).find('#day').val();
                    var time1 = $(this).find('.time1');

                    // program_id, course_id, semester_id, academic_year_id xxhere
                    var program_id = $(this).find('#program').val();
                    var course_id = $(this).find('#course_id').val();
                    var semester = $(this).find('#semester').val();
                    var ay = $(this).find('#ay_id').val();
                    var room = $(this).find('#room').val();
                    var currTime = $(this).find('#currTime').val();

                    
                    

                    $.post('/getAvailableDays', {
                        program_id: program_id,
                        course_id: course_id,
                        semester: semester,
                        ay: ay,
                        teacher: teacher,
                        '_token': $('input[name=_token]').val(),
                    }, function(data, status) {
                        var day = "nothing";

                        if (seldayCounter == 0) {

                            var fillDay = [];

                            data.selected_day.forEach(function(item) {
                                var day = item.day_of_week;
                                fillDay.push(day);
                            });

                            var filldayCounter = 0
                            // give teacher available days
                            data.available_day.forEach(function(item) {
                                var selected = "";

                                if (currday != item.available_day) {
                                    if (item.available_day == 1) {
                                        day = 'Monday';
                                    }
                                    else if (item.available_day == 2) {
                                        day = 'Tuesday';
                                    }
                                    else if (item.available_day == 3) {
                                        day = 'Wednesday';
                                    }
                                    else if (item.available_day == 4) {
                                        day = 'Thursday';
                                    }
                                    else if (item.available_day == 5) {
                                        day = 'Friday';
                                    }
                                    else if (item.available_day == 6) {
                                        day = 'Saturday';
                                    }
                                } else {
                                    if (currday == 1) {
                                        day = 'Monday';
                                        selected = 'selected="true"';
                                    }
                                    else if (currday == 2) {
                                        day = 'Tuesday';
                                        selected = 'selected="true"';
                                    }
                                    else if (currday == 3) {
                                        day = 'Wednesday';
                                        selected = 'selected="true"';
                                    }
                                    else if (currday == 4) {
                                        day = 'Thursday';
                                        selected = 'selected="true"';
                                    }
                                    else if (currday == 5) {
                                        day = 'Friday';
                                        selected = 'selected="true"';
                                    }
                                    else if (currday== 6) {
                                        day = 'Saturday';
                                        selected = 'selected="true"';
                                    }
                                }

                                for (var i=0; i<fillDay.length; i++) {

                                    if (fillDay[i] == item.available_day) {
                                        var bg = 'bg-danger';
                                        var text = 'text-light';
                                    }

                                }
                                
                                selday.append('<option class="'+ bg +' '+ text +'" value="'+item.available_day+'" '+selected+'>'+ day +'</option>');
                            });

                            seldayCounter++;
                        }

                    }, "json");


                    // needs are ay, semester, rooms, current_time, levels
                    $.post('/getTimeNotAvailable', {

                        ay: ay,
                        semester: semester,
                        room: room,
                        current_day: currday,
                        currTime: currTime,
                        '_token': $('input[name=_token]').val(),

                    }, function(data, textStatus, xhr) {

                        if (data.unavailableTime != 0) {
                            // xxhere selnotavaitime
                            data.unavailableTime.forEach(function (item) {
                                var time = item.time_start + ' - ' + item.time_finish;

                                selnotavaitime.append('<option class="text-center bg-warning">'+ time +'</option>')
                            });

                            roomChanges(ay, semester, currday, currTime)
                            currTime = currTime.split('-');
                            total_hours_per_day = currTime[1] - currTime[0];

                            editTime(total_hours_per_day)

                        } else {
                            // var message = "All time is available in  this room";
                            // mes(message) xxheres
                            roomChanges(ay, semester, currday, currTime)
                        }
                        
                        if (data.rooms != 0) {

                            data.rooms.forEach(function(item) {
                                selrooms.append('<option value="'+ item.id +'">'+ item.room_name +'</option>');
                            });

                        }
                        

                    });

                    storeCurrDay();
                    changeAvailableDay();

                });
            });

            
            $(document).on('click', '.saving', function(e) {
                e.preventDefault();

                var id = $(this).parents('.card-schedule').find('#sched-id').val();
                var room = $(this).parents('.card-schedule').find('#showRooms').val();
                var start_time = $(this).parents('.card-schedule').find('.time1').val();
                var end_time = $(this).parents('.card-schedule').find('.time2').val();


                $.ajax({
                    url: '/customized-card/save',
                    type: 'POST',
                    data: {
                        id: id,
                        '_token': $('input[name=_token]').val(),
                        room: room,
                        start_time: start_time,
                        end_time: end_time,
                    },
                    success: function(data) {
                        $(document).find('#monday').empty();
                        $(document).find('#tuesday').empty();
                        $(document).find('#wednesday').empty();
                        $(document).find('#thursday').empty();
                        $(document).find('#friday').empty();
                        $(document).find('#saturday').empty();
                        // xxhere
                        getGeneratedSchedule()
                    }
                });
                
            });

            $(document).on('click', '.done', function(event) {
                event.preventDefault();
                
                // Show all edits again
                $(document).find('.edit').each(function(index, el) {
                    $(this).attr('hidden', false);
                });

                $(this).hide();
                $(this).siblings('.edit').show();
                $(document).find('.rem').each(function(index, el) {
                    $(this).show();
                });


                // Hide all the selector
                $(document).find('select').hide();
                $(document).find('.timeHide').hide();
                $(this).siblings('.card-body').find('#currTime').show();



                // Empty the selector
                // xx be more specific cause all the select tag will be empty. Use class i guess
                $(document).find('select').empty();

                seldayCounter--;
                // filldayCounter--;
            });
            

            var editTime = function(totalTime) {
                $(document).on('keyup', '.time1', function() {
                    var time1 = $(this).val();
                    var time2 = $(this).siblings('.time2');

                    // SAVE BTN WILL APPEAR THEN HIDE THE DONE BTN
                    $(this).parents('.card-schedule').find('.done').hide('fast');
                    $(this).parents('.card-schedule').find('.saving').attr('hidden', false);

                    time1 = parseInt(time1) + parseInt(totalTime);
                    time2.val(time1);
                });
            }

            var roomChanges = function(ay, sem, day, currTime) {
                $(document).on('change', '#showRooms', function(){
                    var selectedRoom = $(this).val();
                    var selnotavaitime = $(this).siblings('#notAvailableTime');
                    $(this).parents('.card-schedule').find('.done').hide('fast');
                    $(this).parents('.card-schedule').find('.saving').attr('hidden', false);


                    $.ajax({
                        url: '/search/roomUnavailableTime',
                        type: 'GET',
                        data: {
                            ay: ay,
                            sem: sem,
                            day: day,
                            room: selectedRoom,
                            curtime: currTime,
                        },
                        success: function(data) {
                            selnotavaitime.empty();

                            console.log(data);


                            data.forEach(function(item) {
                                var time = item.time_start + ' - ' + item.time_finish;

                                selnotavaitime.append('<option class="text-center bg-warning">'+ time +'</option>');
                            });
                            // data.forEach(function(item) {
                            //     var time = item.time_start + ' - ' + item.time_finish;

                            //     selnotavaitime.append('<option class="text-center bg-warning">'+ time +'</option>')
                            // });
                        }
                    });
                    
                    
                });
            }

            var storeCurrDayCount = 0
            var storeCurrDay = function(e) {
                $(document).on('click', '.selectDay', function() {
                    
                    if (storeCurrDayCount == 0) {
                        var currDay = $(this).val();
                        setCurrDay(currDay)
                        storeCurrDayCount++;
                    }

                });
            }

            var setCurrDay = function(currDay) {
                currentDay = currDay;
            }

            var changeAvailableDay = function() {
                $(document).find('.selectDay').each(function(index, el) {
                    $(this).change(function() {

                        var data = $(this).val();
                        var id = $(this).parents('.card-schedule').find('#sched-id').val();

                        $.post('/saveChanges', {
                            current_day: currentDay,
                            day: data,
                            id: id,
                            '_token': $('input[name=_token]').val(),
                        }, function(data, status) {

                            $(document).find('.card-schedule').each(function(index, el) {
                               $(this).remove();     
                            });

                            getGeneratedSchedule()
                            storeCurrDayCount--;
                            seldayCounter--;
                        });

                    });
                });
            }

            var mes = function(data = null) {
                if (data == null) {
                    alert('me');
                } else {
                    alert(data);
                }
            }


        });


    </script>

    <style type="text/css">
        .card-schedule > .edit {
            display: none;
        }
        .card-schedule:hover .edit {
            display: block;
        }
    </style>

    @csrf
    <div class="container">
        <div class="row">
            <button class="btn btn-primary ml-auto mb-3">Generate Schedule</button>

            <div class="card col-md-12 mx-auto mb-3">
                <div class="row">


                    <div class="col-md-2 card rounded-0">

                        <div class="row">
                            <div class="card-header col-md-12 text-center">
                                Monday
                            </div>
                        </div>

                        <div id="monday" class="row pt-3">



                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="row">
                            <div class="card-header col-md-12 text-center">
                                Tuesday
                            </div>
                        </div>

                        <div id="tuesday" class="row pt-3">



                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="row">
                            <div class="card-header col-md-12 text-center">
                                Wednesday
                            </div>
                        </div>

                        <div id="wednesday" class="row pt-3">



                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="row">
                            <div class="card-header col-md-12 text-center">
                                Thursday
                            </div>
                        </div>

                        <div id="thursday" class="row pt-3">



                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="row">
                            <div class="card-header col-md-12 text-center">
                                Friday
                            </div>
                        </div>

                        <div id="friday" class="row pt-3">



                        </div>
                    </div>
                    <div class="col-md-2 card rounded-0">

                        <div class="row">
                            <div class="card-header col-md-12 text-center">
                                Saturday
                            </div>
                        </div>

                        <div id="saturday" class="row pt-3">

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>




@endsection
