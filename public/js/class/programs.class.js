var programMaintenance = function() {

	var mes = function(data=null) {
		if (data != null) {
			alert(data)
		} else {
			alert('me')
		}
	}

	var loadProgramData = function(){
		$('#dt_program').dataTable({
			"bProcessing": true,
			"sAjaxDataProp": "aaData",
			"language": {
			"emptyTable": "Please select the type of paper..."
			},
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
			"sAjaxSource": '/load/program-table',
			"bAutoWidth": false,
			"bDestroy": true,
		});
	};

	var reset = function() {
		$(document).on('click', '.reset', function(event) {
			event.preventDefault();
			
			$(document).find('.tobe-reset').each(function(index, el) {
				$(this).val('');
			});
		});
	}

	var resetForm = function() {
		$(document).find('.tobe-reset').each(function(index, el) {
			$(this).val('');
		});
	}

	var addProgramData = function() {
		$(document).on('submit', '#addProgramData', function(event) {
			event.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: '/admin/programs/add-data',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$(document).find('.alert').attr('hidden', true);
						bootbox.alert('<div> '+ data.message +' </div>');
						loadProgramData()
						resetForm()
						disAddBtn()
					}
					else if (data.status == false) {
						if (data.errors) {
							$(document).find('.alert').empty();

							$.each(data.errors, function(key, val) {
								errors(val)
							});
						}
					}
				}
			});

		});
	}

	var disAddBtn = function() {
		$(document).find('#addProgram').attr('disabled', true);
		$(document).find('#addProgram').attr('title', 'Fill-up the form in order to enable this button.');
	}

	var requiredInputs = 0;
	var enAddBtn = function() {
		$(document).keyup(function(event) {
			
			$(document).find('.required').each(function() {

				if ($(this).val() != '') {
					requiredInputs++;
				}
			});

			if (requiredInputs >= 3) {
				$(document).find('#addProgram').attr('disabled', false);
				$(document).find('#addProgram').attr('title', 'Click to store your data.');
			} else {
				$(document).find('#addProgram').attr('disabled', true);
			}

			requiredInputs = 0;
		});
	}

	var errors = function(error) {
		$(document).find('.alert').each(function(index, el) {
			$(this).attr('hidden', false);
			$(this).append('<small class="info-small text-light"> <i class="fa fa-warning" aria-hidden="true"></i> &nbsp'+ error +'</small> <br>');
		});
	}

	var deleteProgramData = function() {
		$(document).on('click', '.delete', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');

			bootbox.confirm('<div>Do you want delete this row?</div>', function(e) {
				
				if (e) {

					$.ajax({
						type: 'GET',
						url: '/admin/programs/delete',
						data: {
							type: id[0],
							id: id[1],
							'_token':$('input[name=_token]').val(),
						},
						cache: false,
						dataType: 'json',
						success: function(data) {

							if (data.status == true) {
								bootbox.alert('<div> '+ data.message +' </div>');
								loadProgramData()
							}
						}
					});

				}
			});
		});
	}

	var showProgramData = function() {
		$(document).on('click', '.edit', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');

			$.ajax({
				type: 'GET',
				url: '/admin/programs/show',
				data: {
					type: id[0],
					id: id[1],
					'_token':$('input[name=_token]').val(),
				},
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$('#sc_academic_year').val(data.ay);
						$('#sc_title').val(data.p.title);
						$('#sc_level').val(data.p.levels);
						$('#sc_description').val(data.p.description);
						$('#u_btn').attr('disabled', true);
						$('#idtype').val('program-'+data.p.id);
					}
				}
			});
		});
	}

	var enUpdateBtn = function() {
		$(document).on('keyup', '.empty-me', function(event) {
			event.preventDefault();
			
			$(document).find('#u_btn').attr('disabled', false);
		});
	}

	var updateProgramData = function() {
		$(document).on('submit', '#updateProgramData', function(e) {
			e.preventDefault();

			$.ajax({
				type: 'POST',
				url: '/admin/programs/update',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {
					
					if (data.status == true) {
						$('#editData').modal('hide');
						bootbox.alert('<div> '+ data.message +' </div>');
						loadProgramData()
					}
				}
			});
		});
	}

	var forClose = function() {
		$('.modal').on('hidden.bs.modal', function(){
			
			$(document).find('#u_btn').attr('disabled', true);
			$(document).find('.empty-me').each(function(index, el) {
				$(this).val("");
			});

		});
	}




	return {
		init: function() {
			loadProgramData()
			disAddBtn()
			enAddBtn()
			enUpdateBtn()

			reset()

			addProgramData()
			deleteProgramData()
			showProgramData()
			updateProgramData()
			forClose()
		}
	}
}();