<div class="abstract">

	 <h1 class="author"><?php
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
	?></h1>

<p style="margin:0in">
	<span class="affiliation_1"><?php
		echo print_html($affiliations[0]->getField('affiliation'));
	?></span><br>
	<span class="email"><a href="mailto:<?php fReg('email') ?>"><?php fReg('email') ?></a></span>
</p>

<h2 class="abstract_title"><?php f('abstract_title') ?></h2>

<p>
<span class="authors">
<?php
	$authorsOut = array();
	foreach ($authors as $a) {
		$authorsOut[] = $a->getField('firstname') . ' '
				. $a->getField('middlename') . ' '
				. $a->getField('lastname') . ' '
				. '<sup>' . $a->getField('affiliations') . '</sup>';
	}
	print join(', ', $authorsOut);
?>
</span>
<br />
<span class="affiliations">
<?php
	$affiliationsOut = array();
	$i = 1;
	foreach ($affiliations as $a) {
		$affiliationsOut[] = '<sup>' . ($i++) . '</sup>'
			. $a->getField('affiliation');
	}
	print join('; ', $affiliationsOut);
?>
</span>
</p>

<p style="clear:both">&nbsp;</p>

<img src="http://<?php echo $_SERVER['HTTP_HOST'], preg_replace('~/[^/]+$~', '', $_SERVER['PHP_SELF']), "/abstract-image.php?id=" . urlencode($abstract->getField('id')) ?>" class="picture" width="100" align="left" hspace="13" vspace="13" />

<div class="abstract_body">
<p>
<?php
	print preg_replace('/(\\r?\\n){2,}/', "", print_html($abstract->getField('abstract_body')));
?>
</p>
</div>

<br class="pagebreak" />

</div>
