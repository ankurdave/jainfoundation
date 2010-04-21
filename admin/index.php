<?php
	include 'includes/lib.php';
	
	printHeader(array('title' => 'Admin'));
?>

<h1>Patient Admin</h1>

<h2>Patient registrations</h2>
<ul>
	<li><a href="data.php">List patient registrations</a></li>
	<li><a href="export.php">Export patient registrations</a> (Excel spreadsheet)</li>
</ul>

<?php
	printFooter();
?>
