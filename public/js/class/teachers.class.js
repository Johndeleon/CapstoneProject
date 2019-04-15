var teacherMaintenance = function() {
	
	var hideSecondForm = function() {
		$(document).find('#secondForm').hide();
	}

	var mes = function(data=null) {
		if (data != null) {
			alert(data)
			console.log(data);
		} else {
			alert('me')
		}
	}

	var gotoSecondForm = function() {
		$(document).on('click', '#goAvaiDays', function(event) {
			event.preventDefault();
			
			$(document).find('#firstForm').hide('slow');
			$(document).find('#secondForm').show('fast');

			
		});
	}

	var gotoFirstForm = function() {
		$(document).on('click', '#backFirstForm', function(event) {
			event.preventDefault();
			
			$(document).find('#secondForm').hide('fast');
			$(document).find('#firstForm').show('slow');
		});
	}

	var loadTeacherData = function(){
		$('#dt-teacher').dataTable({
			"bProcessing": true,
			"sAjaxDataProp": "aaData",
			"language": {
			"emptyTable": "Please select the type of paper..."
			},
			"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
			// "aoColumnDefs": [{"bSortable": false, "aTargets": [-1]}],
			"bServerSide": false,
			"sPaginationType": "full_numbers",
			"bLengthChange": true,
			"bInfo": true,
			"sDom": '<"H"lr>ftp<"F"i>',

			"oLanguage": {
			"sSearch": 'Search <i class="fa fa-search"></i> ',
			"sProcessing": "Loading Records, Please Wait..."
			},
			"aaSorting": [],
			"sAjaxSource": '/load/teacher-table',
			"bAutoWidth": false,
			"bDestroy": true,
		});
	};

	var addTeacherData = function() {
		$(document).on('submit', '#id-addTeacher', function(event) {
			event.preventDefault();
			var data = $('#id-addTeacher').serialize();
			
			$.ajax({
				type: 'POST',
				url: '/add/teacher-data',
				data: data,
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == false) {
						if (data.errors) {
							var dataErrors = data.errors;

							$.each(dataErrors, function(key, val) {
								ifAnyError(val)
							});
						} else {
							ifAnyError(data.message)
						}
					}
					else if (data.status) {
						bootbox.alert('<div>'+ data.message +'</div>');
						$(document).find('.reset').each(function(e) {
							$(this).val("");
						});

						$(document).find('#secondForm').hide('fast');
						$(document).find('#firstForm').show('slow');

						propAllAvailableDays()
						$(document).find('.reset-2-f').each(function(index, el) {
							$(this).val('8:00');
							$(this).attr('readonly', false);
						});

						$(document).find('.reset-2-fs').each(function(index, el) {
							$(this).val('20:00');
						});

						loadTeacherData()
					}
				}
			});
		});
	}

	var resetForm = function() {
		$(document).on('click', '.reset', function(event) {
			event.preventDefault();

			var nameId = $(this).attr('name');
			nameId = nameId.split('-');
			nameId = nameId[1];

			if (nameId == 1) {
				$(document).find('.reset').each(function(e) {
					$(this).val("");
				});
			}
			else if (nameId == 2) {
				$(document).find('.reset-2-f').each(function(e) {
					$(this).val("");
				});
			}

			
		});
	}

	var propAllAvailableDays = function() {
		$(document).find('.checkbox').each(function(index, el) {
			$(this).prop('checked', true);
		});
	}

	var unPropAvailableDays = function() {
		$(document).find('.checkbox').each(function(index, el) {
			$(this).change(function(event) {
				
				if ($(this).prop('checked') == true) {
					var parent = $(this).parent('div').parent('.row');

					parent.find('.form-control').each(function(index, el) {
						$(this).attr('readonly', false);
					});
				}
				else if ($(this).prop('checked') == false) {
					var parent = $(this).parent('div').parent('.row');

					parent.find('.form-control').each(function(index, el) {
						$(this).val("");
						$(this).attr('readonly', true);
					});
				}
				
			});
		});
	}

	var hideAlertsDanger = function() {
		$(document).find('.alert-danger').each(function(index, el) {
			$(this).hide();
		});
	}

	var ifAnyError = function(data) {
		$('.alert-danger').show();
		$('.alert-danger').append('<i class="fa fa-warning" aria-hidden="true"></i> &nbsp<span>'+ data +'<span> <br>');
		hideErrors()	
	}

	var hideErrors = function() {
		$('.error').delay(10000).fadeOut('slow', function() {
			$('.alert-danger').empty();
		});
	}

	var btnChooseCounter = 0;
	var editDelDropdownBtn = function(e) {
		$(document).on('click', '.for-edit-delete', function(event) {
			event.preventDefault();
			event.stopPropagation();

			if (btnChooseCounter == 0) {
				$(this).siblings('.btn-choose').attr('hidden', false).show('fast');
				btnChooseCounter++;
			} else {
				$('.btn-choose').hide('slow');
				$(this).siblings('.btn-choose').attr('hidden', false).show('fast');
			}

		});
	}

	var outsideClick = function() {
		$(document).on('click', function(event) {
			btnChooseCounter = 0;
			$('.btn-choose').hide('slow');
		});
	}

	var deleteTeacher = function() {
		$(document).on('click', '.delete', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');

			$.ajax({
				type: 'GET',
				url: '/admin/teachers/delete',
				data: {
					type: id[0],
					id: id[1],
					'_token':$('input[name=_token]').val(),
				},
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {
						
						bootbox.alert('<div>'+ data.message +'</div>');
						loadTeacherData()

					}

				}
			});

		});
	}

	var editTeacher = function() {
		$(document).on('click', '.edit', function(event) {
			event.preventDefault();
			event.stopPropagation();
			var id = $(this).attr('id').split('-');


			$.ajax({
				type: 'GET',
				url: '/admin/teachers/edit',
				data: {
					type: id[0],
					id: id[1],
					'_token':$('input[name=_token]').val(),
				},
				cache: false,
				dataType: 'json',
				success: function(data) {
					
					$('#upd_firstName').val(data.first_name);
					$('#upd_lastName').val(data.last_name);
					$('#upd_contact').val(data.contact_number);
					$('#upd_email').val(data.email);
					$('#upd_id').val(data.id);

					if (data.address == null) {
						$('#upd_address').attr('placeholder', 'No data inputted.');
					} else {
						$('#upd_address').val(data.address);
					}

				}
			});

		});
	}

	var disabledFirstFormButton = function() {
		$(document).find('#goAvaiDays').each(function(index, el) {
			$(this).attr('disabled', true);
			$(this).attr('title', 'Fill-up the form above to proceed in the next page.');
		});
	}

	var ifRequirementsDone = function() {
		$(document).keyup(function(event) {
			var firstName = $('#id-firstname').val();
			var lastName = $('#id-lastname').val();
			var contact = $('#id-contact').val();
			var email = $('#id-email').val();

			if (firstName != '' && lastName != '' &&
				contact != '' && email != '') {

				$(document).find('#goAvaiDays').each(function(index, el) {
					$(this).attr('disabled', false);
					$(this).attr('title', 'Click to proceed in the next form.');
				});
			}


		});
	}

	var updateTeacherData = function() {
		$(document).on('submit', '#updateTeacherData', function(event) {
			event.preventDefault();

			$.ajax({
				type: 'POST',
				url: '/admin/teachers/update',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$('#editData').modal('hide');
						bootbox.alert('<div> '+ data.message +' </div>');
						loadTeacherData()

					}

				}
			});

		});
	}

	var removeInfo = function() {
		$('#close-1').on('click', function(event) {
			event.preventDefault();

			$('#info').animate({
				height: 'toggle',
				opacity: 'toggle'
			}, 'slow');

		});
	}

	var enUpdateBtn = function() {
		$(document).on('keyup', '.form-control', function(event) {
			event.preventDefault();
			
			$('#u_btn').attr('disabled', false);
			forClose()
		});
	}

	var forClose = function() {
		$('.modal').on('hidden.bs.modal', function(){
			
			$('#u_btn').attr('disabled', true);
			$(document).find('.empty-me').each(function(index, el) {
				$(this).val("");
			});

		});
	}

	var changeActive = function() {
		$(document).find('.active').removeClass('active');

		$(document).find('ul.treeview-menu').addClass('active');
		$(document).find('ul').each(function() {
			$(this).find('li:nth-child(2)').addClass('active');
		});
	}

	


	return {
		init: function() {
			changeActive()
			hideSecondForm()
			gotoSecondForm()
			gotoFirstForm()
			addTeacherData()
			ifRequirementsDone()
			resetForm()
			loadTeacherData()
			editDelDropdownBtn()
			disabledFirstFormButton()
			updateTeacherData()
			outsideClick()
			deleteTeacher()
			editTeacher()
			propAllAvailableDays()
			unPropAvailableDays()
			hideAlertsDanger()
			removeInfo()
			enUpdateBtn()
			forClose()
		}
	};
}();