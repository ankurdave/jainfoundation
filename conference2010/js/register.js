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
			},

			// meals_day2_* are required if attendance_day2 is checked. meals_day2_lunch_entree additionally requires that meals_day2_lunch is checked.
			meals_day2_breakfast: {
				required: function(element) {
					return $("#attendance_day2 input[type=radio][value='yes']").attr('checked');
				}
			},
			meals_day2_lunch: {
				required: function(element) {
					return $("#attendance_day2 input[type=radio][value='yes']").attr('checked');
				}
			},
			meals_day2_lunch_entree: {
				required: function(element) {
					return $("#attendance_day2 input[type=radio][value='yes']").attr('checked')
							&& $("#meals_day2_lunch input[type=radio][value='yes']").attr('checked');
				}
			},
			
			// meals_day3_* are required if attendance_day3 is checked. meals_day3_lunch_entree additionally requires that meals_day3_lunch is checked.
			meals_day3_breakfast: {
				required: function(element) {
					return $("#attendance_day3 input[type=radio][value='yes']").attr('checked');
				}
			},
			meals_day3_lunch: {
				required: function(element) {
					return $("#attendance_day3 input[type=radio][value='yes']").attr('checked');
				}
			},
			meals_day3_lunch_entree: {
				required: function(element) {
					return $("#attendance_day3 input[type=radio][value='yes']").attr('checked')
							&& $("#meals_day3_lunch input[type=radio][value='yes']").attr('checked');
				}
			},

			// meals_day4_* are required if attendance_day4 is checked. meals_day4_lunch_entree additionally requires that meals_day4_lunch is checked.
			meals_day4_breakfast: {
				required: function(element) {
					return $("#attendance_day4 input[type=radio][value='yes']").attr('checked');
				}
			},
			meals_day4_lunch: {
				required: function(element) {
					return $("#attendance_day4 input[type=radio][value='yes']").attr('checked');
				}
			},
			meals_day4_lunch_entree: {
				required: function(element) {
					return $("#attendance_day4 input[type=radio][value='yes']").attr('checked')
							&& $("#meals_day4_lunch input[type=radio][value='yes']").attr('checked');
				}
			},

			// meals_gala_dinner_vegetarian is required if meals_gala_dinner is checked.
			meals_gala_dinner_vegetarian: {
				requiredIfFieldChecked: "#meals_gala_dinner input[type=radio][value='yes']"
			}
		},
		errorPlacement: function(error, element) {
			// If we're in a table, but not a multi-text one, then put the error in the next cell. Otherwise do the default action.
			if (element.closest("table") && !element.closest("table").hasClass("multitext")) {
				error.appendTo(element.closest("td").next("td"));
			} else {
				error.insertAfter(element);
			}

			// If the element is a radio button, also add a "class='error'" to div#ELEMENT_NAME
			if (element.attr("type") == "radio") {
				$("div#" + element.attr("name")).addClass("error");
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

// requiredIfFieldChecked: Field is required if another field {0} has a nonempty attribute "checked"
$.validator.addMethod("requiredIfFieldChecked", function(value, element, param) {
	return $.validator.methods.required.call(this, value, element, function(element) {
		return $(param).attr("checked");
	});
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

function showElementWhenRadioChecked(sourceField, element) {
	$(document).ready(function() {
		$(sourceField).change(function() {
			$(element).css("display", $(this).attr('checked') ? "" : "none");
		});
	});
}

function hideElementWhenRadioChecked(sourceField, element) {
	$(document).ready(function() {
		$(sourceField).change(function() {
			$(element).css("display", $(this).attr('checked') ? "none" : "");
		});
	});
}

showFieldWhenFieldEq("#degree", "other", "#degree_other");
showFieldWhenFieldEq("#position", "other", "#position_other");
showFieldWhenFieldEq("#institution_profile", "other", "#institution_profile_other");

// #local_attendee
showElementWhenRadioChecked("#local_attendee input[type=radio][value='no']", "#local_attendee_no");
hideElementWhenRadioChecked("#local_attendee input[type=radio][value='yes']", "#local_attendee_no");

// #gala_dinner_guests
hideElementWhenRadioChecked("#meals_gala_dinner_guests input[type=radio][value='no']", "#meals_gala_dinner_guests_yes");
showElementWhenRadioChecked("#meals_gala_dinner_guests input[type=radio][value='yes']", "#meals_gala_dinner_guests_yes");
showElementWhenRadioChecked("#meals_gala_dinner_guests input[type=radio][value='unknown']", "#meals_gala_dinner_guests_yes");

// #share_room
showElementWhenRadioChecked("#share_room input[type=radio][value='yes']", "#share_room_yes");
hideElementWhenRadioChecked("#share_room input[type=radio][value='yes']", "#share_room_no");
showElementWhenRadioChecked("#share_room input[type=radio][value='no']", "#share_room_no");
hideElementWhenRadioChecked("#share_room input[type=radio][value='no']", "#share_room_yes");

// #submitting_abstract
showElementWhenRadioChecked("#submitting_abstract input[type=radio][value='yes']", "#submitting_abstract_yes");
hideElementWhenRadioChecked("#submitting_abstract input[type=radio][value='no']", "#submitting_abstract_yes");

// #payment_type
showElementWhenRadioChecked("#payment_type input[type=radio][value='check']", "#payment_type_check");
hideElementWhenRadioChecked("#payment_type input[type=radio][value='check']", "#payment_type_credit_card");
showElementWhenRadioChecked("#payment_type input[type=radio][value='credit_card']", "#payment_type_credit_card");
hideElementWhenRadioChecked("#payment_type input[type=radio][value='credit_card']", "#payment_type_check");

// #meals_day2_lunch
showElementWhenRadioChecked("#meals_day2_lunch input[type=radio][value='yes']", "#meals_day2_lunch_entree_container");
hideElementWhenRadioChecked("#meals_day2_lunch input[type=radio][value='no']", "#meals_day2_lunch_entree_container");

// #meals_day3_lunch
showElementWhenRadioChecked("#meals_day3_lunch input[type=radio][value='yes']", "#meals_day3_lunch_entree_container");
hideElementWhenRadioChecked("#meals_day3_lunch input[type=radio][value='no']", "#meals_day3_lunch_entree_container");

// #meals_day4_lunch
showElementWhenRadioChecked("#meals_day4_lunch input[type=radio][value='yes']", "#meals_day4_lunch_entree_container");
hideElementWhenRadioChecked("#meals_day4_lunch input[type=radio][value='no']", "#meals_day4_lunch_entree_container");

// #meals_gala_dinner
showElementWhenRadioChecked("#meals_gala_dinner input[type=radio][value='yes']", "#meals_gala_dinner_yes");
hideElementWhenRadioChecked("#meals_gala_dinner input[type=radio][value='no']", "#meals_gala_dinner_yes");

// #have_promo_code
showElementWhenRadioChecked("#have_promo_code input[type=radio][value='yes']", "#have_promo_code_yes");
hideElementWhenRadioChecked("#have_promo_code input[type=radio][value='no']", "#have_promo_code_yes");

// #attendance_day{2,3,4}
showElementWhenRadioChecked("#attendance_day2 input[type=radio][value='yes']", "#attendance_day2_yes");
hideElementWhenRadioChecked("#attendance_day2 input[type=radio][value='no']", "#attendance_day2_yes");
showElementWhenRadioChecked("#attendance_day3 input[type=radio][value='yes']", "#attendance_day3_yes");
hideElementWhenRadioChecked("#attendance_day3 input[type=radio][value='no']", "#attendance_day3_yes");
showElementWhenRadioChecked("#attendance_day4 input[type=radio][value='yes']", "#attendance_day4_yes");
hideElementWhenRadioChecked("#attendance_day4 input[type=radio][value='no']", "#attendance_day4_yes");

// === OTHER ===================================================================

// Set up the Fill Sample Values button
function selectRadio(element_id, value) {
	return $("#" + element_id + " input:radio[value='" + value + "']").attr('checked', 'checked');
}
function fillSampleValues() {
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
	$("#abstract_title").val("Optimizing Boggle Boards");
	selectRadio('local_attendee', 'no');
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
	selectRadio('meals_gala_dinner', 'yes');
	selectRadio('meals_gala_dinner_guests', 'yes');
	$("#meals_gala_dinner_numguests").val('1');
	selectRadio('share_room', 'yes').change();
	selectRadio('gender', 'male');
	$("#arrival_date").val('2010-09-11');
	$("#departure_date").val('2010-09-14');
	selectRadio('payment_type', 'check');
}

// Set up the Calculate Price button
$(document).ready(function() {
	$("#calculate_fee").click(function() {
		// Calculate the base fee
		var base_fee = 0;
		if (!promo_code_valid) {
			switch ($("#position").val()) {
				case "postdoc":
				case "grad_student":
				case "undergrad_student":
					base_fee = postdoc_fee;
					break;
				default:
					base_fee = other_fee;
			}
		}
		
		// Calculate the Gala guest fee
		var gala_dinner_guest_fee = 0;
		if (!isNaN(parseInt($("#meals_gala_dinner_numguests").val()))) {
			gala_dinner_guest_fee = 70 * parseInt($("#meals_gala_dinner_numguests").val());
		}

		// Total it up and display it
		var total_fee = base_fee + gala_dinner_guest_fee;

		$("#base_fee").html(base_fee);
		$("#gala_dinner_guest_fee").html(gala_dinner_guest_fee);
		$("#total_fee").html(total_fee);

		$("#price").css("display", "");
	});
});

// Set up the Check Promotional Code button
$(document).ready(function() {
	$("#check_promo").click(function() {
		// Do an Ajax request to the server to check the promo code, and show/hide elements and set variables based on the result
		$.getJSON("check-promo.php", {
			promoCode: $("#promo_code").val()
		}, function(data) {
			$("#promo_code_valid").css("display", data.valid ? "" : "none");
			$("#promo_code_invalid").css("display", data.valid ? "none" : "");
			$("#no_promo_code").css("display", data.valid ? "none" : "");

			var noGuests = !($("#meals_gala_dinner_numguests").val()) || parseInt($("#meals_gala_dinner_numguests").val()) == 0;
			$("#promo_code_valid_and_no_guests").css("display", data.valid && noGuests ? "" : "none");
			$("#payment_info").css("display", data.valid && noGuests ? "none" : "");
			
			promo_code_valid = data.valid;

			// Calculate the price for the user
			$("#calculate_fee").click();
		});
	});
});
