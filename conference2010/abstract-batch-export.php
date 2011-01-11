<?php
header('Content-Type: text/plain');

require 'includes/lib.php';

$db = connectToDB();
$abstracts = AbstractDAO::loadWithIDs($db, explode(',', $_GET['ids']));
foreach ($abstracts as $abstract) {
	?>
	<h4 class="author">
		<?php
		fReg('firstname');
		print " ";
		fReg('middlename');
		print " ";
		fReg('lastname');

		$degree = $abstract->getRegistrant()->getField('degree');
		if ($degree != 'none') {
			print ", ";
			if ($degree == 'other') {
				fReg('degree_other');
			} else {
				fReg('degree');
			}
		}
		?>
	</h4>
	<p class="affiliation_1">
		<?php
		  $affiliations = $abstract->getAffiliations();
		  echo print_html($affiliations[0]->getField('affiliation'));
	?>
			  </p>
					<p class="email"><?php fReg('email') ?></p>
					<h5 class="abstract_title"><?php f('abstract_title') ?></h5>
					<p class="authors">
					<?php
					$authorsOut = array();
	foreach ($abstract->getAuthors() as $a) {
		$authorsOut[] = $a->getField('firstname') . ' '
			. $a->getField('middlename') . ' '
			. $a->getField('lastname') . ' '
			. '<sup>' . $a->getField('affiliations') . '</sup>';
	}
	print join(', ', $authorsOut);
	?>
		</p>
			  <p class="affiliations">
			  <?php
			  $affiliationsOut = array();
	$i = 1;
	foreach ($affiliations as $a) {
		$affiliationsOut[] = '<sup>' . ($i++) . '</sup>'
			. $a->getField('affiliation');
	}
	print join('; ', $affiliationsOut);
	?>
		</p>
			  <img src="http://<?php echo $_SERVER['HTTP_HOST'], preg_replace('~/[^/]+$~', '', $_SERVER['PHP_SELF']), "/abstract-image.php?id=" . urlencode($abstract->getField('id')) ?>" class="picture">
			  <p class="abstract_body">
			  <?php
			  print preg_replace('/(\\r?\\n){2,}/', "", print_html($abstract->getField('abstract_body')));
	?>
			  </p>
					<?php
					}
?>