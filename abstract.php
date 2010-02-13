<?php
	require 'includes/lib.php';
	
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

<?php include 'includes/menu.inc.php' ?>

<input type="button" id="sample_values" value="Fill sample values" />

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
		<?php print_text_field($data, 'state_province', 'State/Province', '', null) ?>
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
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<?php print_upload_field('picture', 'Picture', isset($_GET['error_picture_size']) ? '<span class="error">(max 1 MB)</span>' : '(max 1 MB)') ?>
	</table>
	
	<h3>All Authors</h3>
	
	<p>Enter all affiliations associated with the authors, one per line, in the following format: Department, Institution, City, State/Province, Country.<br />
	<em>Example:</em> Department of Neurology, Univ. of Washington, Seattle, WA, USA</p>
	<table>
		<?php
			print_text_field($data, "affiliation_1", "Affiliation #1");
		?>
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
		<tr>
			<th></th>
			<th>First Name (<span class="required">*</span>)</th>
			<th>Middle Initial</th>
			<th>Last Name (<span class="required">*</span>)</th>
			<th>Affiliation (<span class="required">*</span>)</th>
		</tr>
		
		<?php
			print_multi_text_field($data, "author_1", "Author #1", array(
				"_firstname" => true,
				"_middlename" => false,
				"_lastname" => true,
				"_affiliation" => true,
			));
		?>
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

	<div>(current word count: <span id="word_count">0</span>)</div>
	
	<p>
		<input type="submit" name="action" value="Preview">
		<input type="submit" name="action" value="Submit">
	</p>
</form>

<?php
	printFooter();
?>
