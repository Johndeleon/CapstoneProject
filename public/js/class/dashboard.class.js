var dashboardMaintenance = function() {

	var selectTheme = function() {
		$('.select3').select2({
			theme: 'bootstrap4',
			theme: 'classic',
		});
	}

	var mes = function(data=null) {
		if (data != null) {
			alert(data);
			console.log(data);

		} else {
			alert('me');
		}

	}

	var programFilter = function() {
		$('#filt-prog').change(function() {
			var val = $(this).val()
			
			// if empty then disable the level
			if (val == '') {
				$(document).find('#filt-lev').attr('disabled', true);

				// Put it back to empty
				var selected = $('.filt-yl-val:selected').val();

				if (selected != '') {
					$('#filt-lev').val('').trigger('change');
				}

			} else {
				$(document).find('#filt-lev').attr('disabled', false);
			}

		});
	}

	var viewTeacher = function() {
		$(document).on('click', '#viewTeacher', function(event) {
			event.preventDefault();
			var ay = $(document).find('#ay').val();
			var ayText = $(document).find('#ay').text().trim('');
			var sem = $(document).find('#sem').val();


			
		});
	}

	var showFilteredTeacherSchedule = function() {
		$(document).on('click', '#filter-now', function(event) {
			event.preventDefault();

			$.ajax({
				type: 'POST',
				url: '/admin/dashboard/get-filtered-schedule',
				data: $('#teacher-filters').serialize(),
				cache: false,
				dataType: 'json',
				beforeSend: function() {
					
				},
				complete: function() {
					
				}
			}).done(function (data) {
				if (data.status == true) {

					// Emptimize the field
					$('#teacherSchedule').empty();

					bootbox.dialog({
						message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Loading...</div>',
						closeButton: false,
					});
					setTimeout(hideLoading, 900);

					$(document).on('hide.bs.modal', function () {
					    $("#filterTeacher").css("overflow-y", "auto"); // 'auto' or 'scroll'
					});

					// if (id[1] == 1) {
					// 	var semHtml = '<span>'+id[1]+'st Semester</span> <br>';

					// } else if (id[1] == 2) {
					// 	var semHtml = '<span>'+id[1]+'nd Semester</span> <br>';

					// }

					// var scheduleTemplate = 
											// '<div class="c_title text-center mt-1 mb-1">'+
						     //                    '<span>Academic Year: <b> '+ data.academic_year +' </b> </span> <br>'+
											// 	semHtml +
						     //                    '<span>'+ data.program_name +' '+id[3]+'</span>'+
						     //                '</div>'+

											// '<div class="row mx-1">'+
											// 	'<div class="card col-md-2 rounded-0">'+
						     //                        '<div class="row">'+
						     //                            '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						     //                                'Monday'+
						     //                            '</div>'+
						     //                        '</div>'+

						     //                        '<div id="monday-1" class="row emptimize">'+

						     //                        '</div>'+

						     //                    '</div>'+

						     //                    '<div class="card col-md-2 rounded-0">'+
						     //                        '<div class="row">'+
						     //                            '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						     //                                'Tuesday'+
						     //                            '</div>'+
						     //                        '</div>'+

						     //                        '<div id="tuesday-2" class="row emptimize">'+

						     //                        '</div>'+

						     //                    '</div>'+

						     //                    '<div class="card col-md-2 rounded-0">'+
						     //                        '<div class="row">'+
						     //                            '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						     //                                'Wednesday'+
						     //                            '</div>'+
						     //                        '</div>'+

						     //                        '<div id="wednesday-3" class="row emptimize">'+

						     //                        '</div>'+

						     //                    '</div>'+

						     //                    '<div class="card col-md-2 rounded-0">'+
						     //                        '<div class="row">'+
						     //                            '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						     //                                'Thursday'+
						     //                            '</div>'+
						     //                        '</div>'+

						     //                        '<div id="thursday-4" class="row emptimize">'+

						     //                        '</div>'+

						     //                    '</div>'+

						     //                    '<div class="card col-md-2 rounded-0">'+
						     //                        '<div class="row">'+
						     //                            '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						     //                                'Friday'+
						     //                            '</div>'+
						     //                        '</div>'+

						     //                        '<div id="friday-5" class="row emptimize">'+

						     //                        '</div>'+

						     //                    '</div>'+

						     //                    '<div class="card col-md-2 rounded-0">'+
						     //                        '<div class="row">'+
						     //                            '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						     //                                'Saturday'+
						     //                            '</div>'+
						     //                        '</div>'+

						     //                        '<div id="saturday-6" class="row emptimize">'+

						     //                        '</div>'+

						     //                    '</div>'+
					      //                   '</div>';
					      //                   
					 

					var scheduleTemplate = '<div> <button id="print_sched" class="btn btn-primary btn-circle pull-right mb-2"> <i class="fa fa-print" aria-hidden="true"></i> </button> </div>'+
											'<div class="table-responsive">'+
												'<table class="table ct-table-filt table-bordered table-inverse">'+
													'<thead style="background: #357da8; color: #eee;">'+
														'<tr>'+
															'<th width="16.66%" class="text-center"> Monday </th>'+
															'<th width="16.66%" class="text-center"> Tuesday </th>'+
															'<th width="16.66%" class="text-center"> Wednesday </th>'+
															'<th width="16.66%" class="text-center"> Thursday </th>'+
															'<th width="16.66%" class="text-center"> Friday </th>'+
															'<th width="16.66%" class="text-center"> Saturday </th>'+
														'</tr>'+
													'</thead>'+

													'<tbody>'+
														'<tr>'+
															'<td id="monday-1" class="seven"></td>'+
															'<td id="tuesday-2" class="seven"></td>'+
															'<td id="wednesday-3" class="seven"></td>'+
															'<td id="thursday-4" class="seven"></td>'+
															'<td id="friday-5" class="seven"></td>'+
															'<td id="saturday-6" class="seven"></td>'+
														'</tr>'+

														'<tr>'+
															'<td id="monday-1" class="ten"></td>'+
															'<td id="tuesday-2" class="ten"></td>'+
															'<td id="wednesday-3" class="ten"></td>'+
															'<td id="thursday-4" class="ten"></td>'+
															'<td id="friday-5" class="ten"></td>'+
															'<td id="saturday-6" class="ten"></td>'+
														'</tr>'+

														'<tr>'+
															'<td id="monday-1" class="twelve"></td>'+
															'<td id="tuesday-2" class="twelve"></td>'+
															'<td id="wednesday-3" class="twelve"></td>'+
															'<td id="thursday-4" class="twelve"></td>'+
															'<td id="friday-5" class="twelve"></td>'+
															'<td id="saturday-6" class="twelve"></td>'+
														'</tr>'+

														'<tr style="border-top: 2px solid #357da8; border-bottom: 2px solid #357da8;">'+
															'<td colspan="6" class="text-center text-dark pt-2 pb-2" style="margin-bottom: 2px;">Lunch</td>'+
														'</tr>'+

														'<tr>'+
															'<td id="monday-1" class="one"></td>'+
															'<td id="tuesday-2" class="one"></td>'+
															'<td id="wednesday-3" class="one"></td>'+
															'<td id="thursday-4" class="one"></td>'+
															'<td id="friday-5" class="one"></td>'+
															'<td id="saturday-6" class="one"></td>'+
														'</tr>'+

														'<tr>'+
															'<td id="monday-1" class="four"></td>'+
															'<td id="tuesday-2" class="four"></td>'+
															'<td id="wednesday-3" class="four"></td>'+
															'<td id="thursday-4" class="four"></td>'+
															'<td id="friday-5" class="four"></td>'+
															'<td id="saturday-6" class="four"></td>'+
														'</tr>'+


													'</tbody>'+

												'</table>'+
											'</div>';

					/* Add content in schedule wrapper */
					$(document).find('#teacherSchedule').append(scheduleTemplate);

					// xxhere
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
						var card = '<div class="card text-center position-relative col-md-12 text-dark  rounded-0 m-0" style="min-height: 120px; max-height: 120px; margin-bottom: 2px; border: 1px solid #a6a7a8;">'+

						                         '<div class="data-wrapper" style="font-size: 0.8rem">'+
						                         	'<div> '+ time_s +' - '+ time_f +' </div>'+
						                         	'<div> <b>'+ item.course_name +'</b> </div>'+
						                         	'<div>'+ item.teacher_name +'</div>'+
						                         	'<div>'+ item.room_name +'</div>'+
						                         '</div>'+

						                      '</div>';

						if (item.day == 1) {
							// if the start time is less than 10:00 then this must be 7 onwards
							if (item.time_start < 1000) {
								$('#monday-1.seven').append(card);
							
							} else if (item.time_start < 1200) {
								$('#monday-1.ten').append(card);

							} else if (item.time_start > 1200 && item.time_start < 1300) {
								$('#monday-1.one').append(card);
								
							} else if (item.time_start < 1600) {
								$('#monday-1.one').append(card);
								
							} else if (item.time_start < 2200) {
								$('#monday-1.four').append(card);
								
							} else {
								$('#monday-1.ten').append(card);
							}

						} else if (item.day == 2) {
							// if the start time is less than 10:00 then this must be 7 onwards
							if (item.time_start < 1000) {
								$('#tuesday-2.seven').append(card);
							
							} else if (item.time_start < 1200) {
								$('#tuesday-2.ten').append(card);

							} else if (item.time_start > 1200 && item.time_start < 1300) {
								$('#tuesday-2.one').append(card);
								
							} else if (item.time_start < 1600) {
								$('#tuesday-2.one').append(card);
								
							} else if (item.time_start < 2200) {
								$('#tuesday-2.four').append(card);
								
							} else {
								$('#tuesday-2.ten').append(card);
							}

						} else if (item.day == 3) {
							// if the start time is less than 10:00 then this must be 7 onwards
							if (item.time_start < 1000) {
								$('#wednesday-3.seven').append(card);
							
							} else if (item.time_start < 1200) {
								$('#wednesday-3.ten').append(card);

							} else if (item.time_start > 1200 && item.time_start < 1300) {
								$('#wednesday-3.one').append(card);
								
							} else if (item.time_start < 1600) {
								$('#wednesday-3.one').append(card);
								
							} else if (item.time_start < 2200) {
								$('#wednesday-3.four').append(card);
								
							} else {
								$('#wednesday-3.ten').append(card);
							}

						} else if (item.day == 4) {
							// if the start time is less than 10:00 then this must be 7 onwards
							if (item.time_start < 1000) {
								$('#thursday-4.seven').append(card);
							
							} else if (item.time_start < 1200) {
								$('#thursday-4.ten').append(card);

							} else if (item.time_start > 1200 && item.time_start < 1300) {
								$('#thursday-4.one').append(card);
								
							} else if (item.time_start < 1600) {
								$('#thursday-4.one').append(card);
								
							} else if (item.time_start < 2200) {
								$('#thursday-4.four').append(card);
								
							} else {
								$('#thursday-4.ten').append(card);
							}

						} else if (item.day == 5) {
							// if the start time is less than 10:00 then this must be 7 onwards
							if (item.time_start < 1000) {
								$('#friday-5.seven').append(card);
							
							} else if (item.time_start < 1200) {
								$('#friday-5.ten').append(card);

							} else if (item.time_start > 1200 && item.time_start < 1300) {
								$('#friday-5.one').append(card);
								
							} else if (item.time_start < 1600) {
								$('#friday-5.one').append(card);
								
							} else if (item.time_start < 2200) {
								$('#friday-5.four').append(card);
								
							} else {
								$('#friday-5.ten').append(card);
							}

						} else if (item.day == 6) {
							// if the start time is less than 10:00 then this must be 7 onwards
							if (item.time_start < 1000) {
								$('#saturday-6.seven').append(card);
							
							} else if (item.time_start < 1200) {
								$('#saturday-6.ten').append(card);

							} else if (item.time_start > 1200 && item.time_start < 1300) {
								$('#saturday-6.one').append(card);
								
							} else if (item.time_start < 1600) {
								$('#saturday-6.one').append(card);
								
							} else if (item.time_start < 2200) {
								$('#saturday-6.four').append(card);
								
							} else {
								$('#saturday-6.ten').append(card);
							}

						}

					}); 
				} else if (data.status == false) {
					// Emptimize the field
					$('#teacherSchedule').empty();

					bootbox.alert('<div> '+ data.message +' </div>');
				};
			});

		});
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

					if (data.status == true) {
						$(document).find('#item-container').empty();

						for (i = 0; i < data.level; i++) {
							var yes = false;

							for (j = 0; j < data.levelWithSched.length; j++) {
								 if ((i+1) == data.levelWithSched[j]) {
										 var container = $(document).find('#item-container');
										 var button = '<button id="'+ ay +'-'+ sem +'-'+ id[1] +'-'+ (i+1) +'" class="btn btn-primary form-control rounded-0 py-2 mb-2 showSchedule" title="Click to view the schedule"> '+ (i+1) +' </button>';

										 container.append(button);
										 yes = true;
								 }
							}

							if (yes == false) {
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
			var thisId = $(this).attr('id');
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

						// var scheduleTemplate = '<div class="c_title text-center mt-1 mb-1">'+
						// 	                        '<span>Academic Year: <b> '+ data.academic_year +' </b> </span> <br>'+
						// 							semHtml +
						// 	                        '<span>'+ data.program_name +' '+id[3]+'</span>'+
						// 	                    '</div>'+

						// 						'<div class="row mx-1">'+
						// 							'<div class="card col-md-2 rounded-0">'+
						// 	                            '<div class="row">'+
						// 	                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						// 	                                    'Monday'+
						// 	                                '</div>'+
						// 	                            '</div>'+

						// 	                            '<div id="monday-1" class="row emptimize">'+

						// 	                            '</div>'+

						// 	                        '</div>'+

						// 	                        '<div class="card col-md-2 rounded-0">'+
						// 	                            '<div class="row">'+
						// 	                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						// 	                                    'Tuesday'+
						// 	                                '</div>'+
						// 	                            '</div>'+

						// 	                            '<div id="tuesday-2" class="row emptimize">'+

						// 	                            '</div>'+

						// 	                        '</div>'+

						// 	                        '<div class="card col-md-2 rounded-0">'+
						// 	                            '<div class="row">'+
						// 	                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						// 	                                    'Wednesday'+
						// 	                                '</div>'+
						// 	                            '</div>'+

						// 	                            '<div id="wednesday-3" class="row emptimize">'+

						// 	                            '</div>'+

						// 	                        '</div>'+

						// 	                        '<div class="card col-md-2 rounded-0">'+
						// 	                            '<div class="row">'+
						// 	                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						// 	                                    'Thursday'+
						// 	                                '</div>'+
						// 	                            '</div>'+

						// 	                            '<div id="thursday-4" class="row emptimize">'+

						// 	                            '</div>'+

						// 	                        '</div>'+

						// 	                        '<div class="card col-md-2 rounded-0">'+
						// 	                            '<div class="row">'+
						// 	                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						// 	                                    'Friday'+
						// 	                                '</div>'+
						// 	                            '</div>'+

						// 	                            '<div id="friday-5" class="row emptimize">'+

						// 	                            '</div>'+

						// 	                        '</div>'+

						// 	                        '<div class="card col-md-2 rounded-0">'+
						// 	                            '<div class="row">'+
						// 	                                '<div class="col-md-12 card-header text-center py-reduced" style="font-size: 0.8rem">'+
						// 	                                    'Saturday'+
						// 	                                '</div>'+
						// 	                            '</div>'+

						// 	                            '<div id="saturday-6" class="row emptimize">'+

						// 	                            '</div>'+

						// 	                        '</div>'+
						//                         '</div>';


						var scheduleTemplate = '<div class="c_title text-center mt-1 mb-1">'+
							                        '<span>Academic Year: <b> '+ data.academic_year +' </b> </span> <br>'+
													semHtml +
							                        '<span>'+ data.program_name +' '+id[3]+'</span>'+
							                    '</div>'+

							                    '<div class="">'+
							                    	'<button id="print_sched" class="btn btn-primary btn-circle pull-right mb-2" title="Print this schedule">'+
							                    		'<i class="fa fa-print" aria-hidden="true"></i>'+
							                    	'</button>'+

							                    	'<button id="'+ thisId +'" class="btn btn-danger btn-circle pull-right mb-2 mr-2 deleteSchedule" title="Delete this schedule">'+
							                    		'<i class="fa fa-trash" aria-hidden="true"></i>'+
							                    	'</button>'+
							                    '</div>'+

												'<div class="table-responsive">'+
													'<table class="table ct-table-filt table-bordered table-inverse">'+
														'<thead>'+
															'<tr>'+
																'<th width="16.66%" class="text-center"> Monday </th>'+
																'<th width="16.66%" class="text-center"> Tuesday </th>'+
																'<th width="16.66%" class="text-center"> Wednesday </th>'+
																'<th width="16.66%" class="text-center"> Thursday </th>'+
																'<th width="16.66%" class="text-center"> Friday </th>'+
																'<th width="16.66%" class="text-center"> Saturday </th>'+
															'</tr>'+
														'</thead>'+

														'<tbody>'+
															'<tr>'+
																'<td id="monday-1" class="seven"></td>'+
																'<td id="tuesday-2" class="seven"></td>'+
																'<td id="wednesday-3" class="seven"></td>'+
																'<td id="thursday-4" class="seven"></td>'+
																'<td id="friday-5" class="seven"></td>'+
																'<td id="saturday-6" class="seven"></td>'+
															'</tr>'+

															'<tr>'+
																'<td id="monday-1" class="ten"></td>'+
																'<td id="tuesday-2" class="ten"></td>'+
																'<td id="wednesday-3" class="ten"></td>'+
																'<td id="thursday-4" class="ten"></td>'+
																'<td id="friday-5" class="ten"></td>'+
																'<td id="saturday-6" class="ten"></td>'+
															'</tr>'+

															'<tr>'+
																'<td id="monday-1" class="twelve"></td>'+
																'<td id="tuesday-2" class="twelve"></td>'+
																'<td id="wednesday-3" class="twelve"></td>'+
																'<td id="thursday-4" class="twelve"></td>'+
																'<td id="friday-5" class="twelve"></td>'+
																'<td id="saturday-6" class="twelve"></td>'+
															'</tr>'+

															'<tr style="border-top: 2px solid #357da8; border-bottom: 2px solid #357da8;">'+
																'<td colspan="6" class="text-center text-dark pt-2 pb-2" style="margin-bottom: 2px;">Lunch</td>'+
															'</tr>'+

															'<tr>'+
																'<td id="monday-1" class="one"></td>'+
																'<td id="tuesday-2" class="one"></td>'+
																'<td id="wednesday-3" class="one"></td>'+
																'<td id="thursday-4" class="one"></td>'+
																'<td id="friday-5" class="one"></td>'+
																'<td id="saturday-6" class="one"></td>'+
															'</tr>'+

															'<tr>'+
																'<td id="monday-1" class="four"></td>'+
																'<td id="tuesday-2" class="four"></td>'+
																'<td id="wednesday-3" class="four"></td>'+
																'<td id="thursday-4" class="four"></td>'+
																'<td id="friday-5" class="four"></td>'+
																'<td id="saturday-6" class="four"></td>'+
															'</tr>'+


														'</tbody>'+

													'</table>'+
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
							var card = '<div class="card text-center position-relative col-md-12 text-dark  rounded-0 m-0" style="min-height: 120px; max-height: 120px; margin-bottom: 2px;">'+

							                         '<div class="data-wrapper" style="font-size: 0.8rem; top: 50%; left: 50%; width: 150px; transform: translate(-50%, -50%); position: absolute;">'+
							                         	'<div> '+ time_s +' - '+ time_f +' </div>'+
							                         	'<div> <b>'+ item.course_name +'</b> </div>'+
							                         	'<div>'+ item.teacher_name +'</div>'+
							                         	'<div>'+ item.room_name +'</div>'+
							                         '</div>'+

							                      '</div>';

							// if (item.day == 1) {
							// 	$('#monday-1').append(card);

							// } else if (item.day == 2) {
							// 	$('#tuesday-2').append(card);

							// } else if (item.day == 3) {
							// 	$('#wednesday-3').append(card);

							// } else if (item.day == 4) {
							// 	$('#thursday-4').append(card);

							// } else if (item.day == 5) {
							// 	$('#friday-5').append(card);

							// } else if (item.day == 6) {
							// 	$('#saturday-6').append(card);

							// }
							

							if (item.day == 1) {
								// if the start time is less than 10:00 then this must be 7 onwards
								if (item.time_start < 1000) {
									$('#monday-1.seven').append(card);
								
								} else if (item.time_start < 1200) {
									$('#monday-1.ten').append(card);

								} else if (item.time_start > 1200 && item.time_start < 1300) {
									$('#monday-1.one').append(card);
									
								} else if (item.time_start < 1600) {
									$('#monday-1.one').append(card);
									
								} else if (item.time_start < 2200) {
									$('#monday-1.four').append(card);
									
								} else {
									$('#monday-1.ten').append(card);
								}

							} else if (item.day == 2) {
								// if the start time is less than 10:00 then this must be 7 onwards
								if (item.time_start < 1000) {
									$('#tuesday-2.seven').append(card);
								
								} else if (item.time_start < 1200) {
									$('#tuesday-2.ten').append(card);

								} else if (item.time_start > 1200 && item.time_start < 1300) {
									$('#tuesday-2.one').append(card);
									
								} else if (item.time_start < 1600) {
									$('#tuesday-2.one').append(card);
									
								} else if (item.time_start < 2200) {
									$('#tuesday-2.four').append(card);
									
								} else {
									$('#tuesday-2.ten').append(card);
								}

							} else if (item.day == 3) {
								// if the start time is less than 10:00 then this must be 7 onwards
								if (item.time_start < 1000) {
									$('#wednesday-3.seven').append(card);
								
								} else if (item.time_start < 1200) {
									$('#wednesday-3.ten').append(card);

								} else if (item.time_start > 1200 && item.time_start < 1300) {
									$('#wednesday-3.one').append(card);
									
								} else if (item.time_start < 1600) {
									$('#wednesday-3.one').append(card);
									
								} else if (item.time_start < 2200) {
									$('#wednesday-3.four').append(card);
									
								} else {
									$('#wednesday-3.ten').append(card);
								}

							} else if (item.day == 4) {
								// if the start time is less than 10:00 then this must be 7 onwards
								if (item.time_start < 1000) {
									$('#thursday-4.seven').append(card);
								
								} else if (item.time_start < 1200) {
									$('#thursday-4.ten').append(card);

								} else if (item.time_start > 1200 && item.time_start < 1300) {
									$('#thursday-4.one').append(card);
									
								} else if (item.time_start < 1600) {
									$('#thursday-4.one').append(card);
									
								} else if (item.time_start < 2200) {
									$('#thursday-4.four').append(card);
									
								} else {
									$('#thursday-4.ten').append(card);
								}

							} else if (item.day == 5) {
								// if the start time is less than 10:00 then this must be 7 onwards
								if (item.time_start < 1000) {
									$('#friday-5.seven').append(card);
								
								} else if (item.time_start < 1200) {
									$('#friday-5.ten').append(card);

								} else if (item.time_start > 1200 && item.time_start < 1300) {
									$('#friday-5.one').append(card);
									
								} else if (item.time_start < 1600) {
									$('#friday-5.one').append(card);
									
								} else if (item.time_start < 2200) {
									$('#friday-5.four').append(card);
									
								} else {
									$('#friday-5.ten').append(card);
								}

							} else if (item.day == 6) {
								// if the start time is less than 10:00 then this must be 7 onwards
								if (item.time_start < 1000) {
									$('#saturday-6.seven').append(card);
								
								} else if (item.time_start < 1200) {
									$('#saturday-6.ten').append(card);

								} else if (item.time_start > 1200 && item.time_start < 1300) {
									$('#saturday-6.one').append(card);
									
								} else if (item.time_start < 1600) {
									$('#saturday-6.one').append(card);
									
								} else if (item.time_start < 2200) {
									$('#saturday-6.four').append(card);
									
								} else {
									$('#saturday-6.ten').append(card);
								}

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
					width: '189px',
				}, 'fast');

				$('.del-all').animate({
					marginLeft: '2px',
				}, 'slow');

				$('.ct-notif-sec').animate({
					right: '15%'
				}, 'slow');

				expandCounter++;
			} else if (expandCounter == 2) {
				$('.ay-section').animate({
					width: '25rem',
				}, 'slow');

				$('.del-all').animate({
					marginLeft: '6px',
				}, 'fast');

				$('.ct-notif-sec').animate({
					right: '13%'
				}, 'slow');

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
			$(document).find('#teacherSchedule').empty();
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

	var printSchedule = function() {
		$(document).on('click', '#print_sched', function(event) {
			event.preventDefault();

			container = $(this).parent().parent();
			
			container.printThis({
                debug: false,           // show the iframe for debugging
                importCSS: true,        // import parent page css
                importStyle: true,     // import style tags
                printContainer: true,   // print outer container/$.selector
                loadCSS: '', // load an additional css file - load multiple stylesheets with an array []
                pageTitle: "",          // add title to print page
                removeInline: false,    // remove all inline styles
                printDelay: 333,        // variable print delay
                header: "",           // prefix to html
                footer: null,           // postfix to html
                formValues: true,       // preserve input/form values
                canvas: false,          // copy canvas content (experimental)
                base: false,            // preserve the BASE tag, or accept a string for the URL
                doctypeString: '<!DOCTYPE html>', // html doctype
                removeScripts: false,   // remove script tags before appending
                copyTagClasses: false   // copy classes from the html & body tag
            });

		});
	}

	var deleteCouseLevelSchedule = function() {
		$(document).on('click', '.deleteSchedule', function(event) {
			event.preventDefault();
			$this = $(this);
			var btn = '#' + $(this).attr('id');
			var id = $this.attr('id').split('-');
			
			bootbox.confirm('<div> Do you want to delete this schedule? </div>', function(e) {

				if (e) {

					$.ajax({
						type: 'GET',
						url: '/admin/dashboard/delete-schedule',
						data: {
							ay: id[0],
							sem: id[1],
							prog: id[2],
							lev: id[3],
							_token: $('input[name=_token]').val(),
						},
						dataType: 'json',
						success: function(data) {
							if (data.status == true) {
								bootbox.alert('<div> '+ data.message +' </div>');

								/* Empty the schedule wrapper */
								$('#schedule-wrapper').empty();

								/* Disable the button */
								$(btn).attr('disabled', true);
							}
						}
					});

				}

			});
		});
	}

	// Checking if there is no Schedules
	var emptySchedulesChecker = function() {
		$(document).ready(function() {

			var sem = $('#sem').val();
			
			$.ajax({
				type: 'GET',
				url: '/admin/dashboard/get-empty-program',
				data: {
					sem: sem,
					_token: $('input[name=_token]').val(),
				},
				dataType: 'json',
				success: function(data) {
					if (data != null) {
						
						$('#notif-alert-count').text(data.program.length);

						var levelCounter = 1;

						$.each(data['program'], function(el, item){
							var levelsArr = [];
							var levelsArr1 = '';

							$.each(item['levels'], function(index, val) {
								levelsArr1+= val;
							});

							var addEmptySched = '<div class="ct-prog-no-sched-wrapper mb-2 pointer">'+
													'<div class="ct-prog-item">'+
														'<label class="pointer" data-toggle="collapse" href="#'+levelCounter+'">'+ item['title'] +'</label>'+
														'<ul class="collapse" id="'+levelCounter+'">'+
															levelsArr1+
														'</ul>'+
													'</div>'+
												'</div>';

							$('.ct-notif-panel').append(addEmptySched);
							levelCounter++;
						});
					}
				}
			});

		});
	}

	var clickNotif = function() {
		$('#notif-alert').on('click', function(e) {
			e.preventDefault();

			$('.ct-notif-panel').toggleClass('active');
		});
	}

	/**If the sem is changed */
	var changeSem = function() {
		$('#sem').on('change', function() {
			emptySchedulesChecker()
		});
	}


	return {
		init: function() {
			// plugins
			selectTheme()

			// Filters
			programFilter()


			// loading()
			setTimeout(hideLoading, 3000)
			showExistingLevels()
			showSchedule()
			forClose()

			changeAY()
			enChangeAY()
			viewTeacher()
			showFilteredTeacherSchedule()

			viewSchedule()
			expandAcademicSection()
			addAcademicYear()
			storeAcadYear()
			soloDelete()
			multipleChecked()
			multipleDelete()

			printSchedule()

			/* Delete Method */
			deleteCouseLevelSchedule()

			/** Schedule Checker */
			emptySchedulesChecker()
			changeSem()

			clickNotif()
		},
	}
}();
