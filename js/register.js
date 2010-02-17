// === FORM VALIDATION RULES ===================================================
$(document).ready(function() {
	$("#register-form").validate({
		rules: {
			degree_other: {
				fieldEq: [ "degree", "other" ]
			},
			
			position_other: {
				fieldEq: [ "position", "other" ]
			},
			
			institution_profile_other: {
				fieldEq: [ "institution_profile", "other" ]
			},
			
			arrival_date: {
				fieldChecked: "#share_room input[type=radio][value='yes']"
			},
			
			departure_date: {
				fieldChecked: "#share_room input[type=radio][value='yes']"
			}
		},
		errorPlacement: function(error, element) {
			// If we're in a table, but not a multi-text one, then put the error in the next cell. Otherwise do the default action.
			if (element.closest("table") && !element.closest("table").hasClass("multitext")) {
				error.appendTo(element.parent().next());
			} else {
				error.insertAfter(element);
			}
		}
	});
});

// Set the custom validator messages
$.extend($.validator.messages, {
	required: "required",
	email: "must be a valid email address",
	accept: "must be a PNG or JPEG image"
});

// Returns the word count of a jQuery form element
// Utility function for maxWords validation method below
function wordCount(element) {
	return element.val().split(/\W+/).length;
}

// === FORM VALIDATION METHODS =================================================
// fieldEq: Field is required if another field with id {0} is equal to a value {1}
$.validator.addMethod("fieldEq", function(value, element, params) {
	if ($("#" + params[0]).val() == params[1]) {
		return value;
	} else {
		return true;
	}
}, $.validator.messages.required);

// fieldChecked: Field is required if another field {0} has a nonempty attribute "checked"
$.validator.addMethod("fieldChecked", function(value, element, param) {
	return $(param).attr('checked') ? value : true;
}, $.validator.messages.required);

// maxWords: Field can have at most {0} words
$.validator.addMethod("maxWords", function(value, element, wordLimit) {
	var count = wordCount($(element));

	// Show the user the count
	// This is an ugly optimization -- it should be in its own function, bound separately to each field that requires it, but that would mean we count the words twice. An unfortunate side effect of this optimization is that maxWords can only be used on one element.
	$("#word_count_text").css('display', 'block');
	$("#word_count").html(count);
	
	// Check if the count is within limits
	return count <= wordLimit;
}, $.validator.format("word limit: {0} words"));

// affiliation_reference: For each number (comma-separated) in field, #affiliation_N must be filled
$.validator.addMethod("affiliation_reference", function(value, element) {
	if (!value) {
		return true;
	}
	
	var affiliations = value.split(/,/);
	for (var i in affiliations) {
		if (!$("#affiliation_" + affiliations[i]).val()) {
			return false;
		}
	}
	return true;
}, "a referenced affiliation is empty");

// === FORM FIELD LINKAGES =====================================================
function showFieldWhenFieldEq(sourceField, value, targetField) {
	$(document).ready(function() {
		$(sourceField).change(function () {
			if ($(this).val() == value) {
				$(targetField).closest("tr").css("display", "");
			} else {
				$(targetField).closest("tr").css("display", "none");
			}
		}).change();
	});
}

function showElementWhenFieldEq(sourceField, value, element) {
	$(document).ready(function() {
		$(sourceField).change(function () {
			if ($(this).val() == value) {
				$(element).css("display", "");
			} else {
				$(element).css("display", "none");
			}
		}).change();
	});
}

function showElementWhenRadioChecked(sourceField, elementChecked, elementUnchecked) {
	$(document).ready(function() {
		$(sourceField).change(function() {
			$(elementChecked).css("display", $(this).attr('checked') ? "" : "none");
			$(elementUnchecked).css("display", $(this).attr('checked') ? "none" : "");
		});
	});
}

showFieldWhenFieldEq("#degree", "other", "#degree_other");
showFieldWhenFieldEq("#position", "other", "#position_other");
showFieldWhenFieldEq("#institution_profile", "other", "#institution_profile_other");
showElementWhenRadioChecked("#share_room input[type=radio][value='yes']", "#share_room_yes", "#share_room_no");
showElementWhenRadioChecked("#share_room input[type=radio][value='no']", "#share_room_no", "#share_room_yes");
showElementWhenFieldEq

// === OTHER ===================================================================

// Set up the Fill Sample Values button
function selectRadio(element_id, value) {
	return $("#" + element_id + " input:radio[value='" + value + "']").attr('checked', 'checked');
}
$(document).ready(function() {
	$("#sample_values").click(function() {
		$("#firstname").val("Ankur");
		$("#lastname").val("Dave");
		$("#degree").val("phd");
		$("#position").val("other").change();
		$("#position_other").val("High School Student");
		$("#institution").val("University of Washington");
		$("#institution_profile").val("academic");
		$("#department").val("Computer Science and Engineering Department");
		$("#street_address").val("1234 Example Ln.");
		$("#city").val("Bellevue");
		$("#state_province").val("Washington");
		$("#zip_postal_code").val("98001");
		$("#country").val("United States");
		$("#email").val("ankurdave@gmail.com");
		$("#phone").val("(206) 555-1212");
		$("#fax").val("(206) 123-4567");
		selectRadio('submitting_abstract', 'yes');
		selectRadio('local_attendee', 'yes');
		selectRadio('hotel_parking', 'yes');
		selectRadio('attendance_day1', 'yes');
		selectRadio('attendance_day2', 'yes');
		selectRadio('attendance_day3', 'unknown');
		selectRadio('attendance_day4', 'no');
		selectRadio('meals_day2_breakfast', 'no');
		selectRadio('meals_day2_lunch', 'yes');
		selectRadio('meals_day3_breakfast', 'yes');
		selectRadio('meals_day3_lunch', 'yes');
		selectRadio('meals_day4_breakfast', 'yes');
		selectRadio('meals_day4_lunch', 'unknown');
		selectRadio('meals_day1_breakfast', 'unknown');
		$("#meals_gala_dinner_numguests").val('1');
		selectRadio('share_room', 'yes').change();
		selectRadio('gender', 'male');
		$("#arrival_date").val('2010-09-11');
		$("#departure_date").val('2010-09-14');
	});
});

$(document).ready(function() {
	$("#calculate_fee").click(function() {
		var base_fee = 0;
		switch ($("#position").val()) {
			case "faculty_researcher":
				base_fee = researcher_fee;
				break;
			case "postdoc":
				base_fee = postdoc_fee;
				break;
			default:
				base_fee = other_fee;
		}
		
		var gala_dinner_guest_fee = 0;
		if (!isNaN(parseInt($("#meals_gala_dinner_numguests").val()))) {
			gala_dinner_guest_fee = 50 * parseInt($("#meals_gala_dinner_numguests").val());
		}

		var total_fee = base_fee + gala_dinner_guest_fee;

		$("#base_fee").html(base_fee);
		$("#gala_dinner_guest_fee").html(gala_dinner_guest_fee);
		$("#total_fee").html(total_fee);
		
		$("#price").css("display", "");
	});
});
