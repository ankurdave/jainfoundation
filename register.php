<?php
//	error_reporting(E_ALL);
	require 'includes/lib.php';
	
	$submit_location = 'register-submit.php';
	
	// Default values
	$values = array();
	
	// Populate the fields with the saved values
	if (isset($_GET['id']) && isset($_GET['auth_key'])) {
		$values = getRegistrant($_GET['id'], $_GET['auth_key']);
	} else if (isset($_COOKIE['register_id']) && isset($_COOKIE['register_auth_key'])) {
		$values = getRegistrant($_COOKIE['register_id'], $_COOKIE['register_auth_key']);
	}
	
	printHeader(array('title' => 'Conference 2010 | Registration', 'scripts' => array('js/jquery.validate.js', 'js/register.js',), 'page_nav_id' => 'register'));
?>

<?php include 'conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Registration</h2>

<p>For questions and concerns please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org.</a></p>

<p>The Fourth Annual Dysferlin Conference is a scientific meeting for researchers and clinicians working on dysferlin.  Attendance is limited.  Therefore, all registrations must be approved by the Jain Foundation. You will be notified within a week of your registration whether you have been approved.  Preference will be given to those who are giving oral or poster presentations. If you are not approved your registration fee will be refunded to you.</p>



<?php
	if (isset($values['id'])) {
		$data_auth_query_string = "?id=" . $values['id'] . "&auth_key=" . $values['auth_key'];
	} else {
		$data_auth_query_string = '';
	}
