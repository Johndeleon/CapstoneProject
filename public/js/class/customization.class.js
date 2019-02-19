var customizationMaintenance = function() {

    var currentDay;
    var datas;

    var data = window.localStorage["programs"];
    data = $.parseJSON(data);
    var academic_year = data[0].academic_year_id;
    var semester = data[0].semester;
    var program_id = data[0].program_id;
    var level = data[0].level;

    var mes = function(data=null) {
        if (data != null) {
            alert(data);
            console.log(data);

        } else {
            alert('me');

        }
    }

    var generateSchedules = function() {
        $(document).one('click', '#gen-btn', function(event) {
            event.preventDefault();
            
            $(this).hide();
            $(document).find('.save-schedule-wrapper').attr('hidden', false);

            $.ajax({
                type: 'GET',
                url: '/admin/customize-schedules/get-data',
                data: {
                    academic_year: academic_year,
                    semester: semester,
                    id: program_id,
                    '_token': $('input[name=_token]').val(),
                },
                cache: false,
                dataType: 'json',
                success: function(data) {

                    $(document).find('.emptimize').each(function(index, el) {
                        $(this).empty();
                    });

                    showInitialSchedule(data);

                }
            });

        });
    }

    var generateSchedules1 = function() {
        $.ajax({
            type: 'GET',
            url: '/admin/customize-schedules/get-data',
            data: {
                academic_year: academic_year,
                semester: semester,
                id: program_id,
                '_token': $('input[name=_token]').val(),
            },
            cache: false,
            dataType: 'json',
            success: function(data) {

                $(document).find('.emptimize').each(function(index, el) {
                    $(this).empty();
                });

                showInitialSchedule(data);

            }
        });
    }

    var showInitialSchedule = function(data) {

        var sortedData = data.sort(function(obj1, obj2) {
            return obj1.time_start - obj2.time_start;
        });

        $.each(sortedData ,function(index, item) {

            var time = item.time_start + ' - ' + item.time_finish;
            
            $.ajax({
                type: 'GET',
                url: '/admin/customize-schedules/get-teacher-course',
                data: {
                    c_id: item.course_id,
                    t_id: item.teacher_id,
                    r_id: item.room_id,
                    '_token': $('input[name=_token]').val(), 
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    
                    var subjectWrapper = '<div class="card ct-card-sched-1 card-schedule position-relative col-md-12  rounded-0 bg-light p-0" style="min-height: 140px; margin-bottom: 2px;">'+
                                            // '<a href="#" class="edit inner-btn px-2 pink ml-auto" style="font-size: 12px;">Edit</a>'+
                                            // '<a href="#" class="done inner-btn px-2 pink ml-auto" style="font-size: 12px;" hidden>Done</a>'+
                                            // '<a href="" class="saving inner-btn px-2 pink ml-auto" style="font-size: 12px;" hidden>Save</a>'+
                                            '<a href="" class="edit inner-btn mr-1 mt-1 btn btn-circle bg-blue" title="Edit">'+
                                                '<i class="fa fa-pencil" aria-hidden="true"></i>'+
                                            '</a>'+
                                            '<a href="" class="save inner-btn mr-1 mt-1 btn btn-circle bg-blue" title="Save" hidden>'+
                                                '<i class="fa fa-save" aria-hidden="true"></i>'+
                                            '</a>'+
                                            '<a href="" class="back inner-btn mr-1 mt-1 btn btn-circle bg-blue" title="Back" hidden>'+
                                                '<i class="fa fa-arrow-left" aria-hidden="true"></i>'+
                                            '</a>'+
                                            '<div class="card-body text-center" style="font-size: 13px">'+
                                                '<input id="sched-id" value="'+ item.id +'" hidden>'+
                                                '<input id="day" class="day1" value="1" hidden>'+
                                                '<input id="ay_id" class="ay" value="'+ item.academic_year_id +'" hidden>'+
                                                '<input id="program" class="" value="'+ item.program_id +'" hidden>'+
                                                '<input id="semester" class="" value="'+ item.semester +'" hidden>'+

                                                '<select class="editForm selectDay" id="selectDay" hidden>'+
                                                    
                                                '</select>'+

                                                '<input id="course_id" value="'+ item.course_id +'" hidden>'+
                                                '<div class="course"> <b>'+ data.title +'</b> </div>'+
                                                '<input id="teacher_id" value="'+ item.teacher_id +'" hidden>'+
                                                '<div class="teacher">'+ data.teacher +'</div>'+

                                                '<div class="time rem">'+ time +'</div>'+
                                                '<input id="currTime" value="'+ item.time_start+'-'+ item.time_finish +'" hidden>'+
                                                '<select id="notAvailableTime" class="time editForm"  title="This are not the available time in this room." style="width: 60%; margin-bottom: 3px;" hidden>'+

                                                '</select>'+

                                                '<div class="row mb-1 editForm1" hidden>'+
                                                    '<input type="text" class="time time1 col-md-5 mx-auto" maxlength="4" placeholder="'+ item.time_start +'" value="'+ item.time_start +'">'+
                                                    '<input type="text" class="time time2 col-md-5 mx-auto" placeholder="'+ item.time_finish +'" value="'+ item.time_finish +'" disabled>'+
                                                '</div>'+

                                                // '<div class="timeHide editForm" style="display: none;">'+
                                                //     '<input class="time editForm time1" value="'+ item.time_start +'" style="width: 45%; margin-bottom: 3px"> - '+
                                                //     '<input class="time editForm time2" value="'+ item.time_finish +'" style="width: 45%;" disabled>'+
                                                // '</div>'+

                                                '<input id="room" value="'+ item.room_id +'" hidden>'+
                                                '<div class="room rem">'+ data.room +'</div>'+
                                                '<select id="showRooms" class="editForm" style="width: 60%;" hidden>'+
                                                    '<option class="bg-red" value="'+ item.room_id +'" selected>'+ data.room +'</option>'
                                                '<select>'+
                                            '</div>'+
                                        '</div>';

                    if (item.day_of_week == 1) {
                        $('#monday-1').append(subjectWrapper);

                    } else if (item.day_of_week == 2) {
                        $('#tuesday-2').append(subjectWrapper);

                    } else if (item.day_of_week == 3) {
                        $('#wednesday-3').append(subjectWrapper);

                    } else if (item.day_of_week == 4) {
                        $('#thursday-4').append(subjectWrapper);

                    } else if (item.day_of_week == 5) {
                        $('#friday-5').append(subjectWrapper);

                    } else if (item.day_of_week == 6) {
                        $('#saturday-6').append(subjectWrapper);

                    }

                }
            });

        });
    }










    var clickEditBtn = function() {
        $(document).on('click', '.edit', function(event) {
            event.preventDefault();
            var parent = $(this).parent('.card-schedule');
            var parent_day = parent.parent().attr('id');
            var t_id = parent.find('#teacher_id').val();

            // Hide all edit btn
            $(document).find('.edit').attr('hidden', true);

            // Show save button
            $(this).siblings('.back').removeAttr('hidden');
            $(this).siblings('.back').addClass('back-show');

            parent.find('.rem').each(function(index, el) {
               $(this).hide(); 
            });

            getAvailableDays(t_id, parent, parent_day)
            // setTimeout(getAvailableDays, 3000, t_id, parent, parent_day)
            
            setTimeout(getAvailableRooms, 1500, parent)
            var currRoom = parent.find('#showRooms').val();

            setTimeout(roomUnavailableTime, 1500, currRoom, parent_day, parent);

            var time1 = parseInt(parent.find('.time1').val());
            var time2 = parseInt(parent.find('.time2').val());
            var total = (time2 - time1);
            setTimeout(changeTime, 500, parent, total);
            


            parent.find('.editForm').each(function(index, el) {
                $(this).attr('hidden', false);
            });

            parent.find('.editForm1').each(function(index, el) {
                $(this).attr('hidden', false);
            });


            clickBack(parent)
            ifChange()

        });
    }

    var getAvailableDays = function(id, parent, parent_day) {
        if (id != null || id != '') {
            $.ajax({
                type: 'GET',
                url: '/admin/customize-schedules/teacher-available-day',
                data: {
                    id: id,
                    '_token': $('input[name=_token]').val(),
                },
                cache: false,
                dataType: 'json',
                success: function(data) {

                    parent_day = parent_day.split('-');
                    
                    // Give value in id=selectDay
                    $.each(data.available_day, function(index, val) {
                        
                        if (val.available_day == 1) {
                            var day = 'Monday';

                            if (val.available_day == parent_day[1]) {
                                var attr = 'selected';
                            }

                        } else if (val.available_day == 2) {
                            var day = 'Tuesday';

                            if (val.available_day == parent_day[1]) {
                                var attr = 'selected';
                            }

                        } else if (val.available_day == 3) {
                            var day = 'Wednesday';

                            if (val.available_day == parent_day[1]) {
                                var attr = 'selected';
                            }
                            
                        } else if (val.available_day == 4) {
                            var day = 'Thursday';

                            if (val.available_day == parent_day[1]) {
                                var attr = 'selected';
                            }
                            
                        } else if (val.available_day == 5) {
                            var day = 'Friday';

                            if (val.available_day == parent_day[1]) {
                                var attr = 'selected';
                            }
                            
                        } else if (val.available_day == 6) {
                            var day = 'Saturday';

                            if (val.available_day == parent_day[1]) {
                                var attr = 'selected';
                            }
                            
                        }

                        var bg;
                        $.each(data.assigned_day ,function(index, el) {
                            if (val.available_day == el.day_of_week) {
                                bg = 'class="bg-red"';
                            }
                        });

                        parent.find('#selectDay').append('<option '+ bg +' value="'+ val.available_day +'" '+ attr +'> '+ day +' </option>')

                    });
                    

                }
            });

        }
    }

    var getAvailableRooms = function(parent) {
        $.ajax({
            type: 'GET',
            url: '/admin/customize-schedules/get-rooms',
            data: {
                '_token': $('input[name=_token]').val(),
            },
            cache: false,
            dataType: 'json',
            success: function(data) {

                $.each(data, function(index, el) {
                    parent.find('#showRooms').append('<option value="'+ el.id +'"> '+ el.room_name +' </option>')
                });

            }
        });

    }

    // This will send a request of unvailability of this room by taking all the subject in that day in that room
    var roomUnavailableTime = function(data=null, parent_day=null, parent=null) {
        var ay = $(document).find('#ay_id').val();
        var sem = $(document).find('#semester').val();

        if (data != null) {
            var day = parent_day.split('-');
            var id = parent.find('#sched-id').val();

            // The data must be inserted or added in #notAvailableTime
            $.ajax({
                type: 'GET',
                url: '/admin/customize-schedules/get-unavailable-time',
                data: {
                    sched_id: id,
                    room: data,
                    day: day[1],
                    ay: ay,
                    sem: sem,
                    _token: $('input[name=_token]').val(),
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    parent.find('#notAvailableTime').empty();

                    $.each(data, function(index, val) {
                        parent.find('#notAvailableTime').append('<option value="'+ val.id +'"> '+ val.time_start +' - '+ val.time_finish +' </option>')
                        
                    });

                }
            });

        } else {
            $(document).on('change', '#showRooms', function(event) {
                event.preventDefault();
                var parent = $(this).parents('.card-schedule');

                var ay = $(document).find('#ay_id').val();
                var sem = $(document).find('#semester').val();
                var room = $(this).val();
                var day = parent.parent().attr('id').split('-');
                var id = parent.find('#sched-id').val();

                $.ajax({
                    type: 'GET',
                    url: '/admin/customize-schedules/get-unavailable-time',
                    data: {
                        sched_id: id,
                        room: room,
                        day: day[1],
                        ay: ay,
                        sem: sem,
                        _token: $('input[name=_token]').val(),
                    },
                    cache: false,
                    dataType: 'json',
                    success: function(data) {
                        parent.find('#notAvailableTime').empty();

                        $.each(data, function(index, val) {
                            parent.find('#notAvailableTime').append('<option value="'+ val.id +'"> '+ val.time_start +' - '+ val.time_finish +' </option>')
                            
                        });

                    }
                });


            });

        }

    }

    var changeTime = function(parent, total) {
        parent.find('.time').keyup(function(event) {

            var time1 = parseInt($(this).val());
            var time = (time1 + total);
            $(this).siblings('.time2').val(time);

        });
    }

    var clickSave = function() {
        $(document).on('click', '.save', function(event) {
            event.preventDefault();
            var parent = $(this).parent('.card-schedule');
            var ay = parent.find('#ay_id').val();
            var sem = parent.find('#semester').val();
            var id = parent.find('#sched-id').val();
            var day = parent.find('#selectDay').val();
            var time_start = parent.find('.time1').val();
            var time_finish = parent.find('.time2').val();
            var room = parent.find('#showRooms').val();

            $.ajax({
                type: 'POST',
                url: '/admin/customize-schedules/save-changes',
                data: {
                    ay: ay,
                    sem: sem,
                    id: id,
                    day: day,
                    time_start: time_start,
                    time_finish: time_finish,
                    room: room, 
                    _token: $('input[name=_token]').val(),
                },
                cache: false,
                dataType: 'json',
                success: function(data) {

                    if (data == true) {
                        generateSchedules1()

                    } else if (data.status == false) {
                        bootbox.alert('<div> '+ data.errors +' </div>');
                    }
                    
                }
            });
            
        });
    }

    var clickBack = function(parent) {
        $(document).on('click', '.back', function(event) {
            event.preventDefault();
            
            // Hide the btn
            $(this).attr('hidden', true);
            $(this).removeClass('show-back');

            // Show the hidden inputs
            parent.find('.rem').each(function(index, el) {
                $(this).show();
            });

            // Hide the inputs and empty it
            parent.find('.editForm').each(function(index, el) {
                $(this).empty();
                $(this).attr('hidden', true);
            });

            parent.find('.editForm1').each(function(index, el) {
                $(this).attr('hidden', true);
            });

            // Show edit btn again
            $(document).find('.edit').attr('hidden', false);

        });
    }

    var ifChange = function() {
        $(document).on('keyup', '.editForm', function(event) {
            event.preventDefault();
            var parent = $(this).parents('.card-schedule');
            
            parent.find('.back').hide();
            parent.find('.save').removeAttr('hidden');
            parent.find('.save').addClass('save-show');

        });

        $(document).on('change', '.editForm', function(event) {
            event.preventDefault();
            var parent = $(this).parents('.card-schedule');
            
            parent.find('.back').hide();
            parent.find('.save').removeAttr('hidden');
            parent.find('.save').addClass('save-show');

        });
    }

    var deleteWholeSchedule = function() {
        $(document).on('click', '#deleteSched', function(event) {
            event.preventDefault();
            
            bootbox.confirm("<div> <b class='text-danger'> Warning: You've click the cancel button.</b> <p></p> <p> This will automatically delete all the schedule data (in a specific program) stored in your system. Do you want to proceed in your action? </p> </div>", function(e) {

                if (e) {

                    var id = $(document).find('#sched-id').val();
                    
                    $.ajax({
                        type: 'GET',
                        url: '/admin/customize-schedules/cancel',
                        data: {
                            id: id,
                            '_token': $('input[name=_token]').val(),
                        },
                        dataType: 'json',
                        success: function(data) {

                            if (data.status) {
                                bootbox.alert('<div> '+ data.message +' </div>');

                                setTimeout(window.close, 3000);
                            }

                        }
                    });

                }

            });

        });
    }

    var saveSched = function() {
        $(document).on('click', '#saveSched', function(event) {
            event.preventDefault();

            bootbox.confirm('<div> <b>Do you want to store this schedule?</b> </div>', function(e) {
                if (e) {
                    $.ajax({
                        type: 'GET',
                        url: '/admin/customize-schedules/fixed-schedule',
                        data: {
                            ay: academic_year,
                            sem: semester,
                            id: program_id,
                            lev: level,
                            _token: $('input[name=_token]').val(),
                        },
                        cache: false,
                        dataType: 'json',
                        success: function(data) {
                            mes(data)
                        }
                    });

                    bootbox.alert('The schedule successfully saved! Redirect to home for viewing. . .');

                    // setTimeout(window.close, 2000);
                }

            });
            
        });
    }


    return {
        init: function() {
            generateSchedules()

            clickEditBtn()
            clickSave()
            roomUnavailableTime()
            deleteWholeSchedule()
            saveSched()
        }
    }
}();