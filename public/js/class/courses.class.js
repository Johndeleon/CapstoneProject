$(function() {

	var mes = function(data=null) {
		if (data != null) {
			alert(data)
		}
		else {
			alert('me')
		}
	}

	var oTable = function(){
		$('#dt-list-courses').dataTable({
		    "bProcessing": true,
		    "sAjaxDataProp": "aaData",
		    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
		    "aoColumnDefs": [{"bSortable": false, "aTargets": [-1]}],
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
		    "sAjaxSource": '/admin/courses-table',
		    "bAutoWidth": false,
		    "bDestroy": true,
		});
	};

	var ay = $('select').select2({
		theme: 'bootstrap4',
		theme: 'classic',
	});
	var sel_teacher = $('#sel-teacher').select2({
		placeholder: "Select capable teachers",
		theme: 'bootstrap4',
	});

	$(document).on('submit', '#addNewCourse', function(e) {
		e.preventDefault();
		
		$.ajax({
			url: '/add/new-course',
			type: 'POST',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(data) {

				if (data.status == false) {
					var dataErrors = data.errors;

					$.each(dataErrors, function(key, val) {
						showErrs(val)
					});

				} else if(data.status == true) {

					bootbox.alert('<div> '+ data.message +' </div>');

					$(document).find('.emp-form').each(function(index, el) {
						$(this).val("");
					});

					$(document).find('#sel-teacher').each(function(index, el) {
						$(this).val(null).trigger('change');
					});

					oTable()


				} else {
					bootbox.alert('<div class="alert alert-danger"> Server error please contact the developers! </div>');
				}

			} 
			
		});
	}); /*End of new Course*/

	var showErrs = function(data) {
		$(document).find('.alert-danger').each(function(index, el) {
			
			$(this).append('<i class="fa fa-warning" aria-hidden="true"></i> &nbsp<span>'+ data +'<span> <br>');
			$(this).attr('hidden', false);
			$(this).show();
			hideErrors()
		});
	}

	var hideErrors = function() {
		$('.error').delay(5000).fadeOut('slow', function() {
			$('.alert-danger').empty();
		});
	}

	var deleteCourse = function() {
		$(document).on('click', '.delete', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');
			
			bootbox.confirm('<div> Do you want to delete this row of data? </div>', function(e) {

				if (e) {

					$.ajax({
						type: 'GET',
						url: '/admin/courses/delete',
						data: {
							type: id[0],
							id: id[1],
							'_token': $('input[name=_token]').val(),
						},
						cache: false,
						dataType: 'json',
						success: function(data) {

							if (data.status == true) {

								bootbox.alert('<div> '+ data.message +' </div>');
								oTable()
							}
							else if (data.status == false) {

								bootbox.alert('<div> '+ data.message +' </div>');
							}
						}
					});

				}

			});
		});
	}

	var showData = function() {
		$(document).on('click', '.edit', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');
			
			$.ajax({
				type: 'GET',
				url: '/admin/courses/show',
				data: {
					'_token': $('input[name=_token]').val(),
					type: id[0],
					id: id[1],
				},
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$('#sc_ay').val(data.ay);
						$('#sc_sem').val(data.course.semester +'st Semester');
						$('#sc_course').val(data.program);
						$('#sc_code').val(data.course.code);
						$('#sc_title').val(data.course.title);
						$('#typeid').val('course-' + data.course.id);

						/* SHOW TEACHERS */
						$('#sc_teachers_ul').empty();

						$.each(data.teacher ,function(key, val) {
							$('#sc_teachers_ul').append('<li>'+ val.teacher +'</li>');
						});
					}
				}
			});
		});
	}

	var updateData = function() {
		$(document).on('submit', '#updateData', function(event) {
			event.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: '/admin/courses/update',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$('#editData').modal('hide');
						bootbox.alert('<div>'+ data.message +'</div>');
						oTable()
						$('#u_btn').attr('disabled', true);
						$('#u_btn').attr('title', 'Change the inputs you want to proceed.');
					}
				}
			});
		});
	}

	var enUpdateBtn = function() {
		$('.req').keyup(function(event) {
			/* Act on the event */

			$('#u_btn').attr('disabled', false);
			$('#u_btn').attr('title', 'Click here to update your data.');
		});
	}


	oTable()

	deleteCourse()
	showData()
	updateData()
	enUpdateBtn()
});