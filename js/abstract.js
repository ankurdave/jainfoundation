// Set up form validation
$(document).ready(function() {
	$("#abstract-form").validate({
		rules: {
			email: { email: true },
			degree_year: {
				required: function(element) {
					return $("#author_status").val() == "postdoc";
				}
			},
			picture: { accept: "png,jpe?g" },
			abstract_category_other: {
				required: function(element) {
					return $("#abstract_category").val() == "other";
				}
			},
			abstract_body: { maxWords: 250 }
		}
	});
});

// Set the custom validator messages
$.extend($.validator.messages, {
	required: " (required) ",
	email: " (must be a valid email address) ",
	accept: " (must be a PNG or JPEG image) "
});

// Returns the word count of a jQuery form element
function wordCount(element) {
	return element.val().split(/\W+/).length;
}

// Create the maxWords validation method
$.validator.addMethod("maxWords", function(value, element, wordLimit) {
	var count = wordCount($(element));

	// Show the user the count
	// This is an ugly optimization -- it should be in its own function, bound separately to each field that requires it, but that would mean we count the words twice. An unfortunate side effect of this optimization is that maxWords can only be used on one element.
	$("#word_count_text").css('display', 'block');
	$("#word_count").html(count);
	
	// Check if the count is within limits
	return count <= wordLimit;
}, $.validator.format(" (word limit: {0} words) "));

// Whenever author_status changes, rerun the degree_year required check
$(document).ready(function() {
	$("#author_status").bind($.browser.msie ? 'propertychange' : 'change', function () {
		$("#degree_year").valid();
	});
});
// Whenever author_status changes, show or hide degree_year
$(document).ready(function() {
	$("#author_status").bind($.browser.msie ? 'propertychange' : 'change', function () {
		if ($("#author_status").val() == "postdoc") {
			$("#degree_year").closest("tr").css("display", "");
		} else {
			$("#degree_year").closest("tr").css("display", "none");
		}
	}).change();
});

// Whenever abstract_category changes, rerun the abstract_category_other required check
$(document).ready(function() {
	$("#abstract_category").bind($.browser.msie ? 'propertychange' : 'change', function () {
		$("#abstract_category_other").valid();
	});
});

// Update #author_1_* with the primary author information
// Note: this always overwrites #author_1_* when these elements are changed!
$(document).ready(function() {
	$("#firstname").bind($.browser.msie ? 'propertychange' : 'change', function() {
		$("#author_1_firstname").val($("#firstname").val());
	});
	$("#middlename").bind($.browser.msie ? 'propertychange' : 'change', function() {
		$("#author_1_middlename").val($("#middlename").val());
	});
	$("#lastname").bind($.browser.msie ? 'propertychange' : 'change', function() {
		$("#author_1_lastname").val($("#lastname").val());
	});
});

// Whenever abstract_category changes, show or hide abstract_category_other
$(document).ready(function() {
	$("#abstract_category").bind($.browser.msie ? 'propertychange' : 'change', function () {
		if ($("#abstract_category").val() == "other") {
			$("#abstract_category_other").closest("tr").css("display", "");
		} else {
			$("#abstract_category_other").closest("tr").css("display", "none");
		}
	}).change();
});

// Make all text input fields autogrow
$(document).ready(function () {
	$("input[type='text']").autoGrowInput();
});

// Set up the Fill Sample Values button
$(document).ready(function() {
	$("#sample_values").click(function() {
		$("#firstname").val("John").change(); // Update the author info
		$("#middlename").val("Q.").change();
		$("#lastname").val("Doe").change();
		$("#degree").val("PhD");
		$("#department").val("Computer Science and Engineering Department");
		$("#institution").val("University of Washington");
		$("#street_address").val("1234 Example Ln.");
		$("#city").val("Seattle");
		$("#state_province").val("Washington");
		$("#zip_postal_code").val("98001");
		$("#country").val("United States");
		$("#phone").val("(206) 555-1212");
		$("#fax").val("(206) 123-4567");
		$("#email").val("johndoe@example.com");
		$("#author_status").val("undergrad_student");
		$("#affiliation_2").val("School of Computer Science, Carnegie Mellon University, Pittsburgh, Pennsylvania, United States");
		$("#author_1_affiliation").val("1");
		$("#author_2_firstname").val("Joe");
		$("#author_2_middlename").val("D.");
		$("#author_2_lastname").val("Bloggs");
		$("#author_2_affiliation").val("2");
		$("#abstract_category").val("stem_cell");
		$("#presentation_type").val("oral");
		$("#abstract_title").val("Optimizing Boggle Boards: An Evaluation of Parallelizable Techniques");
		$("#abstract_body").val("This paper's objective is to find efficient, parallelizable techniques of solving global optimization problems. To do this, it uses the specific problem of optimizing the score of a Boggle board.\n\nGlobal optimization problems deal with maximizing or minimizing a given function. This has many practical applications, including maximizing profit or performance, or minimizing raw materials or cost.\n\nParallelization is splitting up an algorithm across many different processors in a way that allows many pieces of work to run simultaneously. As parallel hardware increases in popularity and decreases in cost, algorithms should be parallelizable to maximize efficiency.\n\nBoggle is a board game in which lettered cubes are shaken onto a 4-by-4 grid. The objective is to find words spelled by paths through the grid. The function to maximize is the sum of the scores of all possible words in the board.\n\nIn this paper, the performance of two algorithms for global optimization is investigated: hill climbing and genetic algorithms. Genetic algorithms, which model evolution to find the fittest solutions, are found to be more efficient because they are non-greedy. In addition, a modified genetic algorithm called the coarse-grained distributed genetic algorithm (DGA) is investigated. This algorithm can take advantage of multiple computers, running several semi-independent copies of the algorithm in parallel to provide extra genetic diversity and better performance. The success of the coarse-grained DGA shows that global optimization problems can benefit significantly from parallelization.\n\nInvestigating these genetic algorithms revealed several modifications that are beneficial to global optimization. These modifications solve the problem of premature convergence (a loss of genetic diversity). Several techniques to solve this problem are investigated, notably incest prevention and migration control, revealing a very significant performance increase.");
	});
});
