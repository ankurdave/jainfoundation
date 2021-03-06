<?php

require 'includes/lib.php';

passwordProtect('Conference pages', array('jainfoundation' => 'speed4jf'));

printHeader(array('title' => 'Conference 2010 | List of Registrants'));

?>

<h1>Registrants</h1>

<?php include 'includes/menu.inc.php' ?>

<?php

$registrants = RegistrantDAO::getAll(connectToDB());
foreach ($registrants as $registrant) {
?>
	<table class="db_list_entry <?php echo $registrant->getField('final') ? '' : 'unfinished' ?>" id="registrant<?php echo print_html($registrant->getField('id')) ?>">
<?php
	$i = 0;
	foreach ($registrant->getFields() as $key => $val) {
?>
		<tr class="<?php echo $i % 2 == 0 ? 'row_even' : 'row_odd' ?>">
			<th><?php echo print_html($key) ?></th>
			<td>
				<?php echo print_html($val) ?>
				<span class="action">
<?php
					if ($key == 'id') {
?>
						(<a href="register.php?id=<?php echo urlencode($registrant->getField('id')) ?>&amp;edit=true" target="_blank">edit</a>,
						<a href="register-delete.php?id=<?php echo urlencode($registrant->getField('id')) ?>">delete</a>)
<?php
					}
?>
				</span>
			</td>
		</tr>
<?php
		$i++;
	}
?>
		<tr class="<?php echo $i % 2 == 0 ? 'row_even' : 'row_odd' ?>">
			<th>Gala Guest Vegetarian Options</th>
			<td><table class="db_list_subentry">
<?php
			$j = 0;
			foreach ($registrant->getGalaGuests() as $galaGuest) {
?>
				<tr class="<?php echo $j % 2 == 0 ? 'row_even' : 'row_odd' ?>">
					<th>Guest&nbsp;#<?php echo $j + 1 ?></th>
					<td><?php echo print_html($galaGuest->getField('vegetarian')) ?></td>
				</tr>
<?php
				$j++;
			}
?>
			</table></td>
		</tr>
	</table>
<?php
}

printFooter();

?>
