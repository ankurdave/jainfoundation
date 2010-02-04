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
					},
				},
				abstract_category: { required: true },
				abstract_category_other: {
					required: function(element) {
						return $("#abstract_category").val() == "other";
					},
				},
				presentation_type: { required: true },
			},
		});
	});
	
	// Set the custom validator messages
	$.extend($.validator.messages, {
	  required: " (required) ",
	  email: " (must be a valid email address) ",
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

<?php if (isset($_GET['error_general'])) { ?>
	<p class="error">Something bad happened!</p>
<?php } ?>

<form action="abstract-submit" method="post" id="abstract-form">
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
	</table>
	
	<h3>Abstract Information</h3>
	
	<p>Please select the best category for the topic of your abstract.  If your abstract is outside one of the listed categories, please choose "other" and list an alternative category.</p>
	
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
		<?php print_text_field('abstract_category_other', 'Other abstract category') ?>
			<script type="text/javascript">
				// Whenever abstract_category changes, show or hide abstract_category_other
				$("#abstract_category").change(function () {
					// The use of .closest("tr") is a bit of a hack -- what if we switch to non-table-based layouts?
					if ($("#abstract_category").val() == "other") {
						$("#abstract_category_other").closest("tr").css("display", "");
					} else {
						$("#abstract_category_other").closest("tr").css("display", "none");
					}
				}).change();
			</script>
	</table>
	
	<p>Please select whether you would prefer an oral or poster presentation.  However, please note that the decision regarding the type of presentation is at the complete discretion of the Jain Foundation.</p>
	
	<table>
		<?php
			print_select_field('presentation_type', 'Desired Type of Presentation', array(
				'' => '',
				'oral' => 'Oral',
				'poster' => 'Poster',
			));
		?>
	</table>
	
	
	<p><input type="submit" name="submitted" value="Submit"></p>
</form>


</div>
</body>
</html>
