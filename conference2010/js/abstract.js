// === FORM VALIDATION RULES ===================================================
$(document).ready(function() {
	$("#abstract-form").validate({
		rules: {
			degree_year: {
				fieldEq: [ "author_status", "postdoc" ]
			},
			
			author_status_other: {
				fieldEq: [ "author_status", "other" ]
			},
			
			picture: {
				accept: "png,jpe?g"
			},
			
			abstract_category_other: {
				fieldEq: [ "abstract_category", "other" ]
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
// fieldEq: Field is required if another field {0} is equal to a value {1}
$.validator.addMethod("fieldEq", function(value, element, params) {
	if ($("#" + params[0]).val() == params[1]) {
		return value;
	} else {
		return true;
	}
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
// author_status and degree_year
$(document).ready(function() {
	$("#author_status").change(function () {
		if ($("#author_status").val() == "postdoc") {
			$("#degree_year").closest("tr").css("display", "");
		} else {
			$("#degree_year").closest("tr").css("display", "none");
		}
	}).change();
});

// author_status and author_status_other
$(document).ready(function() {
	$("#author_status").change(function () {
		if ($("#author_status").val() == "other") {
			$("#author_status_other").closest("tr").css("display", "");
		} else {
			$("#author_status_other").closest("tr").css("display", "none");
		}
	}).change();
});

// abstract_category and abstract_category_other
$(document).ready(function() {
	$("#abstract_category").change(function () {
		if ($("#abstract_category").val() == "other") {
			$("#abstract_category_other").closest("tr").css("display", "");
		} else {
			$("#abstract_category_other").closest("tr").css("display", "none");
		}
	}).change();
});

// *name and author_1_*name
$(document).ready(function() {
	$("#firstname").change(function() {
		$("#author_1_firstname").val($("#firstname").val());
	});
	$("#middlename").change(function() {
		$("#author_1_middlename").val($("#middlename").val());
	});
	$("#lastname").change(function() {
		$("#author_1_lastname").val($("#lastname").val());
	});
});

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
		$("#authors tbody").append('<tr id="author_' + n + '"><th class="label">Author #' + n + '</th><td><input type="text" id="author_' + n + '_firstname" name="author_' + n + '_firstname"></td><td><input type="text" id="author_' + n + '_middlename" name="author_' + n + '_middlename"></td><td><input type="text" id="author_' + n + '_lastname" name="author_' + n + '_lastname"></td><td><input type="text" class="affiliation_reference" id="author_' + n + '_affiliation" name="author_' + n + '_affiliation"></td></tr>');
	});
});

// Validate the abstract body immediately, so that the word count is continuously calculated
$(document).ready(function() {
	$("#abstract_body").valid();
});

// Set up the Fill Sample Values button
function fillSampleValues() {
	$("#firstname").val("Ankur").change();
	$("#middlename").val("").change();
	$("#lastname").val("Dave").change();
	$("#degree").val("PhD");
	$("#department").val("Computer Science and Engineering Department");
	$("#institution").val("University of Washington");
	$("#street_address").val("1234 Example Ln.");
	$("#city").val("Bellevue");
	$("#state_province").val("Washington");
	$("#zip_postal_code").val("98001");
	$("#country").val("United States");
	$("#phone").val("(206) 555-1212");
	$("#fax").val("(206) 123-4567");
	$("#email").val("ankurdave@gmail.com");
	$("#author_status").val("other").change();
	$("#author_status_other").val("High School Student");
	$("#affiliation_1").val("Department of Computer Science and Engineering, University of Washington, Seattle, Washington, United States");
	$("#affiliation_2").val("School of Computer Science, Carnegie Mellon University, Pittsburgh, Pennsylvania, United States");
	$("#author_1_affiliation").val("1");
	$("#author_2_firstname").val("Joe");
	$("#author_2_middlename").val("D.");
	$("#author_2_lastname").val("Bloggs");
	$("#author_2_affiliation").val("1,2");
	$("#abstract_category").val("other").change();
	$("#abstract_category_other").val("Computer Science");
	$("#presentation_type").val("oral");
	$("#abstract_title").val("Optimizing Boggle Boards: An Evaluation of Parallelizable Techniques");
	$("#abstract_body").val("This paper's objective is to find efficient, parallelizable techniques of solving global optimization problems. To do this, it uses the specific problem of optimizing the score of a Boggle board.\n\nGlobal optimization problems deal with maximizing or minimizing a given function. This has many practical applications, including maximizing profit or performance, or minimizing raw materials or cost.\n\nParallelization is splitting up an algorithm across many different processors in a way that allows many pieces of work to run simultaneously. As parallel hardware increases in popularity and decreases in cost, algorithms should be parallelizable to maximize efficiency.\n\nBoggle is a board game in which lettered cubes are shaken onto a 4-by-4 grid. The objective is to find words spelled by paths through the grid. The function to maximize is the sum of the scores of all possible words in the board.\n\nIn this paper, the performance of two algorithms for global optimization is investigated: hill climbing and genetic algorithms. Genetic algorithms, which model evolution to find the fittest solutions, are found to be more efficient because they are non-greedy. In addition, a modified genetic algorithm called the coarse-grained distributed genetic algorithm (DGA) is investigated. This algorithm can take advantage of multiple computers, running several semi-independent copies of the algorithm in parallel to provide extra genetic diversity and better performance. The success of the coarse-grained DGA shows that global optimization problems can benefit significantly from parallelization.");
}