?>
<form action="<?php echo $submit_location . $data_auth_query_string ?>" method="post" id="register-form">
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
					'bs' => 'BS',
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
			print_text_field('position_other', array(
				'label' => 'Other Position Title',
				'required' => false, // only required if position is other
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
	<p>Have you or are you planning to submit an abstract for oral or poster presentation?</p>
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
	<div id="submitting_abstract_yes">
		<p>If yes, what is the title of your abstract?</p>
		<table>
			<?php
				print_text_field('abstract_title', array(
					'label' => 'Abstract Title',
					'required' => false,
					'value' => $values,
				));
			?>
		</table>
	</div>
	
	<h3>Registration Information</h3>
	<p>Are you a local attendee?</p>
	<table>
		<?php
			print_radio_field('local_attendee', array(
				'label' => 'Local Attendee',
				'required' => true,
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
				'required' => true,
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
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('attendance_day2', array(
				'label' => 'Sunday, Sept 12',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('attendance_day3', array(
				'label' => 'Monday, Sept 13',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('attendance_day4', array(
				'label' => 'Tuesday, Sept 14',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
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
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('meals_day2_lunch', array(
				'label' => 'Sunday, Sept 12 &ndash; Lunch',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('meals_day2_lunch_entree', array(
				'label' => 'Sunday, Sept 12 &ndash; Lunch &ndash; Entree',
				'required' => false,
				'options' => array(
					'chicken' => 'Chicken',
					'fish' => 'Fish',
					'vegetarian' => 'Vegetarian',
				),
				'value' => $values,
			));
			print_radio_field('meals_day3_breakfast', array(
				'label' => 'Monday, Sept 13 &ndash; Breakfast',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('meals_day3_lunch', array(
				'label' => 'Monday, Sept 13 &ndash; Lunch',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('meals_day3_lunch_entree', array(
				'label' => 'Monday, Sept 13 &ndash; Lunch &ndash; Entree',
				'required' => false,
				'options' => array(
					'beef' => 'Beef',
					'fish' => 'Fish',
					'vegetarian' => 'Vegetarian',
				),
				'value' => $values,
			));
			print_radio_field('meals_day4_breakfast', array(
				'label' => 'Tuesday, Sept 14 &ndash; Breakfast',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('meals_day4_lunch', array(
				'label' => 'Tuesday, Sept 14 &ndash; Lunch',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
			print_radio_field('meals_day4_lunch_entree', array(
				'label' => 'Tuesday, Sept 14 &ndash; Lunch &ndash; Entree',
				'required' => false,
				'options' => array(
					'chicken' => 'Chicken',
					'vegetarian' => 'Vegetarian',
				),
				'value' => $values,
			));
			print_radio_field('meals_gala_dinner', array(
				'label' => 'Evening of Tuesday, Sept 13 &ndash; Gala Dinner',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
		?>
	</table>
	<div id="meals_gala_dinner_yes">
		<p>Do you require a Vegetarian option for the Gala Dinner?</p>
		<table>
		<?php
			print_radio_field('meals_gala_dinner_entree', array(
				'label' => 'Evening of Tuesday, Sept 13 &ndash; Gala Dinner &ndash; Vegetarian',
				'required' => false,
				'options' => array(
								   'yes' => 'Yes',
								   'no' => 'No',
				),
				'value' => $values,
			));
		?>
		</table>
	<table>
		<?php
		?>
	</table>
	<p>Will you be bringing guests to the Gala?</p>
	<table>
		<?php
			print_radio_field('meals_gala_dinner_guests', array(
				'label' => 'Gala Dinner &ndash; Guests',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $values,
			));
		?>
	</table>
	<div id="meals_gala_dinner_guests_yes">
		<table>
			<?php
				print_text_field('meals_gala_dinner_numguests', array(
					'label' => 'Gala Dinner &ndash; Number of Guests',
					'required' => false,
					'value' => $values,
				));
			?>
		</table>
	</div>
	<p>(Note there is a $70/guest charge for the gala dinner that is required at time of registration.  This charge is non-refundable if not canceled by July 30th, 2010)</p>
	</div>
	
	<div id="local_attendee_no">
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
		<p>If yes, <strong>do not</strong> book a hotel room. The Jain Foundation will match you up with a compatible roommate and book the room for you. Please answer the following questions to help with the matching.</p>
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
		<p>If no, <a href="location.php" target="_blank">book your hotel room here</a>.</p>
	</div>
	</div>
	
	<h3>Payment</h3>
	<p>For questions and concerns regarding payment please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a>.  If your registration is not approved your registration fee will be refunded.</p>
	
	<p>Do you have a promotional code?</p>
	<table>
	<?php
		print_radio_field('have_promo_code', array(
			'label' => 'Have Promotional Code',
			'required' => true,
			'options' => array(
				'yes' => 'Yes',
				'no' => 'No',
			),
			'value' => $values,
		));
	?>
	</table>
	<div id="have_promo_code_yes">
		<script type="text/javascript">
			var promo_code_valid = false;
		</script>
		<table>
		<?php
			print_text_field('promo_code', array(
				'label' => 'Promotional Code',
				'instructions' => '<input type="button" id="check_promo" value="Check Promotional Code" />',
				'required' => false,
				'value' => $values,
			));
		?>
		</table>
	</div>
	<div id="promo_code_valid" style="display:none">
		Promotional code is valid.
	</div>
	<div id="promo_code_invalid" style="display:none">
		Promotional code is not valid.
	</div>
	<div id="no_promo_code">
	<?php
		$now = time();
	?>
	<p>
		The date is <?php echo date('F j, Y', $now) ?>.
		<?php if ($now <= strtotime('June 4, 2010')) { ?>
			Early registration is open.
	</p>
			<ul>
				<li id="cost_postdoc">Post-doc/student: $150 USD</li>
				<li id="cost_other">Other: $250 USD</li>
			</ul>
			
			<script type="text/javascript">
				var postdoc_fee = 150;
				var other_fee = 250;
			</script>
		<?php } else if ($now <= strtotime('July 23, 2010')) { ?>
			Early registration is closed. Late registration is open.
	</p>
			<ul>
				<li id="cost_postdoc">Post-doc/student: $250 USD</li>
				<li id="cost_other">Other: $350 USD</li>
			</ul>
			
			<script type="text/javascript">
				var postdoc_fee = 250;
				var other_fee = 350;
			</script>
		<?php } else { ?>
			Registration is closed. No late or onsite registration is available.
	</p>
		<?php } ?>
	</div>
	
	<p>
		<input type="button" id="calculate_fee" value="Calculate Price" />
	</p>
	<p id="price" style="display:none">
		Base fee: $<span id="base_fee">0</span> USD<br />
		Gala dinner guest charge: $<span id="gala_dinner_guest_fee">0</span> USD<br />
		<strong>Total price: $<span id="total_fee">0</span> USD</strong>
	</p>
	
	<p>Will you be paying by check or credit card?</p>
	<table>
		<?php
			print_radio_field('payment_type', array(
				'label' => 'Payment Type',
				'required' => true,
				'options' => array(
					'check' => 'Check',
					'credit_card' => 'Credit Card',
				),
				'value' => $values,
			));
		?>
	</table>
	<div id="payment_type_check">
		<p>Please mail a check made out to the "Jain Foundation Inc" to the following address:</p>
		
		<p>
			Jain Foundation<br />
			2310 130th Ave NE<br />
			Suite B101<br />
			Bellevue, WA 98005
		</p>
		
		<p>The check must be <strong>received</strong> within 20 days of registration or applicant will be unregistered.</p>
	</div>
	<div id="payment_type_credit_card">
		<p>Please <a href="#">pay through PayPal</a>.</p>
		
		<p>The PayPal receipt must be received within 20 days of registration or applicant will be unregistered. The receipt can be sent by one of the following methods:</p>
		
		<ul>
			<li>Email to Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a></li>
			<li>Fax to the Jain Foundation at 425-882-1050</li>
			<li>
				Mailed to the Jain Foundation at:
				<br />Jain Foundation
				<br />2310 130th Ave NE
				<br />Suite B101
				<br />Bellevue, WA 98005
			</li>
	</div>
	
	<h3>Comments</h3>
	<p>Please use this box to indicate anything that you need to convey to the Jain Foundation regarding your registration submission.</p>
	<?php
		print_textarea_field('comments', array(
			'label' => 'Comments',
			'required' => false,
			'value' => $values,
		));
	?>
	
	<p>
		<input type="submit" name="action" value="Submit" />
	</p>			
</form>

<?php
	printFooter();
?>
