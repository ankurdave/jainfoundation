// === FORM VALIDATION RULES ===================================================
$(document).ready(function() {
	$("#register-form").submit(function(event) {
		$("#calculate_fee").click();
	});

	$("#register-form").validate({
		rules: {
			meals_day2_breakfast: { requiredIfFieldChecked: "#attendance_day2 input[value='yes']" },
			meals_day2_lunch: { requiredIfFieldChecked: "#attendance_day2 input[value='yes']" },
			meals_day2_lunch_entree: { requiredIfAllFieldsChecked: "#attendance_day2 input[value='yes'], #meals_day2_lunch input[value='yes']" },

			meals_day3_breakfast: { requiredIfFieldChecked: "#attendance_day3 input[value='yes']" },
			meals_day3_lunch: { requiredIfFieldChecked: "#attendance_day3 input[value='yes']" },
			meals_day3_lunch_entree: { requiredIfAllFieldsChecked: "#attendance_day3 input[value='yes'], #meals_day3_lunch input[value='yes']" },

			meals_day4_breakfast: { requiredIfFieldChecked: "#attendance_day4 input[value='yes']" },
			meals_day4_lunch: { requiredIfFieldChecked: "#attendance_day4 input[value='yes']" },
			meals_day4_lunch_entree: { requiredIfAllFieldsChecked: "#attendance_day4 input[value='yes'], #meals_day4_lunch input[value='yes']" },

			meals_gala_dinner_vegetarian: { requiredIfFieldChecked: "#meals_gala_dinner input[value='yes']" },
			meals_gala_dinner_guests: { requiredIfFieldChecked: "#meals_gala_dinner input[value='yes']" },
			meals_gala_dinner_numguests: { requiredIfAllFieldsChecked: "#meals_gala_dinner input[value='yes'], #meals_gala_dinner_guests input[type=radio][value='yes']" },

			share_room: { requiredIfFieldChecked: "#local_attendee input[value='no']" },
			gender: { requiredIfAllFieldsChecked: "#local_attendee input[value='no'], #share_room input[value='yes']" },
			arrival_date: { requiredIfAllFieldsChecked: "#local_attendee input[value='no'], #share_room input[type=radio][value='yes']" },
			departure_date: { requiredIfAllFieldsChecked: "#local_attendee input[value='no'], #share_room input[type=radio][value='yes']" },

			promo_code: { requiredIfFieldChecked: "#have_promo_code input[value='yes']" }
		},

		errorPlacement: function(error, element) {
			// If we're in a table, but not a multi-text one, then put the error in the next cell. Otherwise do the default action.
			if (element.closest("table") && !element.closest("table").hasClass("multitext")) {
				error.appendTo(element.closest("td").next("td"));
			} else {
				error.insertAfter(element);
			}
		},

		highlight: function(element, errorClass, validClass) {
			$.validator.defaults.highlight.call(this, element, errorClass, validClass);

			// If the element is a radio button, also add and remove the appropriate classes from div#ELEMENT_NAME
			if ($(element).attr("type") == "radio") {
				$.validator.defaults.highlight.call(this, "div#" + $(element).attr("name"), errorClass, validClass);
			}
		},
		unhighlight: function(element, errorClass, validClass) {
			$.validator.defaults.unhighlight.call(this, element, errorClass, validClass);

			// If the element is a radio button, also add and remove the appropriate classes from div#ELEMENT_NAME
			if ($(element).attr("type") == "radio") {
				$.validator.defaults.unhighlight.call(this, "div#" + $(element).attr("name"), errorClass, validClass);
			}
		}
	});
});

