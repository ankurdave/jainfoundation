<?php
//	error_reporting(E_ALL);
	require 'includes/lib.php';

	$db = connectToDB();
	
	$submit_location = 'abstract-submit.php';
	
	// Set the default abstract values
	$abstract = new AbstractDAO();
	$author1 = new AbstractAuthorDAO($db);
	$author1->setField('affiliations', '1');
	$abstract->addAuthor($author1);

	// Load the saved values from the DAO, if any
	try {
		if (isset($_GET['id'])) {
			$abstract = new AbstractDAO($_GET['id']);
			$abstract->setField('auth_key', $_GET['auth_key']); // Pass along the auth key
		} else if (isset($_COOKIE['id'])) {
			$abstract = new AbstractDAO($_COOKIE['id']);
			$abstract->setField('auth_key', $_COOKIE['auth_key']); // Pass along the auth key
		}
	} catch (DAOAuthException $e) { }
	
	printHeader(array('title' => 'Conference 2010 | Abstract Submission', 'scripts' => array($Config['URLPath'] . '/js/jquery.validate.js', $Config['URLPath'] . '/js/jquery.alphanumeric.js', 'js/abstract.js',), 'page_nav_id' => 'abstract'));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Abstract Submission</h2>

<p><em>For questions and concerns please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a>.</em></p>

<p>This year's meeting is going to be different from past dysferlin conferences.  We plan to limit the number of talks and present more information using posters.  The oral sessions will focus on a few of the most pressing questions in dysferlin and will include a significant time for discussion.</p>

<p>Please fill out the form below and submit it <strong>no later than June 25th, 2010</strong>. Please fill out the form in the way you wish it to appear in the Dysferlin Conference Booklet as the Jain Foundation will not be responsible for any errors in content, spelling, or look. <em>You will be informed whether your abstract has been accepted by July 9th, 2010.</em></p>

<?php
	if (!is_null($abstract->getField('id'))) {
		$data_auth_query_string = "?id=" . $abstract->getField('id') . "&auth_key=" . $abstract->getField('auth_key');
	} else {
		$data_auth_query_string = '';
	}
