var dashboardMaintenance = function() {

	var mes = function(data=null) {
		if (data != null) {
			alert(data);
			console.log(data);

		} else {
			alert('me');
		}

	}

	var showLevels = function() {
		var ay = $('#ay').val();
		var sem = $('#sem').val();

		$.ajax({
			type: 'GET',
			url: '/admin/dashboard/get-levels',
			data: {
				ay_id: ay,
				sem: sem,
				'_token': $('input[name=_token]').val(),
			},
			cache: false,
			dataType: 'json',
			success: function(data) {
				// Empty first
				$('.currSched').each(function(index, el) {
					$(this).empty();
				});

				if (data.status == true) {
					

					$.each(data.schedule, function(index, val) {
						var ids = val.split('-');
						var prog_id = ids[0];
						var lev = ids[1];
						
						$(document).find('.program-title').each(function() {
							var title = $(this).text().trim(' ');

							if (prog_id == $(this).attr('id')) {
								var child = $(this).siblings('#schedules-level');

								child.append('<a href="#viewSchedule" class="view-sched ml-2 btn btn-info btn-circle" id="'+ prog_id + '-' + lev +'" data-toggle="modal" data-backdrop="static" data-keyboard="false"> ' + lev +' </a>');
							}
							
						});

					});

				}
				
			}
		});

	}

	var viewSchedule = function() {
		$(document).on('click', '.view-sched', function(event) {
			event.preventDefault();
			var ids = $(this).attr('id').split('-');
			var parent = $(this).parent();
			var title = parent.siblings('.program-title').text().trim(' ');

			$('#sc_prog_title').text( title + ' "' + ids[1] + '" Schedule');
			
			$.ajax({
				type: 'GET',
				url: '/admin/dashboard/get-course-schedule',
				data: {
					id: ids[0],
					level: ids[1],
					_token: $('input[name=_token]').val(),
				},
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$(document).find('.emptimize').each(function(index, el) {
							$(this).empty();
						});

						var sortedData = data.schedule.sort(function(obj1, obj2) {
						    return obj1.time_start - obj2.time_start;
						});

						$.each(sortedData, function(index, item) {
							var teacher = item.teacher_id;
							var room = item.room_id;

							$.ajax({
								type: 'GET',
								url: '/admin/dashboard/real-name-data',
								data: {
									room_id: room,
									teacher_id: teacher,
									course_id: item.course_id,
									'_token': $('input[name=_token]').val(),
								},
								cache: false,
								dataType: 'json',
								success: function(data) {

									var subjectWrapper = '<div class="card ct-card-sched-1 text-center card-schedule position-relative col-md-12  rounded-0 bg-light p-0" style="min-height: 160px; max-height: 160px; margin-bottom: 2px;">'+
									                         
									                         '<div class="data-wrapper">'+
									                         	'<div><b> '+ data.course +' </b></div>'+
									                         	'<div>'+ data.teacher +'</div>'+
									                         	'<div>'+ item.time_start + ' - ' + item.time_finish +'</div>'+
									                         	'<div>'+ data.room +'</div>'+
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

				}
			});

		});
	}

	var getNameData = function(teacher, room) {

		if (teacher != null && room !=null) {
			$.ajax({
				type: 'GET',
				url: '/admin/dashboard/real-name-data',
				data: {
					room_id: room,
					teacher_id: teacher,
					'_token': $('input[name=_token]').val(),
				},
				cache: false,
				dataType: 'json',
				success: function(data) {
					return data;
				}
			});

		}

	}

	var expandCounter = 1;
	var expandAcademicSection = function() {
		$(document).on('click', '.sidebar-toggle', function(event) {
			event.preventDefault();
			
			if (expandCounter == 1) {
				$('.ay-section').animate({
					width: '25rem',
				}, 'slow');

				expandCounter++;
			} else if (expandCounter == 2) {
				$('.ay-section').animate({
					width: '19rem',
				}, 'fast');

				expandCounter--;
			}

			
		});
	}

	var addAcademicYear = function() {
		$(document).on('keyup', '#year-start', function(event) {
			event.preventDefault();
			var val = parseInt($(this).val());
			var total = parseInt(val + 1);

			$('#year-end').val(total);

		});
	}

	var storeAcadYear = function() {
		$(document).on('submit', '#storeAcadYear', function(event) {
			event.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: '/admin/dashboard/store-data',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {
					
					if (data.status == true) {
						$('#addAcadYr').modal('hide');
						$('.a_empty').each(function(index, el) {
							$(this).val('');
						});
						bootbox.alert('<div> '+ data.message +' </div>');

						if ($('#ay').val() == null || $('#ay').val() == '') {
							$('#ay').empty();

							$(document).find('#ay').prepend('<option value="'+ data.id +'">'+ data.academic_title +'</option>');

						} else {
							$(document).find('#ay').prepend('<option value="'+ data.id +'">'+ data.academic_title +'</option>');

						}

					} else if (data.status == false) {
						$('.alert').empty();

						$('.alert').attr('hidden', false);

						$.each(data.errors, function(index, el) {
							errors(el)
						});

					}

				}
			});
		});
	}

	var errors = function(error) {
		$('.alert').each(function(index, el) {
			$(this).append('<small class="info-small text-light"> <i class="fa fa-warning" aria-hidden="true"></i> &nbsp'+ error +'</small> <br>');
		});
	}

	var changeAY = function() {
		$(document).on('submit', '#changeAY', function(event) {
			event.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: '/admin/dashboard/get-active-ay',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {
					if (data.status == true) {
						bootbox.alert('<div> The Academic year is successfully changed. <p></p> <p> Please wait to reload the programs.</p> </div>');

						location.reload();

					}
					
				}
			});

		});
	}

	var enChangeAYCounter = 0;
	var enChangeAY = function() {
		$(document).on('change', '.sel-ay-enBtn', function(event) {
			event.preventDefault();
			
			$('.sel-ay-enBtn').each(function(index, el) {
				
				if ($(this).val() != 'not null' && $(this).val() != null) {
					enChangeAYCounter++

					if (enChangeAYCounter == 2) {
						$('#f_data').attr('disabled', false);
					}


				} else {
					enChangeAYCounter--;
				}
			});

				enChangeAYCounter = 0;
		});
	}


	


	return {
		init: function() {
			setTimeout(showLevels, 3000)

			changeAY()
			enChangeAY()

			viewSchedule()
			expandAcademicSection()
			addAcademicYear()
			storeAcadYear()
		}
	}
}();