<?php
	include 'includes/lib.php';
	
	printHeader(array('title' => 'Admin'));
?>

<h1>Admin Pages</h1>

<ul>
	<li><a href="register-export.php">Export registrations</a></li>
	<li><a href="register-list.php">List registrations</a></li>
	<li><a href="abstract-show-all.php">Export abstracts</a></li>
	<li><a href="abstract-export.php">Export abstract submission info</a></li>
</ul>

<?php
	printFooter();
?>
