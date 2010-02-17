<?php
//	error_reporting(E_ALL);
	require 'includes/lib.php';
	
	$submit_location = 'register-submit.php';
	
	// Default values
	$values = array();
	
	// Populate the fields with the saved values
	if (isset($_GET['id'])) {
		$values = getRegistrant($_GET['id']);
	} else if (isset($_COOKIE['register_id'])) {
		$values = getRegistrant($_COOKIE['register_id']);
	}
	
	printHeader(array('title' => 'Conference 2010 | Registration', 'scripts' => array('js/jquery.validate.js', 'js/register.js',), 'page_nav_id' => 'register'));
?>

<?php include 'conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Registration</h2>

<?php
	if (isset($values['id'])) {
		$data_auth_query_string = "?id=" . $values['id'] . "&auth_key=" . $values['auth_key'];
	} else {
		$data_auth_query_string = '';
	}
?>
<form action="<?php echo $submit_location . $data_auth_query_string ?>" method="post" id="register-form">
	<p><input type="button" id="sample_values" value="Fill sample values" /></p>
	
	<h3>Personal Information</h3>
	<table>
		<?php
			print_text_field('firstname', array(
				'label' => 'First Name',
				'required' => true,
				'value' => $values,
			));
			print_text_field('lastname', array(
				'label' => 'Last Name',
				'required' => true,
				'value' => $values,
			));
			print_select_field('degree', array(
				'label' => 'Degree',
				'required' => true,
				'options' => array(
					'' => '',
					'none' => 'None',
					'md' => 'MD',
					'phd' => 'PhD',
					'other' => 'Other',
				),
				'value' => $values,
			));
			print_text_field('degree_other', array(
				'label' => 'Other Degree',
				'required' => false, // only required if degree is other
				'value' => $values,
			));
			print_select_field('position', array(
				'label' => 'Position Title',
				'required' => false,
				'options' => array(
					'' => '',
					'faculty_researcher' => 'Faculty/Researcher',
					'postdoc' => 'Postdoc',
					'grad_student' => 'Graduate Student',
					'other' => 'Other',
				),
				'value' => $values,
			));
			print_text_field('position_other', array(
				'label' => 'Other Position Title',
				'required' => false, // only required if position is other
				'value' => $values,
			));
			print_text_field('institution', array(
				'label' => 'Institution',
				'required' => true,
				'value' => $values,
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
				'value' => $values,
			));
			print_text_field('institution_profile_other', array(
				'label' => 'Other Institution Profile',
				'required' => false, // only required if institution_profile is other
				'value' => $values,
			));
			print_text_field('department', array(
				'label' => 'Department',
				'required' => false,
				'value' => $values,
			));
			print_text_field('street_address', array(
				'label' => 'Address',
				'required' => true,
				'value' => $values,
			));
			print_text_field('city', array(
				'label' => 'City',
				'required' => false,
				'value' => $values,
			));
			print_text_field('state_province', array(
				'label' => 'State/Province',
				'required' => false,
				'value' => $values,
			));
			print_text_field('zip_postal_code', array(
				'label' => 'Zip/Postal Code',
				'required' => false,
				'value' => $values,
			));
			print_text_field('country', array(
				'label' => 'Country',
				'required' => false,
				'value' => $values,
			));
			print_text_field('email', array(
				'label' => 'Email',
				'required' => true,
				'class' => array('email'),
				'value' => $values,
			));
			print_text_field('phone', array(
				'label' => 'Phone Number',
				'required' => true,
				'value' => $values,
			));
			print_text_field('fax', array(
				'label' => 'Fax',
				'required' => false,
				'value' => $values,
			));
		?>
	</table>
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
				'value' => $values,
			));
		?>
	</table>
	
	<h3>Registration Information</h3>
	<p>Are you a local attendee?</p>
	<table>
		<?php
			print_radio_field('local_attendee', array(
				'label' => 'Local Attendee',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
		?>
	</table>
	<p>Will you need parking at the hotel?</p>
	<table>
		<?php
			print_radio_field('hotel_parking', array(
				'label' => 'Hotel Parking',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
		?>
	</table>
	<p>Please indicate which days you will be in attendance.</p>
	<table>
		<?php
			print_radio_field('attendance_day1', array(
				'label' => 'Saturday, Sept 11',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('attendance_day2', array(
				'label' => 'Sunday, Sept 12',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('attendance_day3', array(
				'label' => 'Monday, Sept 13',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('attendance_day4', array(
				'label' => 'Tuesday, Sept 14',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
		?>
	</table>
	<p>Please indicate which meals you will be attending.</p>
	<table>
		<?php
			print_radio_field('meals_day2_breakfast', array(
				'label' => 'Sunday, Sept 12 &ndash; Breakfast',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('meals_day2_lunch', array(
				'label' => 'Sunday, Sept 12 &ndash; Lunch',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('meals_day3_breakfast', array(
				'label' => 'Monday, Sept 13 &ndash; Breakfast',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('meals_day3_lunch', array(
				'label' => 'Monday, Sept 13 &ndash; Lunch',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('meals_day4_breakfast', array(
				'label' => 'Tuesday, Sept 14 &ndash; Breakfast',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
			print_radio_field('meals_day4_lunch', array(
				'label' => 'Tuesday, Sept 14 &ndash; Lunch',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
					'unknown' => "Don't know",
				),
				'value' => $values,
			));
		?>
	</table>
	<table>
		<?php
			print_text_field('meals_gala_dinner_numguests', array(
				'label' => 'Evening of Sept ?? &ndash; Gala Dinner &ndash; Number of Guests',
				'required' => false,
				'value' => $values,
			));
		?>
	</table>
	<p>(Note there is a $50/guest charge for the gala dinner that is required at time of registration.  This charge is non-refundable if not canceled by July ??, 2010)</p>
	
	<h3>Hotel Reservations</h3>
	<p>Do you want to share a room?</p>
	<table>
		<?php
			print_radio_field('share_room', array(
				'label' => 'Share a Room',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
		?>
	</table>
	<div id="share_room_yes">
		<p>If yes, <strong>do not</strong> book a hotel room. The Jain Foundation will match you up with a compatible roommate and book the room for you. Pleas answer the following questions to help with the matching.</p>
		<table>
			<?php
				print_radio_field('gender', array(
					'label' => 'Gender',
					'required' => false,
					'options' => array(
						'male' => 'Male',
						'female' => 'Female',
					),
					'value' => $values,
				));
				print_select_field('arrival_date', array(
					'label' => 'Arrival Date',
					'required' => false, // only required if share_room is yes
					'options' => array(
						'' => '',
						'2010-09-08' => 'Wednesday, Sept 8',
						'2010-09-09' => 'Thursday, Sept 9',
						'2010-09-10' => 'Friday, Sept 10',
						'2010-09-11' => 'Saturday, Sept 11',
						'2010-09-12' => 'Sunday, Sept 12',
					),
					'value' => $values,
				));
				print_select_field('departure_date', array(
					'label' => 'Departure Date',
					'required' => false, // only required if share_room is yes
					'options' => array(
						'' => '',
						'2010-09-12' => 'Sunday, Sept 12',
						'2010-09-13' => 'Monday, Sept 13',
						'2010-09-14' => 'Tuesday, Sept 14',
						'2010-09-15' => 'Wednesday, Sept 15',
						'2010-09-16' => 'Thursday, Sept 16',
					),
					'value' => $values,
				));
			?>
		</table>
	</div>
	<div id="share_room_no">
		<p>If no, follow this link.</p>
	</div>
	
	<h3>Payment</h3>
	<p>Instructions regarding payment and reimbursement.</p>
	<?php
		$now = time();
	?>
	<p>
		The date is <?php echo date('F j, Y', $now) ?>.
		<?php if ($now < strtotime('June 16, 2010')) { ?>
			Early registration is open.
	</p>
			<ul>
				<li id="cost_researcher">Researcher: $200 USD</li>
				<li id="cost_postdoc">Post-Doc: $150 USD</li>
			</ul>
			
			<script type="text/javascript">
				var researcher_fee = 200;
				var postdoc_fee = 150;
				var other_fee = 200;
			</script>
		<?php } else if ($now < strtotime('July 16, 2010')) { ?>
			Regular registration is open.
	</p>
			<ul>
				<li id="cost_researcher">Researcher: $250 USD</li>
				<li id="cost_postdoc">Post-Doc: $200 USD</li>
			</ul>
			
			<script type="text/javascript">
				var researcher_fee = 250;
				var postdoc_fee = 200;
				var other_fee = 250;
			</script>
		<?php } else { ?>
			Registration is closed. No late or onsite registration is available.
	</p>
		<?php } ?>
	
	<p>
		<input type="button" id="calculate_fee" value="Calculate Price" />
	</p>
	<p id="price" style="display:none">
		Base fee: $<span id="base_fee">0</span> USD<br />
		Gala dinner guest charge: $<span id="gala_dinner_guest_fee">0</span> USD<br />
		<strong>Total price: $<span id="total_fee">0</span> USD</strong>
	</p>
	
	<p>Payment options:</p>
	<ul>
		<li>Mail in Check made out to the "Jain Foundation Inc": (must be <strong>received</strong> within 20 days of registration or applicant will be unregistered)</li>
		<li>Credit card: PayPal</li>
	</ul>
	
	<p>
		<input type="submit" name="action" value="Submit">
	</p>			
</form>

<?php
	printFooter();
?>
