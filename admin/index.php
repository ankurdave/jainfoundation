<?php
	include 'includes/lib.php';
	
	printHeader(array('title' => 'Admin'));
?>

<h1>Admin Pages</h1>

<ul>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/register-export.php">Export registrations</a></li>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/register-list.php">List registrations</a></li>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/abstract-show-all.php">Export abstracts</a></li>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/abstract-export.php">Export abstract submission info</a></li>
</ul>

<?php
	printFooter();
?>
