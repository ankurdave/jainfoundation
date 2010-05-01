// === FORM VALIDATION RULES ===================================================
$(document).ready(function() {
	$("#register-form").validate({
		rules: {
			degree_other: {
				requiredIfFieldEq: [ "degree", "other" ]
			},

			position_other: {
				requiredIfFieldEq: [ "position", "other" ]
			},

			institution_profile_other: {
				requiredIfFieldEq: [ "institution_profile", "other" ]
			}
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
	showFieldWhenFieldEq("#degree", "other", "#degree_other");
	showFieldWhenFieldEq("#position", "other", "#position_other");
	showFieldWhenFieldEq("#institution_profile", "other", "#institution_profile_other");
	showFieldWhenFieldEq("#author_status", "postdoc", "#degree_year");
	showFieldWhenFieldEq("#author_status", "other", "#author_status_other");
});

// === OTHER ===================================================================

function fillSampleValues() {
	$("#firstname").val("Ankur");
	$("#middlename").val("");
	$("#lastname").val("Dave");
	$("#degree").val("BS");
	$("#position").val("undergrad_student");
	$("#department").val("Electrical Engineering and Computer Science Department");
	$("#institution").val("University of California, Berkeley");
	$("#institution_profile").val("academic");
	$("#street_address").val("1234 Example Ln.");
	$("#city").val("Bellevue");
	$("#state_province").val("WA");
	$("#zip_postal_code").val("98001").val();
	$("#country").val("USA");
	$("#email").val("ankurdave@gmail.com");
	$("#phone").val("(425) 123-4567");
}