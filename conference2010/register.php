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
	
	printHeader(array('title' => 'Conference 2010 | Registration', 'scripts' => array($Config['URLPath'] . '/js/jquery.validate.js', 'js/register.js',), 'page_nav_id' => 'register'));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Registration</h2>

<p>For questions and concerns please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org.</a></p>

<p>The Fourth Annual Dysferlin Conference is a scientific meeting for researchers and clinicians working on dysferlin. <strong>Pre-registration is required no later than July 23, 2010 as NO late or onsite registrations will be accepted.</strong> Attendance is limited.  Therefore, all registrations must be approved by the Jain Foundation. You will be notified within a week of your registration whether you have been approved.  Preference will be given to those who are giving oral or poster presentations. If you are not approved your registration fee will be refunded to you.</p>

<?php
	if (!is_null($registrant->getField('id'))) {
		$data_auth_query_string = "?id=" . $registrant->getField('id') . "&auth_key=" . $registrant->getField('auth_key');
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
				'value' => $registrant->getField('firstname'),
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
					'md' => 'MD',
					'phd' => 'PhD',
					'bs' => 'BS',
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
				'value' => $registrant->getField('submitting_abstract'),
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
					'value' => $registrant->getField('abstract_title'),
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
				'value' => $registrant->getField('local_attendee'),
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
				'value' => $registrant->getField('hotel_parking'),
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
				'value' => $registrant->getField('attendance_day1'),
			));
			print_radio_field('attendance_day2', array(
				'label' => 'Sunday, Sept 12',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('attendance_day2'),
			));
			print_radio_field('attendance_day3', array(
				'label' => 'Monday, Sept 13',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('attendance_day3'),
			));
			print_radio_field('attendance_day4', array(
				'label' => 'Tuesday, Sept 14',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('attendance_day4'),
			));
		?>
	</table>
	<p>Please indicate which meals you will be attending.</p>
	<table id="attendance_day2_yes">
		<?php
			print_radio_field('meals_day2_breakfast', array(
				'label' => 'Sunday, Sept 12 &ndash; Breakfast',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_day2_breakfast'),
			));
			print_radio_field('meals_day2_lunch', array(
				'label' => 'Sunday, Sept 12 &ndash; Lunch',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_day2_lunch'),
			));
			print_radio_field('meals_day2_lunch_entree', array(
				'label' => 'Sunday, Sept 12 &ndash; Lunch &ndash; Entree',
				'required' => false,
				'options' => array(
					'chicken' => 'Chicken',
					'fish' => 'Fish',
					'vegetarian' => 'Vegetarian',
				),
				'value' => $registrant->getField('meals_day2_lunch_entree'),
			));
		?>
	</table>
	<table id="attendance_day3_yes">
		<?php
			print_radio_field('meals_day3_breakfast', array(
				'label' => 'Monday, Sept 13 &ndash; Breakfast',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_day3_breakfast'),
			));
			print_radio_field('meals_day3_lunch', array(
				'label' => 'Monday, Sept 13 &ndash; Lunch',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_day3_lunch'),
			));
			print_radio_field('meals_day3_lunch_entree', array(
				'label' => 'Monday, Sept 13 &ndash; Lunch &ndash; Entree',
				'required' => false,
				'options' => array(
					'beef' => 'Beef',
					'fish' => 'Fish',
					'vegetarian' => 'Vegetarian',
				),
				'value' => $registrant->getField('meals_day3_lunch_entree'),
			));
		?>
	</table>
	<table id="attendance_day4_yes">
		<?php
			print_radio_field('meals_day4_breakfast', array(
				'label' => 'Tuesday, Sept 14 &ndash; Breakfast',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_day4_breakfast'),
			));
			print_radio_field('meals_day4_lunch', array(
				'label' => 'Tuesday, Sept 14 &ndash; Lunch',
				'required' => false,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_day4_lunch'),
			));
			print_radio_field('meals_day4_lunch_entree', array(
				'label' => 'Tuesday, Sept 14 &ndash; Lunch &ndash; Entree',
				'required' => false,
				'options' => array(
					'chicken' => 'Chicken',
					'vegetarian' => 'Vegetarian',
				),
				'value' => $registrant->getField('meals_day4_lunch_entree'),
			));
		?>
	</table>
	<table>
		<?php
			print_radio_field('meals_gala_dinner', array(
				'label' => 'Evening of Monday, Sept 13 &ndash; Gala Dinner',
				'required' => true,
				'options' => array(
					'yes' => 'Yes',
					'no' => 'No',
				),
				'value' => $registrant->getField('meals_gala_dinner'),
			));
		?>
	</table>
	<div id="meals_gala_dinner_yes">
		<table>
		<?php
			print_radio_field('meals_gala_dinner_vegetarian', array(
				'label' => 'Do you require a Vegetarian option for the Gala Dinner?',
				'required' => false,
				'options' => array(
								   'yes' => 'Yes',
								   'no' => 'No',
				),
				'value' => $registrant->getField('meals_gala_dinner_vegetarian'),
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
				'value' => $registrant->getField('meals_gala_dinner_guests'),
			));
		?>
	</table>
	<div id="meals_gala_dinner_guests_yes">
		<table>
			<?php
				print_text_field('meals_gala_dinner_numguests', array(
					'label' => 'Gala Dinner &ndash; Number of Guests',
					'required' => false,
					'value' => $registrant->getField('meals_gala_dinner_numguests'),
				));
			?>
		</table>
	</div>

	<p>(Note there is a $70/guest charge for the gala dinner that is required at time of registration.  This charge is non-refundable if not canceled by July 30th, 2010)</p>

	<div id="meals_gala_dinner_guests_nonzero">
		<p>Will your guests require a vegetarian option?</p>
		<table id="meals_gala_dinner_guests_vegetarian">
			<?php
				$galaGuests = $registrant->getGalaGuests();
				$numFilled = count($galaGuests);
				$numFields = $numFilled + 0;
				for ($i = 1; $i <= $numFields; $i++) {
					print_radio_field("meals_gala_dinner_guest_{$i}_vegetarian", array(
						'label' => "Guest #$i &ndash; Vegetarian",
						'required' => ($i <= $numFilled),
						'options' => array(
							'yes' => 'Yes',
							'no' => 'No',
						),
						'value' => ($i <= $numFilled) ? $galaGuests[$i - 1]->getField('vegetarian') : '',
					));
				}
			?>
		</table>
	</div>

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
				'value' => $registrant->getField('share_room'),
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
					'value' => $registrant->getField('gender'),
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
					'value' => $registrant->getField('arrival_date'),
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
					'value' => $registrant->getField('departure_date'),
				));
			?>
		</table>
	</div>
	<div id="share_room_no">
		<p>If you will not be sharing a room, please <a href="location.php" target="_blank">book your hotel room by clicking here</a>.</p>
	</div>
	</div>
	
	<h3>Payment</h3>
	<p>The registration fee covers the costs of all meeting sessions, breakfasts, breaks, and lunches. For questions and concerns regarding payment please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a>.  If your registration is not approved your registration fee will be refunded.</p>
	
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
			'value' => $registrant->getField('have_promo_code'),
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
				'required' => false,
				'value' => $registrant->getField('promo_code'),
			));
		?>
		</table>
		<p><input type="button" id="check_promo" value="Check Promotional Code" /></p>
	</div>

	<div id="promo_code_valid_and_no_guests" style="display:none">
		<strong>No payment is required.</strong>
	</div>

	<div id="payment_info">
	<div id="no_promo_code">
	<p>Registration fees (covers costs of all meeting sessions, breakfasts, breaks, and lunches):</p>
	<ul>
		<li>Early registration &ndash; <strong>on or before June 4, 2010</strong>:
			<ul>
				<li id="cost_postdoc">Post-doc/student: $150 USD</li>
				<li id="cost_other">Other: $250 USD</li>
			</ul>
		</li>
		<li>Late registration &ndash; <strong>between June 5, 2010 &ndash; July 23, 2010</strong>:
			<ul>
				<li id="cost_postdoc">Post-doc/student: $250 USD</li>
				<li id="cost_other">Other: $350 USD</li>
			</ul>
		</li>
	</ul>
	</div>

	<p>
		<?php
			$now = time();
		?>
		The date is <?php echo date('F j, Y', $now) ?>.
		<?php if ($now <= strtotime('June 4, 2010')) { ?>
			Early registration is open.
			<script type="text/javascript">
				var postdoc_fee = 150;
				var other_fee = 250;
			</script>
		<?php } else if ($now <= strtotime('July 23, 2010')) { ?>
			Early registration is closed. Late registration is open.
			<script type="text/javascript">
				var postdoc_fee = 250;
				var other_fee = 350;
			</script>
		<?php } else { ?>
			Registration is closed. No late or onsite registration is available.
		<?php } ?>
	</p>

	<p>
		Please click the Calculate Registration Fee button to detemine what you owe.
	</p>
	<p>
		<input type="button" id="calculate_fee" value="Calculate Registration Fee" />
	</p>
	<table id="price" style="display:none">
		<tr><th>Base fee</th><td>$<span id="base_fee">0</span> USD</td></tr>
		<tr><th>Gala dinner guest charge</th><td>$<span id="gala_dinner_guest_fee">0</span> USD</td></tr>
		<tr class="total"><th>Total registration fee</th><td>$<span id="total_fee">0</span> USD</td></tr>
	</table>
	
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
				'value' => $registrant->getField('payment_type'),
			));
		?>
	</table>
	<div id="payment_type_check">
		<p>If paying by <strong>check</strong>, press the "Calculate Registration Fee" button above, and mail a check made out to the "Jain Foundation Inc" for the amount displayed as your "Total Registration Fee" to the following address:</p>
		
		<p>
			Jain Foundation Conference Registration<br />
			2310 130th Ave NE<br />
			Suite B101<br />
			Bellevue, WA 98005
		</p>
		
		<p>The check must be <strong>received</strong> within 20 days of registration or applicant will be unregistered. You will receive a notification if your registration status has changed.</p>
	</div>
	<div id="payment_type_credit_card">
		<p>If paying by <strong>credit card</strong>, please see the below instructions. Please note that you are <strong>not</strong> required to have a PayPal account to pay by credit card.</p>

		<ol>
			<li>Please press the "Calculate Registration Fee" button above. Your "Total Registration Fee" will appear.</li>
			<li>Follow the <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=5SR6XJUWHXNLY">PayPal link</a>.</li>
			<li>Enter your "Total Registration Fee" determined in step 1 in the "Unit Price" box and press the "Update Totals" button.</li>
			<li>If you do <strong>not</strong> have a PayPal account, please follow the "continue" link on the bottom left-hand side of the screen and proceed as prompted.</li>
			<li>If you <strong>do</strong> have a PayPal account, please log in and proceed as prompted.</li>
		</ol>

		<p>PayPal will automatically send the Jain Foundation a receipt of your payment.  If the Jain Foundation does not receive receipt of your payment within 24 hours of your registration you will be unregistered. You will receive a notification if your registration status has changed.</p>
	</div>
	</div>
	
	<h3>Comments</h3>
	<p>Please use this box to indicate anything that you need to convey to the Jain Foundation regarding your registration submission.</p>
	<?php
		print_textarea_field('comments', array(
			'label' => 'Comments',
			'required' => false,
			'value' => $registrant->getField('comments'),
		));
	?>
	
	<p>
		<input type="submit" name="action" value="Submit" />
	</p>			
</form>

<?php
	printFooter();
?>
