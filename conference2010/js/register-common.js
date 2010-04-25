// Affiliation references are required if any of the other fields in the row are filled
$.validator.addClassRules("affiliation", {
	required: function(element) {
		return $(element).closest("tr").find("input").filter(function(index) {
			return $(this).val();
		}).length > 0;
	}
});

// Set the custom validator messages
$.extend($.validator.messages, {
	required: "required",
	email: "must be a valid email address",
	accept: "must be a PNG or JPEG image"
});

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

// === FORM VALIDATION METHODS =================================================
// requiredIfFieldEq: Field is required if another field with id {0} is equal to a value {1}
$.validator.addMethod("requiredIfFieldEq", function(value, element, params) {
	return $.validator.methods.required.call(this, value, element, function(element) {
		return $("#" + params[0]).val() == params[1];
	});
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
	for (var i = 0; i < affiliations.length; i++) {
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

function syncValueOneWay(sourceField, targetField) {
	$(sourceField).change(function() {
		$(targetField).val($(sourceField)).val();
	});
}