?>
<form action="<?php echo $submit_location . $data_auth_query_string ?>" method="post" id="abstract-form" enctype="multipart/form-data" encoding="multipart/form-data">
	<p><input type="hidden" name="MAX_FILE_SIZE" value="1000000" /></p>
	
	<h3>Presenting Author</h3>
	<table>
		<?php
			print_text_field('firstname', array(
				'label' => 'First Name',
				'required' => true,
				'value' => $abstract->getField('firstname'),
			));
			print_text_field('middlename', array(
				'label' => 'Middle Initial',
				'required' => false,
				'value' => $abstract->getField('middlename'),
			));
			print_text_field('lastname', array(
				'label' => 'Last Name',
				'required' => true,
				'value' => $abstract->getField('lastname'),
			));
			print_text_field('degree', array(
				'label' => 'Degree',
				'required' => true,
				'instructions' => '(BS, MD, PhD, etc.)',
				'value' => $abstract->getField('degree'),
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
				'value' => $abstract->getField('author_status'),
			));
			print_text_field('author_status_other', array(
				'label' => 'Other Author Status',
				'required' => false, // only required if author_status is other -- see validation function in js/abstract.js
				'instructions' => '(if other)',
				'value' => $abstract->getField('author_status_other'),
			));
			print_text_field('degree_year', array(
				'label' => 'Degree Year',
				'required' => false, // only required if author_status is postdoc -- see validation function in js/abstract.js
				'instructions' => '(if postdoc)',
				'value' => $abstract->getField('degree_year'),
			));
			print_text_field('department', array(
				'label' => 'Department',
				'required' => false,
				'value' => $abstract->getField('department'),
			));
			print_text_field('institution', array(
				'label' => 'Institution',
				'required' => true,
				'value' => $abstract->getField('institution'),
			));
			print_text_field('street_address', array(
				'label' => 'Street Address',
				'required' => true,
				'value' => $abstract->getField('street_address'),
			));
			print_text_field('city', array(
				'label' => 'City',
				'required' => true,
				'value' => $abstract->getField('city'),
			));
			print_text_field('state_province', array(
				'label' => 'State/Province',
				'required' => false,
				'value' => $abstract->getField('state_province'),
			));
			print_text_field('zip_postal_code', array(
				'label' => 'Zip/Postal Code',
				'required' => true,
				'value' => $abstract->getField('zip_postal_code'),
			));
			print_text_field('country', array(
				'label' => 'Country',
				'required' => true,
				'value' => $abstract->getField('country'),
			));
			print_text_field('email', array(
				'label' => 'Email',
				'required' => true,
				'class' => array('email'),
				'value' => $abstract->getField('email'),
			));
			print_text_field('phone', array(
				'label' => 'Phone Number',
				'required' => true,
				'value' => $abstract->getField('phone'),
			));
			print_text_field('fax', array(
				'label' => 'Fax Number',
				'required' => false,
				'value' => $abstract->getField('fax'),
			));
		?>
		<?php
			print_upload_field('picture', array(
				'label' => 'Picture',
				'required' => true,
				'instructions' => '(max 1 MB)',
				'value' => $abstract->getField('picture'),
			));
		?>
	</table>
	
	<h3>All Authors</h3>
	
	<p>Enter all affiliations associated with the authors, one per line, in the following format: Department, Institution, City, State/Province, Country.<br />
	<em>Example:</em> Department of Neurology, Univ. of Washington, Seattle, WA, USA</p>
	<table id="affiliations">
		<?php
			$affiliations = $abstract->getAffiliations();
			$numFilled = count($affiliations);
			$numFields = $numFilled + 1;
			for ($i = 1; $i <= $numFields; $i++) {
				print_text_field("affiliation_$i", array(
					'label' => "Affiliation #$i",
					'required' => ($i == 1),
					'value' => ($i <= $numFilled) ? $affiliations[$i - 1]->getField('affiliation') : '',
				));
			}
		?>
	</table>
	<input type="button" id="affiliation_more" class="addmore" value="Add More" />
	
	<p>Enter the information for all authors.<br />
	The person listed as the first author <strong>must</strong> be presenting the abstract.
	Please use the affiliation numbers above, separated by commas, to indicate each author's affiliation(s).</p>
	<table class="multitext" id="authors">
		<tr>
			<th></th>
			<th>First Name (<span class="required_indicator">*</span>)</th>
			<th>Middle Initial</th>
			<th>Last Name (<span class="required_indicator">*</span>)</th>
			<th>Affiliations (<span class="required_indicator">*</span>)</th>
		</tr>
		
		<?php
			$authors = $abstract->getAuthors();
			$numFilled = count($authors);
			$numFields = $numFilled + 1;
			for ($i = 1; $i <= $numFields; $i++) {
				?>
				<tr id="author_<?php echo $i ?>">
					<th class="label">
						Author #<?php echo $i ?>
					</th>
				<?php
				
				print_multi_text_field("author_{$i}_firstname", array(
					'required' => ($i == 1),
					'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('firstname') : '',
				));
				print_multi_text_field("author_{$i}_middlename", array(
					'required' => false,
					'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('middlename') : '',
				));
				print_multi_text_field("author_{$i}_lastname", array(
					'required' => ($i == 1),
					'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('lastname') : '',
				));
				print_multi_text_field("author_{$i}_affiliations", array(
					'required' => ($i == 1),
					'class' => array('affiliation_reference', 'affiliation'),
					'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('affiliations') : '',
				));

				?></tr><?php
			}
		?>
	</table>
	<input type="button" id="author_more" class="addmore" value="Add More" />
	
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
				'value' => $abstract->getField('abstract_category'),
			));
			
			print_text_field('abstract_category_other', array(
				'label' => 'Other abstract category',
				'required' => false, // only required if abstract_category is other -- see validation function in js/abstract.js
				'instructions' => '(if other)',
				'value' => $abstract->getField('abstract_category_other'),
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
				'value' => $abstract->getField('presentation_type'),
			));
		?>
	</table>
	
	<h3>Abstract</h3>
	
	<p><em>Notice:</em> It is the author's sole responsibility to abide by standard regulations for animal care and use, as well as to use of human subjects. All named authors share this responsibility and agree with the submitted text.</p>
	
	<p>Enter the title of your abstract in initial caps, except for capitalized abbreviations (e.g., DNA) and simple words (e.g., "a," "to," "the").<br />
	<em>Example:</em> "Role of Muscle Stem Cells in the Progression and Treatment of Dysferlinopathy"</p>
	
	<table>
		<?php
			print_text_field('abstract_title', array(
				'label' => 'Abstract Title',
				'required' => true,
				'value' => $abstract->getField('abstract_title'),
			));
		?>
	</table>
	
	<p>Please <strong>do not</strong> enter the abstract title again in the body of the abstract.<br />
	Please enter your abstract as ONE paragraph and limit the body of your abstract to no more than 275 words.</p>
	
	<?php
		print_textarea_field('abstract_body', array(
			'label' => 'Abstract',
			'required' => true,
			'value' => $abstract->getField('abstract_body'),
		));
	?>

	<div id="word_count_text" class="hoveringLabel" style="display:none">word count: <span id="word_count">0</span> words</div>
	
	<h3>Comments</h3>
	<p>Please use this box to indicate anything that you need to convey to the Jain Foundation regarding your abstract submission.</p>
	<?php
		print_textarea_field('comments', array(
			'label' => 'Comments',
			'required' => false,
			'value' => $abstract->getField('comments'),
		));
	?>
	
	<p>
		<input type="submit" name="action" value="Preview" />
		<input type="submit" name="action" value="Submit" />
	</p>
</form>

<?php
	printFooter();
?>
