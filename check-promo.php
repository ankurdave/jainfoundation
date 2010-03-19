<?php
	include 'includes/lib.php';
?>
{
	"valid": <?php echo promo_code_valid($_GET['promoCode']) ? "true" : "false" ?>
}
