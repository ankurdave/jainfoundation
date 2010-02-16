<?php
//	error_reporting(E_ALL);
	require 'includes/lib.php';
	
	$submit_location = 'abstract-submit.php';
	
	// Default values
	$values = array('author_1_affiliation' => '1');
	
	// Populate the fields with the saved values
	if (isset($_GET['id'])) {
		$values = getAbstract($_GET['id']);
	} else if (isset($_COOKIE['id'])) {
		$values = getAbstract($_COOKIE['id']);
	}
	
	printHeader(array('title' => 'Conference 2010 | Abstract Submission', 'scripts' => array('js/jquery.js', 'js/jquery.validate.js', 'js/jquery.alphanumeric.js', 'js/abstract.js',), 'page_nav_id' => 'abstract'));
?>

<?php include 'conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<input type="button" id="sample_values" value="Fill sample values" />

<h2>Call for Abstract</h2>

<p>Instructions and approval of abstract for poster or oral presentations.</p>

<h2>Abstract Submission</h2>

<p>Please fill out the form below and submit it no later than May ??, 2010. You will be informed whether your abstract has been accepted for a poster or oral presentation by May ??, 2010.</p>

<?php
	if (isset($values['id'])) {
		$data_auth_query_string = "?id=" . $values['id'] . "&auth_key=" . $values['auth_key'];
	} else {
		$data_auth_query_string = '';
	}
