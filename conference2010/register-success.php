<?php
	include 'includes/lib.php';

	$form_location = 'register.php';

	$db = connectToDB();
	if (isset($_GET['id'])) {
		$registrant = new RegistrantDAO($db, $_GET['id']);
	} else {
		header("Location: $form_location");
		exit;
	}
	
	printHeader(array('title' => 'Conference 2010 | Meeting Registration Thank You', 'page_nav_id' => 'register'));
?>

<?php include 'includes/conference-title.inc.php' ?>

<?php include 'includes/menu.inc.php' ?>

<h2>Meeting Registration Thank You</h2>

<p>Thank you for registering for the Fourth Annual Dysferlin Conference. Please print this page for your records.</p>

<p>The Jain Foundation will let you know if your registration has been approved within the next week.  If you do not hear from us within a week of your registration or have any questions please contact Angela Salerno at <a href="mailto:asalerno@jain-foundation.org">asalerno@jain-foundation.org</a>. Your registration fee will be reimbursed if your registration is not approved.</p>

<p>Your Total Registration Fee is <strong>$<?php echo print_html($registrant->getField('total_fee')) ?></strong>.  The registration fees cover the costs of all meeting sessions, breakfasts, breaks, lunches, and the cost of guests for the gala dinner (if applicable).</p>

<p>If paying by <strong>check</strong>, the check must be received within 20 days of registration or applicant will be unregistered. You will receive a notification if your registration status has changed. Please make out the check to the "Jain Foundation, Inc" and send to the Jain Foundation at the following address:</p>

<p>
	Jain Foundation Conference Registration<br />
	2310 130th Ave NE<br />
	Suite B101<br />
	Bellevue, WA 98005
</p>

<p>If paying by <strong>credit card</strong>, please see the below instructions. Please note that you are <strong>not</strong> required to have a PayPal account to pay by credit card.</p>

		<ol>
			<li>Please note your Total Registration Fee shown above.</li>
			<li>Follow the <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=5SR6XJUWHXNLY" target="_blank">PayPal link</a>.</li>
			<li>Enter your "Total Registration Fee" determined in step 1 in the "Unit Price" box and press the "Update Totals" button.</li>
			<li>If you do <strong>not</strong> have a PayPal account, please follow the "continue" link on the bottom left-hand side of the screen and proceed as prompted.</li>
			<li>If you <strong>do</strong> have a PayPal account, please log in and proceed as prompted.</li>
		</ol>

		<p>PayPal will automatically send the Jain Foundation a receipt of your payment.  If the Jain Foundation does not receive receipt of your payment within 24 hours of your registration you will be unregistered. You will receive a notification if your registration status has changed.</p>
<?php
	printFooter();
?>
