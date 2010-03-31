<?php
	include 'includes/lib.php';
?>
{
	"valid": <?php echo RegistrantDAO::checkPromoCode($_GET['promoCode']) ? "true" : "false" ?>
}