// === FORM FIELD LINKAGES =====================================================
$(document).ready(function() {
	// #local_attendee
	showElementWhenRadioChecked("#local_attendee input[type=radio][value='no']", "#local_attendee_no");
	hideElementWhenRadioChecked("#local_attendee input[type=radio][value='yes']", "#local_attendee_no");

	// #gala_dinner_guests
	hideElementWhenRadioChecked("#meals_gala_dinner_guests input[type=radio][value='no']", "#meals_gala_dinner_guests_yes");
	showElementWhenRadioChecked("#meals_gala_dinner_guests input[type=radio][value='yes']", "#meals_gala_dinner_guests_yes");

	// #share_room
	showElementWhenRadioChecked("#share_room input[type=radio][value='yes']", "#share_room_yes");
	hideElementWhenRadioChecked("#share_room input[type=radio][value='yes']", "#share_room_no");
	showElementWhenRadioChecked("#share_room input[type=radio][value='no']", "#share_room_no");
	hideElementWhenRadioChecked("#share_room input[type=radio][value='no']", "#share_room_yes");

	// #payment_type
	showElementWhenRadioChecked("#payment_type input[type=radio][value='check']", "#payment_type_check");
	hideElementWhenRadioChecked("#payment_type input[type=radio][value='check']", "#payment_type_credit_card");
	showElementWhenRadioChecked("#payment_type input[type=radio][value='credit_card']", "#payment_type_credit_card");
	hideElementWhenRadioChecked("#payment_type input[type=radio][value='credit_card']", "#payment_type_check");
	// Make sure both are visible initially
	$("#payment_type_credit_card, #payment_type_check").css("display", "");

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

	// #meals_gala_dinner_numguests -- create the appropriate number of guest vegetarian options
	$("#meals_gala_dinner_numguests").bind($.browser.msie ? 'propertychange' : 'change', function() {
		// Figure out how many guests they are bringing
		var numGuests = 0;
		if (!isNaN(parseInt($("#meals_gala_dinner_numguests").val()))) {
			numGuests = parseInt($("#meals_gala_dinner_numguests").val());
		}

		// Clear the existing guest list
		// TODO: If the user has already made selections, they will be cleared
		$("#meals_gala_dinner_guests_vegetarian").empty();

		// Show/hide the guest list section based on the number of guests
		$("#meals_gala_dinner_guests_nonzero").css("display", numGuests > 0 ? "" : "none");

		// Add the appropriate number of guest input fields to the guest list section
		for (var i = 1; i <= numGuests; i++) {
			$("#meals_gala_dinner_guests_vegetarian").append('<tr><td class="required-indicator"></td><td><label for="meals_gala_dinner_guest_' + i + '_vegetarian">Guest #' + i + ' &ndash; Vegetarian</label></td><td class="input"><div id="meals_gala_dinner_guest_' + i + '_vegetarian"><label><input type="radio" name="meals_gala_dinner_guest_' + i + '_vegetarian" value="yes" class="gala-guest-vegetarian">Yes</label><label><input type="radio" name="meals_gala_dinner_guest_' + i + '_vegetarian" value="no" class="gala-guest-vegetarian">No</label></td><td></td></tr>');
		}
	});

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

});
// === OTHER ===================================================================

// Set up the Calculate Price button
$(document).ready(function() {
	$("#calculate_fee").click(function() {
		// Calculate the base fee, checking for promo code
		var base_fee_promo = promo_code_valid ? 0 : base_fee;

		// Calculate the Gala guest fee
		var gala_dinner_guest_fee = 0;
		if (!isNaN(parseInt($("#meals_gala_dinner_numguests").val()))) {
			gala_dinner_guest_fee = 70 * parseInt($("#meals_gala_dinner_numguests").val());
		}

		// Total it up (gala fee and base fee) and display it
		var total_fee = base_fee_promo + gala_dinner_guest_fee;

		$("#base_fee").html(base_fee_promo);
		$("#gala_dinner_guest_fee").html(gala_dinner_guest_fee);
		$("#total_fee").html(total_fee);

		$("#price").css("display", "");
	});
});

// Set up the Check Promotional Code button
$(document).ready(function() {
	var verifyPromoCode = function() {
		// Do an Ajax request to the server to check the promo code, and show/hide elements and set variables based on the result
		$.getJSON("check-promo.php", {
			promoCode: $("#promo_code").val()
		}, function(data) {
			$("#promo_code").closest("td").next("td").empty();
			if (data.valid) {
				$("#promo_code").closest("td").next("td").append('<label for="promo_code" class="valid">valid promotional code</label>');
			} else {
				$("#promo_code").closest("td").next("td").append('<label for="promo_code" class="invalid">invalid promotional code</label>');
			}

			$("#no_promo_code").css("display", data.valid ? "none" : "");

			var noGuests = !($("#meals_gala_dinner_numguests").val()) || parseInt($("#meals_gala_dinner_numguests").val()) == 0;
			$("#promo_code_valid_and_no_guests").css("display", data.valid && noGuests ? "" : "none");
			$("#payment_info").css("display", data.valid && noGuests ? "none" : "");

			promo_code_valid = data.valid;

			// Calculate the price for the user
			$("#calculate_fee").click();
		});
	};

	$("#check_promo").click(verifyPromoCode);
	$("#promo_code").change(verifyPromoCode);
});

function selectRadio(element_id, value) {
	return $(element_id + " input:radio[value='" + value + "']").attr('checked', 'checked').change();
}

function fillSampleValues() {
	$("#meals_gala_dinner_numguests").val("2").change();
	$("#arrival_date").val("2010-09-08");
	$("#departure_date").val("2010-09-17");
	$("#promo_code").val("jf2010as").change();
	selectRadio("#payment_type", "check");

	selectRadio("", "yes");
	selectRadio("", "fish");
	selectRadio("", "male");

	selectRadio("#local_attendee", "no");
	selectRadio("#attendance_day4", "no");
}