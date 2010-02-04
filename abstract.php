<?php
	require 'lib.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<link rel="stylesheet" href="style.css">

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript">
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
</script>

<title>Submit an Abstract &ndash; Jain Foundation</title>
</head>

<body>
<div id="container">

<h1>Submit an Abstract</h1>

<?php include 'menu.inc.php' ?>

<h2>Call for Abstract</h2>

<p>Instructions and approval of abstract for poster or oral presentations.</p>

<h2>Abstract Submission</h2>

<p>Please fill out the form below and submit it no later than May ??, 2010. You will be informed whether your abstract has been accepted for a poster or oral presentation by May ??, 2010.</p>

<?php if (isset($_GET['error_general'])) { ?>
	<p class="error">Something bad happened!</p>
<?php } ?>

<form action="abstract-submit" method="post" id="abstract-form" enctype="multipart/form-data">
	<h3>Presenting/First Author</h3>
	<table>
		<?php print_text_field('firstname', 'First Name') ?>
		<?php print_text_field('middlename', 'Middle Initial', '', null) ?>
		<?php print_text_field('lastname', 'Last Name') ?>
		<?php print_text_field('degree', 'Degree', '(MD, PhD, etc.)') ?>
		<?php print_text_field('department', 'Department', '', null) ?>
		<?php print_text_field('institution', 'Institution') ?>
		<?php print_text_field('street_address', 'Street Address') ?>
		<?php print_text_field('city', 'City') ?>
		<?php print_text_field('state_province', 'State/Province') ?>
		<?php print_text_field('zip_postal_code', 'Zip/Postal Code') ?>
		<?php print_text_field('country', 'Country') ?>
		<?php print_text_field('phone', 'Phone Number') ?>
		<?php print_text_field('fax', 'Fax Number', '', null) ?>
		<?php print_text_field('email', 'Email') ?>
		<?php
			print_select_field('author_status', 'Author Status', array(
				'' => '',
				'faculty_researcher' => 'Faculty/Researcher',
				'postdoc' => 'Postdoc',
				'grad_student' => 'Graduate Student',
				'undergrad_student' => 'Undergraduate Student',
			));
		?>
		<?php print_text_field('degree_year', 'Degree Year', '(if postdoc)') ?>
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
		<?php print_upload_field('picture', 'Picture') ?>
	</table>
	
	<h3>All Authors</h3>
	
	<p>Enter all affiliations associated with the authors, one per line, in the following format: Department, Institution, City, State/Province, Country.<br />
	<em>Example:</em> Department of Neurology, Univ. of Washington, Seattle, WA, USA</p>
	<table>
		<?php
			print_text_field("affiliation_1", "Affiliation #1");
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
				print_text_field("affiliation_$i", "Affiliation #$i", '', null);
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
			print_multi_text_field("author_1", "Author #1", array(
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
				print_multi_text_field("author_$i", "Author #$i", array(
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
			print_select_field('abstract_category', 'Abstract Category', array(
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
		<?php print_text_field('abstract_category_other', 'Other abstract category', '(if other)') ?>
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
			print_select_field('presentation_type', 'Desired Type of Presentation', array(
				'' => '',
				'oral' => 'Oral',
				'poster' => 'Poster',
			));
		?>
	</table>
	
	<h3>Abstract</h3>
	
	<p>Enter the title of your abstract in initial caps, except for capitalized abbreviations (e.g., DNA) and simple words (e.g., "a," "to," "the"). Please do not use special characters&mdash;spell out all Greek letters (e.g., "alpha," "beta").<br />
	<em>Example:</em> "Role of Muscle Stem Cells in the Progression and Treatment of Dysferlinopathy"</p>
	
	<table>
		<?php print_text_field('abstract_title', 'Abstract Title') ?>
	</table>
	
	<p>Please <strong>do not</strong> enter the abstract title again in the body of the abstract.<br />
	Please limit the body of your abstract to no more than ???? characters.<br />
	Please do not use special characters&mdash;spell out all Greek letters (e.g., "alpha," "beta").</p>
	
	<?php print_textarea_field('abstract_body', 'Abstract') ?>
	
	<p>
		<input type="submit" name="preview" value="Preview">
		<input type="submit" name="submit" value="Submit">
	</p>
</form>


</div>
</body>
</html>
