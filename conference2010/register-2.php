<?php
//	error_reporting(E_ALL);
require 'includes/lib.php';

$db = connectToDB();

$submit_location = 'register-submit.php';

// Set the default values
$registrant = new RegistrantDAO($db);

// Load the saved values from the DAO, if any
try {
	if (isset($_GET['id'])) {
		$registrant = new RegistrantDAO($db, $_GET['id']);
		$registrant->setField('auth_key', $_GET['auth_key']);
	} else if (isset($_COOKIE['register_id'])) {
		$registrant = new RegistrantDAO($db, $_COOKIE['register_id']);
		$registrant->setField('auth_key', $_COOKIE['register_auth_key']);
	}
} catch (DAOAuthException $e) { }

// Build the query string
$data_auth_query_string_elements = array(
	'id' => $registrant->getField('id'),
	'auth_key' => $registrant->getField('auth_key'),
	'edit' => urlencode($_GET['edit']),
);
$data_auth_query_string = buildQueryString($data_auth_query_string_elements);

printHeader(array(
	'title' => 'Conference 2010 | Meeting Registration and Abstract Submission',
	'scripts' => array(
		$Config['URLPath'] . '/js/jquery.validate.js',
		$Config['URLPath'] . '/js/jquery.alphanumeric.js',
		'js/register-common.js',
		'js/register-2.js',
	),
	'page_nav_id' => 'register',
));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Meeting Registration and Abstract Submission</h2>

<p>For questions and concerns please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org.</a></p>

