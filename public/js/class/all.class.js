var allMaintenance = function() {

	var mes = function() {
		alert('me')
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



	return {
		dataTableBtn: function() {
			editDelDropdownBtn()
			outsideClick()
		}
	}
}();