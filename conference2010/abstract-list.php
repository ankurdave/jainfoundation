<?php
	require 'includes/lib.php';

	printHeader(array('title' => 'Conference 2010 | List of Abstracts'));

	$db = connectToDB();
	$result = $db->query('SELECT id, firstname, middlename, lastname, degree, department, institution, street_address, city, state_province, zip_postal_code, country, phone, fax, email, author_status, degree_year, abstract_category, abstract_category_other, presentation_type, abstract_title, comments FROM abstract');
?>

<h1>List of Abstracts</h1>

<?php include 'includes/menu.inc.php' ?>

<?php
	$i = 0;
	while ($data = $result->fetch_assoc()) {
		$i++;
?>
		<table class="db_list_entry" id="abstract<?php echo print_html($data['id']) ?>">
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
							(<a href="abstract-delete.php?id=<?php echo urlencode($data['id']) ?>">delete</a>)
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
