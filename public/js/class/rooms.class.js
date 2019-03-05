var roomMaintenance = function() {

	var mes = function(data=null) {
		if (data != null) {
			alert(data)
			console.log(data)
		} else {
			alert('me')
		}
	}

	var loadRoomData = function(){
		$('#dt-rooms-table').dataTable({
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
			"sAjaxSource": '/load/rooms-table',
			"bAutoWidth": false,
			"bDestroy": true,
		});
	};

	var removeInfo = function() {
		$('#close-1').on('click', function(event) {
			event.preventDefault();
			
			$('#info').animate({
				height: 'toggle',
				opacity: 'toggle'
			}, 'slow');

		});
	}

	var resetBtn = function() {
		$('.reset').on('click', function(event) {
			event.preventDefault();
			
			$(document).find('.tobe-reset').each(function(index, el) {
				$(this).val("");
			});
		});
	}

	var formReset = function() {
		$(document).find('.tobe-reset').each(function(index, el) {
			$(this).val("");
		});
	}

	var errors = function(error) {
		$(document).find('.alert').each(function(index, el) {
			
			$(this).attr('hidden', false);
			$(this).append('<small class="info-small text-light"> <i class="fa fa-warning" aria-hidden="true"></i> &nbsp'+ error +'</small> <br>');


		});
	}

	var storeRoomData = function() {
		$(document).on('submit', '#addRoom', function(event) {
			event.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: '/admin/rooms/add-rooms',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {
						bootbox.alert('<div>'+ data.message +'</div>')
						loadRoomData()
						formReset()
						$(document).find('.alert').attr('hidden', true);

					}
					else if (data.status == false) {
						$(document).find('.alert').empty();

						$.each(data.errors, function(key, val) {
							errors(val)
						});

					}

				}
			});
		});
	}

	var deleteData = function() {
		$(document).on('click', '.delete', function(event) {
			event.preventDefault();

			var id = $(this).attr('id');
			id = id.split('-');

			bootbox.confirm('<div> Do you want delete this row?</div>', function(e) {

				if (e) {
					
					$.ajax({
						type: 'GET',
						url: '/admin/rooms/delete',
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
								loadRoomData()

							}
						},
						error : function(jqXHR, textStatus, errorThrown) {
						    var code = jqXHR.status;

						    alert(code + ' ' + textStatus + ' ' + errorThrown);
						}
					});
				}

			});

		});
	}

	var editData = function() {
		$(document).on('click', '.edit', function(event) {
			event.preventDefault();
			var id = $(this).attr('id').split('-');

			$.ajax({
				type: 'GET',
				url: '/admin/rooms/update',
				data: {
					type: id[0],
					id: id[1],
					'_token':$('input[name=_token]').val(),
				},
				cache: false,
				dataType: 'json',
				success: function(data) {

					if (data.status == true) {

						$('#sc_room_name').val(data.data.room_name);
						$('#sc_room_type').val(data.data.room_type_id);
						$('#sc_start_time').val(data.data.available_time_start);
						$('#sc_finish_time').val(data.data.available_time_finish);
						$('#idtype').val('room-' + data.data.id);

					} else {
						bootbox.alert('<div> Internal Server Error, please contact the developers. </div>')
					}
				}

			});
			
		});
	}

	var ifChangedSomething = function() {
		$(document).on('change', '.if-change', function(e){
			e.preventDefault();
			$(document).find('#roomBtn').attr('disabled', false);
			$(document).find('#roomBtn').attr('title', 'Click to update the changes in database');
		});

		$(document).on('keyup', '.if-change', function(event) {
			event.preventDefault();
			
			$(document).find('#roomBtn').attr('disabled', false);
			$(document).find('#roomBtn').attr('title', 'Click to update the changes in database');
		});
	}

	var updateRoomData = function() {
		$(document).on('submit', '#updateRoomData', function(event) {
			event.preventDefault();
			
			$.ajax({
				type: 'POST',
				url: '/admin/rooms/update-room',
				data: $(this).serialize(),
				cache: false,
				dataType: 'json',
				success: function(data) {
					
					if (data.status == true) {

						$('#editData').modal('hide');
						bootbox.alert('<div> '+ data.message +' </div>');
						loadRoomData()
					}

				}

			});
		});
	}

	var enbtnCounter = 0;
	var enBtn = function() {
		$(document).find('.req').keyup(function(event) {
			/* Act on the event */

			$(document).find('.req').each(function() {

				if ($(this).val() != '') {
					enbtnCounter++;
				}

			});

			if (enbtnCounter == 3) {
				$('#a_btn').attr('disabled', false);

			} else {
				$('#a_btn').attr('disabled', true);
			}

			enbtnCounter = 0;
		});
	}

	var forClose = function() {
		$('.modal').on('hidden.bs.modal', function(){
			
			$(document).find('#roomBtn').attr('disabled', true);
			$(document).find('.if-change').each(function(index, el) {
				$(this).val("");
			});

		});
	}


	return {
		init: function() {
			loadRoomData()

			removeInfo()
			resetBtn()
			ifChangedSomething()
			enBtn()

			storeRoomData()
			deleteData()
			editData()
			updateRoomData()
			
			forClose()
		}
	}
}();