<form action="<?php echo $submit_location . $data_auth_query_string ?>" method="post" id="register-form" enctype="multipart/form-data" encoding="multipart/form-data" class="<?php echo empty($_GET['edit']) ? '' : 'editing' ?>">
	<input type="hidden" name="form_number" value="2">
	<p>Are you planning to submit an abstract for oral or poster presentation?</p>
	<table>
		<?php
			print_radio_field('submitting_abstract', array(
				'label' => 'Submitting Abstract',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('submitting_abstract'),
			));
		?>
	</table>
	<div id="submitting_abstract_yes">
		<p>This year's meeting is going to be different from past dysferlin conferences. We plan to limit the number of talks and present more information using posters. The oral sessions will focus on a few of the most pressing questions in dysferlin and will include a significant time for discussion.</p>
		<p>Please fill in the information below the way you wish it to appear in the Dysferlin Conference Booklet as the Jain Foundation will not be responsible for any errors in content, spelling, or look. <em>You will be informed whether your abstract has been accepted as soon as possible, but no later than July 9th, 2010.</em></p>
		<p>What is the title of your abstract?</p>
		<p>Enter the title of your abstract in initial caps, except for capitalized abbreviations (e.g., DNA) and simple words (e.g., "a," "to," "the").<br />
		<em>Example:</em> "Role of Muscle Stem Cells in the Progression and Treatment of Dysferlinopathy"</p>
		<table>
			<?php
				print_text_field('abstract_title', array(
					'label' => 'Abstract Title',
					'required' => false,
					'value' => $registrant->getAbstractInit()->getField('abstract_title'),
				));
			?>
		</table>

			<h3>Presenting Author</h3>

			<table>
				<?php
					print_upload_field('picture', array(
						'label' => 'Picture',
						'required' => false,
						'instructions' => '(max 1 MB)',
						'value' => $registrant->getAbstractInit()->getField('picture'),
					));
				?>
			</table>
			<p class="note">Please note:  The submitted picture should be of the presenting author for both oral and poster presentations whether they are the first author or not.</p>

			<h3>All Authors</h3>

			<p>Enter all affiliations associated with the authors, one per line, in the following format: Department, Institution, City, State/Province, Country.<br />
			<em>Example:</em> Department of Neurology, Univ. of Washington, Seattle, WA, USA</p>
			<table id="affiliations">
				<?php
					$affiliations = $registrant->getAbstractInit()->getAffiliations();
					$numFilled = count($affiliations);
					$numFields = $numFilled + 1;
					for ($i = 1; $i <= $numFields; $i++) {
						print_text_field("affiliation_$i", array(
							'label' => "Affiliation #$i",
							'required' => false,
							'value' => ($i <= $numFilled) ? $affiliations[$i - 1]->getField('affiliation') : '',
						));
					}
				?>
			</table>
			<p><input type="button" id="affiliation_more" class="addmore" value="Add More" /></p>

			<p>Enter the information for all authors.<br />
			The person listed as the first author <strong>must</strong> be presenting the abstract.
			Please use the affiliation numbers above, separated by commas, to indicate each author's affiliation(s).</p>
			<table class="multitext" id="authors">
				<tr>
					<th></th>
					<th>First Name (<span class="required-indicator for-show">*</span>)</th>
					<th>Middle Initial</th>
					<th>Last Name (<span class="required-indicator for-show">*</span>)</th>
					<th>Affiliation number<br /> from above (<span class="required-indicator for-show">*</span>)</th>
				</tr>

				<?php
					$authors = $registrant->getAbstractInit()->getAuthors();
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
							'required' => false,
							'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('firstname') : '',
						));
						print_multi_text_field("author_{$i}_middlename", array(
							'required' => false,
							'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('middlename') : '',
						));
						print_multi_text_field("author_{$i}_lastname", array(
							'required' => false,
							'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('lastname') : '',
						));
						print_multi_text_field("author_{$i}_affiliations", array(
							'required' => false,
							'class' => array('affiliation_reference', 'affiliation'),
							'value' => ($i <= $numFilled) ? $authors[$i - 1]->getField('affiliations') : '',
						));

						?></tr><?php
					}
				?>
			</table>
			<p><input type="button" id="author_more" class="addmore" value="Add More" /></p>

			<h3>Abstract Information</h3>

			<p>Select the best category for the topic of your abstract.  If your abstract is outside one of the listed categories, choose "other" and list an alternative category.</p>

			<table>
				<?php
					print_select_field('abstract_category', array(
						'label' => 'Abstract Category',
						'required' => false,
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
						'value' => $registrant->getAbstractInit()->getField('abstract_category'),
					));

					print_text_field('abstract_category_other', array(
						'label' => 'Other abstract category',
						'required' => false, // only required if abstract_category is other -- see validation function in js/abstract.js
						'value' => $registrant->getAbstractInit()->getField('abstract_category_other'),
					));
				?>
			</table>

			<p>Select whether you would prefer an oral or poster presentation. However, please note that the decision regarding the type of presentation is at the complete discretion of the Jain Foundation.</p>

			<table>
				<?php
					print_select_field('presentation_type', array(
						'label' => 'Desired Type of Presentation',
						'required' => false,
						'options' => array(
							'' => '',
							'oral' => 'Oral',
							'poster' => 'Poster',
						),
						'value' => $registrant->getAbstractInit()->getField('presentation_type'),
					));
				?>
			</table>

			<h3>Abstract</h3>

			<p><em>Notice:</em> It is the author's sole responsibility to abide by standard regulations for animal care and use, as well as to use of human subjects. All named authors share this responsibility and agree with the submitted text.</p>

			<p>Please <strong>do not</strong> enter the abstract title again in the body of the abstract.<br />
			Please enter your abstract as ONE paragraph and limit the body of your abstract to no more than 275 words.</p>

			<?php
				print_textarea_field('abstract_body', array(
					'label' => 'Abstract',
					'required' => false,
					'value' => $registrant->getAbstractInit()->getField('abstract_body'),
				));
			?>

			<div id="word_count_text" class="hoveringLabel" style="display:none">word count: <span id="word_count">0</span> words</div>

			<h3>Comments</h3>
			<p>Please use this box to indicate anything that you need to convey to the Jain Foundation regarding your abstract submission.</p>
			<?php
				print_textarea_field('abstract_comments', array(
					'label' => 'Abstract Comments',
					'required' => false,
					'value' => $registrant->getAbstractInit()->getField('abstract_comments'),
				));
			?>
	</div>

	<?php echo registerMenu(2); ?>
</form>

<?php
	printFooter();
?>
