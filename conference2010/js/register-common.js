// Affiliation references are required if any of the other fields in the row are filled
$.validator.addClassRules("affiliation", {
	required: function(element) {
		return $(element).closest("tr").find("input").filter(function(index) {
			return $(this).val();
		}).length > 0;
	}
});

// Gala guest vegetarian options are required if visible
$.validator.addClassRules("gala-guest-vegetarian", {
	requiredIfAllFieldsChecked: "#meals_gala_dinner input[value='yes'], #meals_gala_dinner_guests input[type=radio][value='yes']"
});


// Set the custom validator messages
$.extend($.validator.messages, {
	required: "required",
	email: "must be a valid email address",
	accept: "must be a PNG or JPEG image"
});

// Do not validate forms with error class
$.validator.defaults.ignore = ".editing";

// Returns the word count of a jQuery form element
// Utility function for maxWords validation method below
// This is slow, because each time there's a keystroke it goes through the entire string.
// TODO: implement an incremental counter using keystrokes, with full scans periodically, or add a delay between keystrokes and counting similar to js2-mode
function wordCount(element) {
	var string = element.val();
	return $.grep($.trim(string).split(/\W+/), function(element, index) {
		return element != "";
	}).length;
}

function requiredHighlight(element, required) {
	if (required) {
		$(element).closest("tr").addClass("required");
		$(element).closest("td").addClass("required");
	} else {
		$(element).closest("tr").removeClass("required");
		$(element).closest("td").removeClass("required");
	}
}

function highlightRequiredWithinElement(element) {
	// Check if any fields in the element are required and update the visual style accordingly
	// Do this by calling all of the validation functions in $(element).rules. They will highlight the element automatically.
	$(element).find("input, select, textarea").each(function(index, fieldElement) {
		// Call all of the validation functions in $(fieldElement).rules
		var elementRules = $(fieldElement).rules();
		for (var ruleName in elementRules) {
			$.validator.methods[ruleName].call($.validator.prototype, $(fieldElement).val(), fieldElement, elementRules[ruleName]);
		}
	});
}

// === FORM VALIDATION METHODS =================================================
// satisfyAny: Field is invalid if all referenced validation methods return invalid
$.validator.addMethod("satisfyAny", function(value, element, params) {
	for (var validationMethod in params) {
		if ($.validator.methods[validationMethod].call(this, value, element, params[validationMethod])) {
			return true;
		}
	}
	return false;
}, $.validator.messages.required);

// requiredIfFieldEq: Field is required if another field with id {0} is equal to a value {1}
$.validator.addMethod("requiredIfFieldEq", function(value, element, params) {
	var required = $("#" + params[0]).val() == params[1];
	requiredHighlight(element, required);
	return $.validator.methods.required.call(this, value, element, function(element) {
		return required;
	});
}, $.validator.messages.required);

// requiredIfFieldChecked: Field is required if another field {0} has a nonempty attribute "checked"
$.validator.addMethod("requiredIfFieldChecked", function(value, element, param) {
	var required = $(param).attr("checked");
	requiredHighlight(element, required);
	return $.validator.methods.required.call(this, value, element, function(element) {
		return required;
	});
}, $.validator.messages.required);

// requiredIfAllFieldsChecked: Field is required if all of the given fields {0} have a nonempty attribute "checked"
$.validator.addMethod("requiredIfAllFieldsChecked", function(value, element, param) {
	var required = true;
	$(param).each(function(index, elem) {
		required = required && $(elem).attr("checked");
	});
	requiredHighlight(element, required);

	return $.validator.methods.required.call(this, value, element, function(element) {
		return required;
	});
}, $.validator.messages.required);

// maxWords: Field can have at most {0} words
$.validator.addMethod("maxWords", function(value, element, wordLimit) {
	var count = wordCount($(element));

	// Show the user the count
	// This is an ugly optimization -- it should be in its own function, bound separately to each field that requires it, but that would mean we count the words twice. An unfortunate side effect of this optimization is that maxWords can only be used on one element.
	$("#word_count_text").show("normal");
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
	for (var i = 0; i < affiliations.length; i++) {
		if (!$("#affiliation_" + affiliations[i]).val()) {
			return false;
		}
	}
	return true;
}, "a referenced affiliation is empty");

// === FORM FIELD LINKAGES =====================================================
function showElementWhenFieldMeetsCondition(field, condition, element) {
	// Do the initial showing and hiding with no animation
	if (condition.call(field, field)) {
		highlightRequiredWithinElement(element);
		$(element).show();
	} else {
		$(element).hide();
		highlightRequiredWithinElement(element);
	}

	// Set up future changes to use animation
	$(field).change(function() {
		// Don't use show/hide on table rows, because it messes the layout up
		var fallbackAnimation = $(element).is("tr, th, td");

		// Show or hide the element, and highlight or unhighlight newly required fields within the element.
		// Do the (un)highlighting before showing, but after hiding
		if (condition.call(field, field)) {
			highlightRequiredWithinElement(element);
			if (fallbackAnimation) {
				$(element).fadeIn();
			} else {
				$(element).show("normal");
			}
		} else {
			if (fallbackAnimation) {
				$(element).fadeOut();
			} else {
				$(element).hide("normal");
			}
			highlightRequiredWithinElement(element);
		}
	});
}

function showFieldWhenFieldEq(sourceField, value, targetField) {
	showElementWhenFieldMeetsCondition(sourceField, function(sourceField) {
		return $(sourceField).val() == value;
	}, $(targetField).closest("tr").get(0));
}

function showElementWhenFieldEq(sourceField, value, element) {
	showElementWhenFieldMeetsCondition(sourceField, function(sourceField) {
		return $(sourceField).val() == value;
	}, element);
}

function showElementWhenRadioChecked(sourceField, element) {
	showElementWhenFieldMeetsCondition(sourceField, function(sourceField) {
		return $(sourceField).attr('checked');
	}, element);
}

function hideElementWhenRadioChecked(sourceField, element) {
	showElementWhenFieldMeetsCondition(sourceField, function(sourceField) {
		return !$(sourceField).attr('checked');
	}, element);
}

function syncValueOneWay(sourceField, targetField) {
	$(sourceField).change(function() {
		$(targetField).val($(sourceField)).val();
	}).change();
}