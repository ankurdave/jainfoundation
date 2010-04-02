<?php
	require 'includes/lib.php';
	
	printHeader(array('title' => 'Conference 2010 | List of Registrants'));
	
	$db = connectToDB();
	$result = $db->query('SELECT * FROM registrant');
?>

<h1>Registrants</h1>

<?php include 'includes/menu.inc.php' ?>

<?php
	$i = 0;
	while ($data = $result->fetch_assoc()) {
		$i++;
		
		unset($data['auth_key']); // don't print the auth_key, for security reasons
?>
		<table class="db_list_entry" id="registrant<?php echo print_html($data['id']) ?>">
<?php
		$i = 0;
		foreach ($data as $key => $val) { ?>
			<tr class="<?php echo $i % 2 == 0 ? 'row_even' : 'row_odd' ?>">
				<th><?php echo print_html($key) ?></th>
				<td><?php echo print_html($val) ?></td>
				<td class="action">
					<?php
						if ($key == 'id') {
							?>
							(<a href="register-delete.php?id=<?php echo urlencode($data['id']) ?>">delete</a>)
							<?php
						}
					?>
				</td>
			</tr>
<?php
			$i++;
		} ?>
		</table>
<?php
	}

	$result->free();
	
	printFooter();
?>
