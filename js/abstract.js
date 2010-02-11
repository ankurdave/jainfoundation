// Set up form validation
$(document).ready(function() {
	$("#abstract-form").validate({
		rules: {
			firstname: { required: true },
			lastname: { required: true },
			degree: { required: true },
			institution: { required: true },
			street_address: { required: true },
			city: { required: true },
			state_province: { required: true },
			zip_postal_code: { required: true },
			country: { required: true },
			phone: { required: true },
			email: { required: true, email: true },
			author_status: { required: true },
			degree_year: {
				required: function(element) {
					return $("#author_status").val() == "postdoc";
				}
			},
			picture: { required: true },
			
			affiliation_1: { required: true },
			author_1_firstname: { required: true },
			author_1_lastname: { required: true },
			author_1_affiliation: { required: true },
			
			abstract_category: { required: true },
			abstract_category_other: {
				required: function(element) {
					return $("#abstract_category").val() == "other";
				}
			},
			presentation_type: { required: true },
			
			abstract_title: { required: true },
			abstract_body: { required: true }
		}
	});
});

// Set the custom validator messages
$.extend($.validator.messages, {
  required: " (required) ",
  email: " (must be a valid email address) "
});

// Whenever author_status changes, rerun the degree_year required check
$("#author_status").change(function () {
	$("#degree_year").valid();
});

// Whenever abstract_category changes, rerun the abstract_category_other required check
$("#abstract_category").change(function () {
	$("#abstract_category_other").valid();
});

// Make all text input fields autogrow
$(document).ready(function () {
	$("input[type='text']").autoGrowInput();
});
