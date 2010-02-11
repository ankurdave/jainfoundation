<?php
	require 'lib.php';
	
	// Default values
	$data = array('author_1_affiliation' => '1');
	
	// Populate the fields with the saved values
	if (isset($_GET['id'])) {
		$data = getAbstract($_GET['id']);
	} else if (isset($_COOKIE['id'])) {
		$data = getAbstract($_COOKIE['id']);
	}
	
	// Escape all data fields before printing
	if ($data) {
		$data_raw = $data;
		$data = array_map('print_html', $data);
	}
	
	printHeader(array('title' => 'Submit an Abstract', 'scripts' => array('js/jquery.js', 'js/jquery.validate.js', 'js/jquery.autogrowinput.js', 'js/abstract.js')));
?>

<h1>Submit an Abstract</h1>

<?php include 'menu.inc.php' ?>

<input type="button" id="sample_values" value="Fill sample values" />
<script type="text/javascript">
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
		$("#country").val("United States").change(); // Update the affiliation
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
</script>

<h2>Call for Abstract</h2>

<p>Instructions and approval of abstract for poster or oral presentations.</p>

<h2>Abstract Submission</h2>

<p>Please fill out the form below and submit it no later than May ??, 2010. You will be informed whether your abstract has been accepted for a poster or oral presentation by May ??, 2010.</p>

<?php if (isset($_GET['error_general'])) { ?>
	<p class="error">Something bad happened!</p>
<?php } ?>

<?php
	if (isset($data['id'])) {
		$data_auth_query_string = "?id=" . $data['id'] . "&auth_key=" . $data['auth_key'];
	} else {
		$data_auth_query_string = '';
	}
