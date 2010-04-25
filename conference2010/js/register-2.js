// === FORM VALIDATION RULES ===================================================
$(document).ready(function() {
	$("#register-form").validate({
		rules: {
			picture: {
				accept: "png,jpe?g"
			},

			abstract_category_other: {
				requiredIfFieldEq: [ "abstract_category", "other" ]
			},

			abstract_body: {
				maxWords: 275
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
// #submitting_abstract
showElementWhenRadioChecked("#submitting_abstract input[type=radio][value='yes']", "#submitting_abstract_yes");
hideElementWhenRadioChecked("#submitting_abstract input[type=radio][value='no']", "#submitting_abstract_yes");
showElementWhenRadioChecked("#presenting_author input[type=radio][value='yes']", "#presenting_author_yes");
hideElementWhenRadioChecked("#presenting_author input[type=radio][value='no']", "#presenting_author_yes");
showFieldWhenFieldEq("#author_status", "postdoc", "#degree_year");
showFieldWhenFieldEq("#author_status", "other", "#author_status_other");
showFieldWhenFieldEq("#abstract_category", "other", "#abstract_category_other");

// === OTHER ===================================================================

// For affiliation references, allow only numbers and comma
$(document).ready(function() {
	$(".affiliation_reference").numeric({allow: ","});
});

// Set up the Add More Affiliations button
$(document).ready(function() {
	$("#affiliation_more").click(function() {
		// Calculate the current highest affiliation number
		var n = 1;
		for (var i = 1; true; i++) {
			if ($("#affiliation_" + i).length == 0) {
				n = i;
				break;
			}
		}

		// Add an element with that number
		$("#affiliations tbody").append('<tr id="affiliation_' + n + '_container"><td></td><td><label for="affiliation_' + n + '">Affiliation #' + n + '</label></td><td class="input"><input type="text" id="affiliation_' + n + '" name="affiliation_' + n + '"></td><td></td></tr>');
	});
});

// Set up the Add More Authors button
$(document).ready(function() {
	$("#author_more").click(function() {
		// Calculate the current highest author number
		var n = 1;
		for (var i = 1; true; i++) {
			if ($("#author_" + i).length == 0) {
				n = i;
				break;
			}
		}

		// Add an element with that number
		$("#authors tbody").append('<tr id="author_' + n + '"><th class="label">Author #' + n + '</th><td><input type="text" id="author_' + n + '_firstname" name="author_' + n + '_firstname"></td><td><input type="text" id="author_' + n + '_middlename" name="author_' + n + '_middlename"></td><td><input type="text" id="author_' + n + '_lastname" name="author_' + n + '_lastname"></td><td><input type="text" class="affiliation_reference affiliation" id="author_' + n + '_affiliations" name="author_' + n + '_affiliations"></td></tr>');
	});
});

// Validate the abstract body immediately, so that the word count is continuously calculated
$(document).ready(function() {
	$("#abstract_body").valid();
});