?>
<form action="<?php echo $submit_location . $data_auth_query_string ?>" method="post" id="abstract-form" enctype="multipart/form-data" encoding="multipart/form-data">
	<h3>Presenting/First Author</h3>
	<table>
		<?php
			print_text_field('firstname', array(
				'label' => 'First Name',
				'required' => true,
				'value' => $values,
			));
			print_text_field('middlename', array(
				'label' => 'Middle Initial',
				'required' => false,
				'value' => $values,
			));
			print_text_field('lastname', array(
				'label' => 'Last Name',
				'required' => true,
				'value' => $values,
			));
			print_text_field('degree', array(
				'label' => 'Degree',
				'required' => true,
				'instructions' => '(MD, PhD, etc.)',
				'value' => $values,
			));
			print_text_field('department', array(
				'label' => 'Department',
				'required' => false,
				'value' => $values,
			));
			print_text_field('institution', array(
				'label' => 'Institution',
				'required' => true,
				'value' => $values,
			));
			print_text_field('street_address', array(
				'label' => 'Street Address',
				'required' => true,
				'value' => $values,
			));
			print_text_field('city', array(
				'label' => 'City',
				'required' => true,
				'value' => $values,
			));
			print_text_field('state_province', array(
				'label' => 'State/Province',
				'required' => false,
				'value' => $values,
			));
			print_text_field('zip_postal_code', array(
				'label' => 'Zip/Postal Code',
				'required' => true,
				'value' => $values,
			));
			print_text_field('country', array(
				'label' => 'Country',
				'required' => true,
				'value' => $values,
			));
			print_text_field('phone', array(
				'label' => 'Phone Number',
				'required' => true,
				'value' => $values,
			));
			print_text_field('fax', array(
				'label' => 'Fax Number',
				'required' => false,
				'value' => $values,
			));
			print_text_field('email', array(
				'label' => 'Email',
				'required' => true,
				'class' => array('email'),
				'value' => $values,
			));
			print_select_field('author_status', array(
				'label' => 'Author Status',
				'required' => true,
				'options' => array(
					'' => '',
					'faculty_researcher' => 'Faculty/Researcher',
					'postdoc' => 'Postdoc',
					'grad_student' => 'Graduate Student',
					'undergrad_student' => 'Undergraduate Student',
					'other' => 'Other',
				),
				'value' => $values,
			));
			print_text_field('degree_year', array(
				'label' => 'Degree Year',
				'required' => false, // only required if author_status is postdoc -- see validation function in js/abstract.js
				'instructions' => '(if postdoc)',
				'value' => $values,
			));
			print_text_field('author_status_other', array(
				'label' => 'Other Author Status',
				'required' => false, // only required if author_status is other -- see validation function in js/abstract.js
				'instructions' => '(if other)',
				'value' => $values,
			));
		?>
		<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		<?php
			print_upload_field('picture', array(
				'label' => 'Picture',
				'required' => true,
				'instructions' => '(max 1 MB)',
				'value' => $values,
			));
		?>
	</table>
	
	<h3>All Authors</h3>
	
	<p>Enter all affiliations associated with the authors, one per line, in the following format: Department, Institution, City, State/Province, Country.<br />
	<em>Example:</em> Department of Neurology, Univ. of Washington, Seattle, WA, USA</p>
	<table>
		<?php
			for ($i = 1; $i <= 8; $i++) {
				print_text_field("affiliation_$i", array(
					'label' => "Affiliation #$i",
					'required' => ($i == 1),
					'value' => $values,
				));
			}
		?>
	</table>
	
	<p>Enter the information for all authors.<br />
	The person listed as the first author <strong>must</strong> be presenting the abstract.
	Please use the affiliation numbers above, separated by commas, to indicate each author's affiliation(s).</p>
	<table class="multitext">
		<tr>
			<th></th>
			<th>First Name (<span class="required_indicator">*</span>)</th>
			<th>Middle Initial</th>
			<th>Last Name (<span class="required_indicator">*</span>)</th>
			<th>Affiliation (<span class="required_indicator">*</span>)</th>
		</tr>
		
		<?php
			for ($i = 1; $i <= 8; $i++) {
				print_multi_text_field("author_$i", array(
					"_firstname" => ($i == 1),
					"_middlename" => false,
					"_lastname" => ($i == 1),
					"_affiliation" => ($i == 1),
				),
				array(
					'label' => "Author #$i",
					'class' => array(
						'_affiliation' => array('affiliation_reference'),
					),
					'value' => $values,
				));
			}
		?>
	</table>
	
	<h3>Abstract Information</h3>
	
	<p>Select the best category for the topic of your abstract.  If your abstract is outside one of the listed categories, choose "other" and list an alternative category.</p>
	
	<table>
		<?php
			print_select_field('abstract_category', array(
				'label' => 'Abstract Category',
				'required' => true,
				'options' => array(
					'' => '',
					'stem_cell' => 'Stem cell',
					'gene_therapy' => 'Gene therapy',
					'dysferlin_structure_function' => 'Dysferlin structure/function',
					'therapeutic' => 'Therapeutic',
					'tools' => 'Tools',
					'clinical' => 'Clinical',
					'mechanisms_of_pathology' => 'Mechanisms of pathology',
					'other' => 'Other',
				),
				'value' => $values,
			));
			
			print_text_field('abstract_category_other', array(
				'label' => 'Other abstract category',
				'required' => false, // only required if abstract_category is other -- see validation function in js/abstract.js
				'instructions' => '(if other)',
				'value' => $values,
			));
		?>
	</table>
	
	<p>Select whether you would prefer an oral or poster presentation. However, please note that the decision regarding the type of presentation is at the complete discretion of the Jain Foundation.</p>
	
	<table>
		<?php
			print_select_field('presentation_type', array(
				'label' => 'Desired Type of Presentation',
				'required' => true,
				'options' => array(
					'' => '',
					'oral' => 'Oral',
					'poster' => 'Poster',
				),
				'value' => $values,
			));
		?>
	</table>
	
	<h3>Abstract</h3>
	
	<p><em>Notice:</em> It is the author's sole responsibility to abide by standard regulations for animal care and use, as well as to use of human subjects. All named authors share this responsibility and agree with the submitted text.
	
	<p>Enter the title of your abstract in initial caps, except for capitalized abbreviations (e.g., DNA) and simple words (e.g., "a," "to," "the").<br />
	<em>Example:</em> "Role of Muscle Stem Cells in the Progression and Treatment of Dysferlinopathy"</p>
	
	<table>
		<?php
			print_text_field('abstract_title', array(
				'label' => 'Abstract Title',
				'required' => true,
				'value' => $values,
			));
		?>
	</table>
	
	<p>Please <strong>do not</strong> enter the abstract title again in the body of the abstract.<br />
	Please limit the body of your abstract to no more than ???? characters.</p>
	
	<?php
		print_textarea_field('abstract_body', array(
			'label' => 'Abstract',
			'required' => true,
			'value' => $values
		));
	?>

	<div id="word_count_text" class="hoveringLabel" style="display:none">word count: <span id="word_count">0</span> words</div>
	
	<p>
		<input type="submit" name="action" value="Preview">
		<input type="submit" name="action" value="Submit">
	</p>
</form>

<?php
	printFooter();
?>
