var dashboardMaintenance = function() {

	var mes = function(data=null) {
		if (data != null) {
			alert(data);
			console.log(data);

		} else {
			alert('me');
		}

	}

	var showExistingLevels = function() {

		$(document).on('click', '.viewLevels', function(event) {
			event.preventDefault();
			var ay = $(document).find('#ay').val();
			var sem = $(document).find('#sem').val();
			var id = $(this).attr('id').split('-');

			$.ajax({
				type: 'get',
				url: '/admin/dashboard/get-course-level',
				data: {
					id: id[1],
					ay: ay,
					sem: sem,
					_token: $('input[name=_token]').val(),
				},
				dataType: 'json',
				success: function(data) {
					console.log(data);
					if (data.status == true) {
						
						$(document).find('#item-container').empty();

						for (i = 0; i < data.level; i++) {

							if ((i+1) == data.levelWithSched[i]) {
								var container = $(document).find('#item-container');
								var button = '<button id="'+ ay +'-'+ sem +'-'+ id[1] +'-'+ (i+1) +'" class="btn btn-primary form-control rounded-0 py-2 mb-2 showSchedule" title="Click to view the schedule"> '+ (i+1) +' </button>';

								container.append(button);
							} else {
								var container = $(document).find('#item-container');
								var button = '<button class="btn btn-primary form-control rounded-0 py-2 mb-2" title="No existing schedule" disabled> '+ (i+1) +' </button>';

								container.append(button);
							}

						}

					}

				}
			});
		});
	}

	var showSchedule = function() {
		$(document).on('click', '.showSchedule', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');

			/* Empty the schedule wrapper */
			$(document).find('#schedule-wrapper').empty();

			$.ajax({
				type: 'GET',
				url: '/admin/dashboard/get-title',
				data: {
					ay: id[0],
					program: id[2],
				},
				dataType: 'json',
				success: function(data) {
					if (data.status == true) {

						if (id[1] == 1) {
							var semHtml = '<span>'+id[1]+'st Semester</span> <br>';

						} else if (id[1] == 2) {
							var semHtml = '<span>'+id[1]+'nd Semester</span> <br>';

						}

						var scheduleTemplate = '<div class="c_title text-center mt-1 mb-1">'+
							                        '<span>Academic Year: <b> '+ data.academic_year +' </b> </span> <br>'+
													semHtml +						                        
							                        '<span>'+ data.program_name +' '+id[3]+'</span>'+
							                    '</div>'+

												'<div class="row mx-1">'+
													'<div class="card col-md-2 rounded-0">'+
							                            '<div class="row">'+
							                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
							                                    'Monday'+
							                                '</div>'+
							                            '</div>'+

							                            '<div id="monday-1" class="row emptimize">'+
							                                
							                            '</div>'+

							                        '</div>'+

							                        '<div class="card col-md-2 rounded-0">'+
							                            '<div class="row">'+
							                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
							                                    'Tuesday'+
							                                '</div>'+
							                            '</div>'+

							                            '<div id="tuesday-2" class="row emptimize">'+
							                                
							                            '</div>'+

							                        '</div>'+

							                        '<div class="card col-md-2 rounded-0">'+
							                            '<div class="row">'+
							                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
							                                    'Wednesday'+
							                                '</div>'+
							                            '</div>'+

							                            '<div id="wednesday-3" class="row emptimize">'+
							                                
							                            '</div>'+

							                        '</div>'+

							                        '<div class="card col-md-2 rounded-0">'+
							                            '<div class="row">'+
							                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
							                                    'Thursday'+
							                                '</div>'+
							                            '</div>'+

							                            '<div id="thursday-4" class="row emptimize">'+
							                                
							                            '</div>'+

							                        '</div>'+

							                        '<div class="card col-md-2 rounded-0">'+
							                            '<div class="row">'+
							                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
							                                    'Friday'+
							                                '</div>'+
							                            '</div>'+

							                            '<div id="friday-5" class="row emptimize">'+
							                                
							                            '</div>'+

							                        '</div>'+

							                        '<div class="card col-md-2 rounded-0">'+
							                            '<div class="row">'+
							                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
							                                    'Saturday'+
							                                '</div>'+
							                            '</div>'+

							                            '<div id="saturday-6" class="row emptimize">'+
							                                
							                            '</div>'+

							                        '</div>'+
						                        '</div>';

						/* Add content in schedule wrapper */
						$(document).find('#schedule-wrapper').append(scheduleTemplate);

					}
				}
			});

			

			$.ajax({
				type: 'GET',
				url: '/admin/dashboard/get-program-schedule',
				data: {
					ay: id[0],
					sem: id[1],
					id: id[2],
					level: id[3],
					_token: $('input[name=_token]').val(),
				},
				dataType: 'json',
				success: function(data) {
					/* container empty first */
					$(document).find('.emptimize').each(function(index, el) {
						$(this).empty();
					}); 

					if (data.status == true) {

						/* Sorting data */
						var sortedData = data.schedule.sort(function(obj1, obj2) {
						    return obj1.time_start - obj2.time_start;
						}); 

						$.each(sortedData, function(index, item) {
							if (item.time_start != null && item.time_finish != null) {
								var s_time = item.time_start.toString().length;
								var f_time = item.time_finish.toString().length;

								if (s_time == 3) {
									var time_s = item.time_start.toString().slice(0, 1) + ':' + item.time_start.toString().slice(1, 3);

								} else if (s_time == 4) {
									var time_s = item.time_start.toString().slice(0, 2) + ':' + item.time_start.toString().slice(2, 4);
								}

								if (f_time == 3) {
									var time_f = item.time_finish.toString().slice(0, 1) + ':' + item.time_finish.toString().slice(1, 3);

								} else if (f_time == 4) {
									var time_f = item.time_finish.toString().slice(0, 2) + ':' + item.time_finish.toString().slice(2, 4);
								}
							}

							/* card format time, subject_name, teacher, and room */
							var card = '<div class="card text-center position-relative col-md-12  rounded-0 m-0" style="min-height: 120px; max-height: 120px; margin-bottom: 2px; border-left: none; border-right: none;">'+
							                         
							                         '<div class="data-wrapper">'+
							                         	'<div> '+ time_s +' - '+ time_f +' </div>'+
							                         	'<div> <b>'+ item.course_name +'</b> </div>'+
							                         	'<div>'+ item.teacher_name +'</div>'+
							                         	'<div>'+ item.room_name +'</div>'+
							                         '</div>'+

							                      '</div>';

							if (item.day == 1) {
								$('#monday-1').append(card);

							} else if (item.day == 2) {
								$('#tuesday-2').append(card);

							} else if (item.day == 3) {
								$('#wednesday-3').append(card);
								
							} else if (item.day == 4) {
								$('#thursday-4').append(card);
								
							} else if (item.day == 5) {
								$('#friday-5').append(card);
								
							} else if (item.day == 6) {
								$('#saturday-6').append(card);
								
							}

						});
					}

				}
			});
			
		});
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

				$('.del-all').animate({
					marginLeft: '6px',
				}, 'slow');

				expandCounter++;
			} else if (expandCounter == 2) {
				$('.ay-section').animate({
					width: '189px',
				}, 'fast');

				$('.del-all').animate({
					marginLeft: '2px',
				}, 'fast');

				expandCounter--;
			}

			console.log(expandCounter);

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

						location.reload();

						// $('#sc_ay').text(academic_title);

						// if ($('#ay').val() == null || $('#ay').val() == '') {
						// 	$('#ay').empty();

						// 	$(document).find('#ay').prepend('<option value="'+ data.id +'">'+ data.academic_title +'</option>');

						// } else {
						// 	$(document).find('#ay').prepend('<option value="'+ data.id +'">'+ data.academic_title +'</option>');

						// }

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
						bootbox.dialog({
							message: '<div> The Academic year is successfully changed. <p></p> <p> Please wait to reload the programs.</p> </div>',
						});

						setTimeout(reloadPage, 1500)

					}
					
				}
			});

		});
	}

	var reloadPage = function() {
		location.reload();
	}

	var enChangeAY = function() {
		$(document).on('change', '.sel-ay-enBtn', function(event) {
			event.preventDefault();
			
			$(document).find('#f_data').attr('disabled', false);
			$(document).find('#sem').attr('disabled', true);
		});
	}

	// var enChangeAYCounter = 0;
	// var enChangeAY = function() {
	// 	$(document).on('change', '.sel-ay-enBtn', function(event) {
	// 		event.preventDefault();
			
	// 		$('.sel-ay-enBtn').each(function(index, el) {
				
	// 			if ($(this).val() != 'not null' && $(this).val() != null) {
	// 				enChangeAYCounter++

	// 				if (enChangeAYCounter == 2) {
	// 					$('#f_data').attr('disabled', false);
	// 				}


	// 			} else {
	// 				enChangeAYCounter--;
	// 			}
	// 		});

	// 			enChangeAYCounter = 0;
	// 	});
	// }

	var loading = function() {
		var checking = $('.empty-message').text().trim('');

		if (checking == 'What are the "Courses" your education offers?') {
			

		} else {
			bootbox.dialog({ 
				message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Loading...</div>',
				closeButton: false,
			});

		}
	}

	var hideLoading = function() {
		bootbox.hideAll();
	}

	var forClose = function() {
		$('.modal').on('hidden.bs.modal', function() {
			$(document).find('#schedule-wrapper').empty();
			$(document).find('#item-container').empty();
		});
	}

	var soloDelete = function() {
		$(document).on('click', '.delete-me', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');
			var parent = $(this).parents('tr');

			$.ajax({
				type: 'GET',
				url: '/admin/dashboard/delete-course',
				data: {
					id: id[1],
					_token: $('input[name=_token]').val(),
				},
				dataType: 'json',
				success: function(data) {
					if (data.status == true) {
						bootbox.dialog({
							message: '<div>'+ data.message +'</div',
						});

						parent.remove();

					} else if (data.status == false) {
						bootbox.dialog({
							message: '<div>'+ data.message +'</div',
						});

					}

				}
			});

		});
	}

	var multipleChecked = function() {
		$(document).on('change', '#mult-delete', function(event) {
			event.preventDefault();
			
			if ($(this).prop('checked') == true) {
				$(document).find('.checkbox').each(function(index, el) {
					$(this).prop('checked', true);
				});

			} else if ($(this).prop('checked') == false) {
				$(document).find('.checkbox').each(function(index, el) {
					$(this).prop('checked', false);
				});

			}
		});
	}

	var checkboxCheckedCounter = 0;
	var multipleDelete = function() {
		$(document).on('click', '.multiple-del', function(event) {
			event.preventDefault();
			
			$(document).find('.checkbox:checked').each(function(index, el) {
				checkboxCheckedCounter++;
			});

			if (checkboxCheckedCounter != 0) {
				var tobeDeleted = [];

				$(document).find('.checkbox:checked').each(function(index, el) {
					var id = $(this).attr('id');

					tobeDeleted.push(id);
				});

				bootbox.confirm('<div>Do you really want to delete this courses?</div>', function(yes) {
					if (yes) {
						$.ajax({
							url: '/admin/dashboard/multiple-delete',
							type: 'GET',
							data: {
								ids: tobeDeleted,
								_token: $('input[name=_token]').val(),
							},
							dataType: 'json',
							success: function(data) {
								if (data.status == true) {
									bootbox.alert('<div>'+ data.message +'</div>');

									setTimeout(reloadPage, 2000);

								} else if (data.status == false) {
									bootbox.alert('<div>'+ data.message +'</div>');
								}
							}

						});
					}
				});

			} else {
				bootbox.alert('<div>Please select at least 1 of the checkboxes below in order to delete.</div>');
			}
		});
	}


	return {
		init: function() {
			// loading()
			setTimeout(hideLoading, 3000)
			// setTimeout(showLevels, 3000)
			showExistingLevels()
			showSchedule()
			forClose()

			changeAY()
			enChangeAY()

			viewSchedule()
			expandAcademicSection()
			addAcademicYear()
			storeAcadYear()
			soloDelete()
			multipleChecked()
			multipleDelete()
		},
	}
}();