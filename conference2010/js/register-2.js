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

function selectRadio(element_id, value) {
	return $(element_id + " input:radio[value='" + value + "']").attr('checked', 'checked').change();
}

function fillSampleValues() {
	selectRadio("#submitting_abstract", "yes");
	$("#abstract_title").val("Optimizing Boggle Boards");
	$("#affiliation_1").val("EECS Department, UC Berkeley, Berkeley, CA, USA");
	$("#affiliation_more").click();
	$("#affiliation_2").val("CSE Department, Univ. of Washington, Seattle, WA, USA");
	$("#author_1_firstname").val("Ankur");
	$("#author_1_lastname").val("Dave");
	$("#author_1_affiliations").val("1");
	$("#author_more").click();
	$("#author_2_firstname").val("John");
	$("#author_2_lastname").val("Doe");
	$("#author_2_affiliations").val("2");
	$("#abstract_category").val("other").change();
	$("#abstract_category_other").val("Computer Science");
	$("#presentation_type").val("oral");
	$("#abstract_body").val("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec in purus erat, a sodales felis. In venenatis, odio et aliquet vehicula, quam lorem facilisis ante, in eleifend nulla diam eget lectus. Sed non turpis in elit gravida suscipit eu ac erat. Nullam id urna id sapien vulputate ornare et non elit. Praesent at bibendum felis. Quisque auctor rutrum massa vel fermentum. Duis ligula nibh, malesuada eu scelerisque ac, ultrices luctus nisi. Aenean rutrum dui elementum ligula tristique imperdiet. Nam malesuada consectetur nisi in dictum. Praesent congue pharetra justo, id mattis augue scelerisque non. Suspendisse potenti. Phasellus iaculis augue sed turpis malesuada eget lacinia mauris eleifend. Mauris ac nisi augue, a lacinia nisi. Aliquam tempor enim vitae arcu auctor convallis vitae ornare elit. Quisque sit amet tempor nisl. Mauris commodo consectetur mollis. Pellentesque tincidunt mi ut dolor pulvinar consequat. Mauris sollicitudin tortor sed odio elementum venenatis.Donec vel justo sapien, non sodales metus. Duis vitae purus est, placerat congue felis. Etiam vitae arcu non ligula interdum pulvinar. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam et arcu nec nunc auctor faucibus. Ut ac urna nibh, at posuere neque. Quisque eget ligula in justo interdum porta. Proin auctor risus sit amet metus rutrum in hendrerit orci laoreet. Suspendisse potenti. Praesent at velit leo. Vivamus rutrum, felis ut pretium tincidunt, felis diam consequat ligula, venenatis cursus mi tellus sed enim. Aenean tincidunt, libero non scelerisque porttitor, neque risus convallis risus, a commodo leo dolor et urna. Praesent convallis, enim ac lobortis lacinia, justo velit posuere mauris, nec scelerisque justo nisl sit amet nunc. Nullam porta lectus mi. Proin fringilla commodo quam.");
}