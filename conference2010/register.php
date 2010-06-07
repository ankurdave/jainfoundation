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
		'js/register-common.js',
		'js/register.js',
	),
	'page_nav_id' => 'register'
));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Meeting Registration and Abstract Submission</h2>

<p>For questions and concerns please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org.</a></p>

<p><strong>PLEASE NOTE: If you are planning to submit an abstract you need to have it ready when you register because you will be required to submit it below. Abstracts for both oral and poster presentations are due NO LATER THAN June 25th, 2010.</strong></p>

<p>The Fourth Annual Dysferlin Conference is a scientific meeting for researchers and clinicians working on dysferlin. <strong>Pre-registration is required no later than July 23, 2010 as NO late or onsite registrations will be accepted.</strong> Attendance is limited.  Therefore, all registrations must be approved by the Jain Foundation. The Jain Foundation will let you know if your registration has been approved as soon as possible, but no later than July 27th, 2010. Preference will be given to those who are giving oral or poster presentations. If you are not approved, your registration fee will be refunded to you.</p>

<form action="<?php echo $submit_location . $data_auth_query_string ?>" method="post" id="register-form">
	<input type="hidden" name="form_number" value="1">
	<h3>Personal Information</h3>
	<table>
		<?php
			print_text_field('firstname', array(
				'label' => 'First Name',
				'required' => true,
				'value' => $registrant->getField('firstname'),
			));
			print_text_field('middlename', array(
				'label' => 'Middle Initial',
				'required' => false,
				'value' => $registrant->getField('middlename'),
			));
			print_text_field('lastname', array(
				'label' => 'Last Name',
				'required' => true,
				'value' => $registrant->getField('lastname'),
			));
			print_select_field('degree', array(
				'label' => 'Degree',
				'required' => true,
				'options' => array(
					'' => '',
					'none' => 'None',
					'MD' => 'MD',
					'PhD' => 'PhD',
					'BS' => 'BS',
					'other' => 'Other',
				),
				'value' => $registrant->getField('degree'),
			));
			print_text_field('degree_other', array(
				'label' => 'Other Degree',
				'required' => false, // only required if degree is other
				'value' => $registrant->getField('degree_other'),
			));
			print_select_field('position', array(
				'label' => 'Position Title',
				'required' => true,
				'options' => array(
					'' => '',
					'faculty_researcher' => 'Faculty/Researcher',
					'postdoc' => 'Postdoc',
					'grad_student' => 'Graduate Student',
					'undergrad_student' => 'Undergraduate Student',
					'other' => 'Other',
				),
				'value' => $registrant->getField('position'),
			));
			print_text_field('position_other', array(
				'label' => 'Other Position Title',
				'required' => false, // only required if position is other
				'value' => $registrant->getField('position_other'),
			));
			print_text_field('department', array(
				'label' => 'Department',
				'required' => false,
				'value' => $registrant->getField('department'),
			));
			print_text_field('institution', array(
				'label' => 'Institution',
				'required' => true,
				'value' => $registrant->getField('institution'),
			));
			print_select_field('institution_profile', array(
				'label' => 'Institution Profile',
				'required' => true,
				'options' => array(
					'' => '',
					'academic' => 'Academic',
					'industry_corporate' => 'Industry/Corporate',
					'government' => 'Government',
					'other' => 'Other',
				),
				'value' => $registrant->getField('institution_profile'),
			));
			print_text_field('institution_profile_other', array(
				'label' => 'Other Institution Profile',
				'required' => false, // only required if institution_profile is other
				'value' => $registrant->getField('institution_profile_other'),
			));
			print_text_field('street_address', array(
				'label' => 'Street Address',
				'required' => true,
				'value' => $registrant->getField('street_address'),
			));
			print_text_field('street_address_2', array(
				'label' => 'Street Address 2',
				'required' => false,
				'value' => $registrant->getField('street_address_2'),
			));
			print_text_field('city', array(
				'label' => 'City',
				'required' => true,
				'value' => $registrant->getField('city'),
			));
			print_text_field('state_province', array(
				'label' => 'State/Province',
				'required' => false,
				'value' => $registrant->getField('state_province'),
			));
			print_text_field('zip_postal_code', array(
				'label' => 'Zip/Postal Code',
				'required' => true,
				'value' => $registrant->getField('zip_postal_code'),
			));
			print_text_field('country', array(
				'label' => 'Country',
				'required' => true,
				'value' => $registrant->getField('country'),
			));
			print_text_field('email', array(
				'label' => 'Email',
				'required' => true,
				'class' => array('email'),
				'value' => $registrant->getField('email'),
			));
			print_text_field('phone', array(
				'label' => 'Phone Number',
				'required' => true,
				'value' => $registrant->getField('phone'),
			));
			print_text_field('fax', array(
				'label' => 'Fax',
				'required' => false,
				'value' => $registrant->getField('fax'),
			));
		?>
	</table>

	<?php echo registerMenu(1); ?>
</form>

<?php
	printFooter();
?>
