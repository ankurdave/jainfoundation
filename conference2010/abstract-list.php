<?php

require 'includes/lib.php';

passwordProtect('Conference pages', array('jainfoundation' => 'speed4jf'));

printHeader(array('title' => 'Conference 2010 | List of Abstracts'));

?>
<h1>List of Abstracts</h1>
<?php

include 'includes/menu.inc.php';

$db = connectToDB();
$abstracts = AbstractDAO::loadAll($db);

include 'includes/abstract-export-fields.php';

foreach ($abstracts as $abstract) {
?>
	<table class="db_list_entry <?php echo $abstract->getField('final') ? '' : 'unfinished' ?>" id="abstract<?php echo print_html($abstract->getField('id')) ?>">
<?php
	$i = 0;
	foreach ($fields as $fieldName => $inRegistrant) {
?>
		<tr class="<?php echo $i % 2 == 0 ? 'row_even' : 'row_odd' ?>">
			<th><?php echo print_html($fieldName) ?></th>
			<td>
				<?php echo print_html($inRegistrant ? $abstract->getRegistrant()->getField($fieldName) : $abstract->getField($fieldName)) ?>
				<span class="action">
<?php
					if ($fieldName == 'id') {
?>
						(<a href="register-2.php?id=<?php echo urlencode($abstract->getRegistrant()->getField('id')) ?>&amp;edit=true" target="_blank">edit</a>,
						<a href="abstract-delete.php?id=<?php echo urlencode($abstract->getField('id')) ?>">delete</a>)
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
	</table>
<?php
}

printFooter();

?>
