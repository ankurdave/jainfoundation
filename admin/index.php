<?php
	include 'includes/lib.php';
	
	printHeader(array('title' => 'Admin'));
?>

<h1>Admin Pages</h1>

<h2>Patient registrations</h2>
<ul>
	<li><a href="data.php">List patient registrations</a></li>
	<li><a href="export.php">Export patient registrations</a> (Excel spreadsheet)</li>
</ul>

<h2>Conference 2010 registrations</h2>
<ul>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/register-list.php">List conference registrations</a></li>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/register-export.php">Export conference registrations</a> (Excel spreadsheet)</li>
</ul>

<h2>Conference 2010 abstracts</h2>
<ul>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/abstract-list.php">List abstract submissions</a></li>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/abstract-export.php">Export abstract submissions</a> (Excel spreadsheet)</li>
	<li><a href="<?php echo $Config['URLPath'] ?>/conference2010/abstract-show-all.php">Export abstracts</a> (Word document)</li>
</ul>

<?php
	printFooter();
?>