?>
<form action="abstract-submit.php<?php echo $data_auth_query_string ?>" method="post" id="abstract-form" enctype="multipart/form-data" encoding="multipart/form-data">
	<h3>Presenting/First Author</h3>
	<table>
		<?php print_text_field($data, 'firstname', 'First Name') ?>
		<?php print_text_field($data, 'middlename', 'Middle Initial', '', null) ?>
		<?php print_text_field($data, 'lastname', 'Last Name') ?>
		<?php print_text_field($data, 'degree', 'Degree', '(MD, PhD, etc.)') ?>
		<?php print_text_field($data, 'department', 'Department', '', null) ?>
		<?php print_text_field($data, 'institution', 'Institution') ?>
		<?php print_text_field($data, 'street_address', 'Street Address') ?>
		<?php print_text_field($data, 'city', 'City') ?>
		<?php print_text_field($data, 'state_province', 'State/Province') ?>
		<?php print_text_field($data, 'zip_postal_code', 'Zip/Postal Code') ?>
		<?php print_text_field($data, 'country', 'Country') ?>
		<?php print_text_field($data, 'phone', 'Phone Number') ?>
		<?php print_text_field($data, 'fax', 'Fax Number', '', null) ?>
		<?php print_text_field($data, 'email', 'Email') ?>
		<?php
			print_select_field($data, 'author_status', 'Author Status', array(
				'' => '',
				'faculty_researcher' => 'Faculty/Researcher',
				'postdoc' => 'Postdoc',
				'grad_student' => 'Graduate Student',
				'undergrad_student' => 'Undergraduate Student',
			));
		?>
		<?php print_text_field($data, 'degree_year', 'Degree Year', '(if postdoc)') ?>
			<script type="text/javascript">
				// Whenever author_status changes, show or hide degree_year
				$("#author_status").change(function () {
					// The use of .closest("tr") is a bit of a hack -- what if we switch to non-table-based layouts?
					if ($("#author_status").val() == "postdoc") {
						$("#degree_year").closest("tr").css("display", "");
					} else {
						$("#degree_year").closest("tr").css("display", "none");
					}
				}).change();
			</script>
		
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<?php print_upload_field('picture', 'Picture', '(max 1 MB)') ?>
	</table>
	
	<h3>All Authors</h3>
	
	<p>Enter all affiliations associated with the authors, one per line, in the following format: Department, Institution, City, State/Province, Country.<br />
	<em>Example:</em> Department of Neurology, Univ. of Washington, Seattle, WA, USA</p>
	<table>
		<?php
			print_text_field($data, "affiliation_1", "Affiliation #1");
		?>
		
		<script type="text/javascript">
			// Updates #affiliation_1 by joining the values of these elements with a comma
			// Note: this always overwrites #affiliation_1 when these elements are changed!
			var updatePrimaryAffiliation = function() {
				var elements = [ "department", "institution", "city", "state_province", "country" ];
				elements = $.map(elements, function(elem, index) {
					if ($("#" + elem).val()) {
						return $("#" + elem).val();
					} else {
						return null; // Ignore the element if it's empty
					}
				});
				$("#affiliation_1").val(elements.join(", "));
			}
			
			$("#department").bind($.browser.msie ? 'propertychange' : 'change', updatePrimaryAffiliation);
			$("#institution").bind($.browser.msie ? 'propertychange' : 'change', updatePrimaryAffiliation);
			$("#city").bind($.browser.msie ? 'propertychange' : 'change', updatePrimaryAffiliation);
			$("#state_province").bind($.browser.msie ? 'propertychange' : 'change', updatePrimaryAffiliation);
			$("#country").bind($.browser.msie ? 'propertychange' : 'change', updatePrimaryAffiliation);
		</script>
		
		<?php
			for ($i = 2; $i <= 8; $i++) {
				print_text_field(&$data, "affiliation_$i", "Affiliation #$i", '', null);
			}
		?>
	</table>
	
	<p>Enter the information for all authors.<br />
	The person listed as the first author <strong>must</strong> be presenting the abstract.
	Please use the affiliation numbers above to indicate each author's affiliation(s).</p>
	<table class="multitext">
		<th>
			<td>First Name (<span class="required">*</span>)</td>
			<td>Middle Initial</td>
			<td>Last Name (<span class="required">*</span>)</td>
			<td>Affiliation (<span class="required">*</span>)</td>
		</th>
		
		<?php
			print_multi_text_field($data, "author_1", "Author #1", array(
				"_firstname" => true,
				"_middlename" => false,
				"_lastname" => true,
				"_affiliation" => true,
			));
		?>
		
		<script type="text/javascript">
			// Update #author_1_* with the information above
			// Note: this always overwrites #author_1_* when these elements are changed!
			
			$("#firstname").bind($.browser.msie ? 'propertychange' : 'change', function() { $("#author_1_firstname").val($("#firstname").val()) });
			$("#middlename").bind($.browser.msie ? 'propertychange' : 'change', function() { $("#author_1_middlename").val($("#middlename").val()) });
			$("#lastname").bind($.browser.msie ? 'propertychange' : 'change', function() { $("#author_1_lastname").val($("#lastname").val()) });
		</script>
		
		<?php
			for ($i = 2; $i <= 8; $i++) {
				print_multi_text_field($data, "author_$i", "Author #$i", array(
					"_firstname" => false,
					"_middlename" => false,
					"_lastname" => false,
					"_affiliation" => false,
				));
			}
		?>
	</table>
	
	<h3>Abstract Information</h3>
	
	<p>Select the best category for the topic of your abstract.  If your abstract is outside one of the listed categories, choose "other" and list an alternative category.</p>
	
	<table>
		<?php
			print_select_field($data, 'abstract_category', 'Abstract Category', array(
				'' => '',
				'stem_cell' => 'Stem cell',
				'gene_therapy' => 'Gene therapy',
				'dysferlin_structure_function' => 'Dysferlin structure/function',
				'therapeutic' => 'Therapeutic',
				'tools' => 'Tools',
				'clinical' => 'Clinical',
				'mechanisms_of_pathology' => 'Mechanisms of pathology',
				'other' => 'Other',
			));
		?>
		<?php print_text_field($data, 'abstract_category_other', 'Other abstract category', '(if other)') ?>
			<script type="text/javascript">
				// Whenever abstract_category changes, show or hide abstract_category_other
				$("#abstract_category").bind($.browser.msie ? 'propertychange' : 'change', function () {
					// The use of .closest("tr") is a bit of a hack -- what if we switch to non-table-based layouts?
					if ($("#abstract_category").val() == "other") {
						$("#abstract_category_other").closest("tr").css("display", "");
					} else {
						$("#abstract_category_other").closest("tr").css("display", "none");
					}
				}).change();
			</script>
	</table>
	
	<p>Select whether you would prefer an oral or poster presentation. However, please note that the decision regarding the type of presentation is at the complete discretion of the Jain Foundation.</p>
	
	<table>
		<?php
			print_select_field($data, 'presentation_type', 'Desired Type of Presentation', array(
				'' => '',
				'oral' => 'Oral',
				'poster' => 'Poster',
			));
		?>
	</table>
	
	<h3>Abstract</h3>
	
	<p><em>Notice:</em> It is the author's sole responsibility to abide by standard regulations for animal care and use, as well as to use of human subjects. All named authors share this responsibility and agree with the submitted text. Research funding source <strong>must</strong> be acknowledged.</p>
	
	<p>Enter the title of your abstract in initial caps, except for capitalized abbreviations (e.g., DNA) and simple words (e.g., "a," "to," "the"). Please do not use special characters&mdash;spell out all Greek letters (e.g., "alpha," "beta").<br />
	<em>Example:</em> "Role of Muscle Stem Cells in the Progression and Treatment of Dysferlinopathy"</p>
	
	<table>
		<?php print_text_field($data, 'abstract_title', 'Abstract Title') ?>
	</table>
	
	<p>Please <strong>do not</strong> enter the abstract title again in the body of the abstract.<br />
	Please limit the body of your abstract to no more than ???? characters.<br />
	Please do not use special characters&mdash;spell out all Greek letters (e.g., "alpha," "beta").</p>
	
	<?php print_textarea_field($data, 'abstract_body', 'Abstract') ?>
	
	<p>
		<input type="submit" name="action" value="Preview">
		<input type="submit" name="action" value="Submit">
	</p>
</form>

<?php
	printFooter();
?>
