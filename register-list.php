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
		
		// Escape all data fields before printing
		$data_raw = $data;
		$data = array_map('print_html', $data);
		unset($data['auth_key']); // don't print the auth_key, for security reasons
?>
		<table>
<?php		
		foreach ($data as $key => $val) { ?>
			<tr>
				<th><?php echo print_html($key) ?></th>
				<td><?php echo $val ?></td>
			</tr>
<?php
		} ?>
		</table>
<?php
	}

	$result->free();
	
	printFooter();
?>
