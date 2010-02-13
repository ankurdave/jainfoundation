<div class="abstract">

<h1 class="author" style="margin:0in"><?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>, <?php echo $data['degree'] ?></h1>
<p style="margin:0in">
	<span class="affiliation_1"><?php echo $data['affiliation_1'] ?></span><br>
	<span class="email"><a href="mailto:<?php echo urlencode($data_raw['email']) ?>"><?php echo $data['email'] ?></a></span>
</p>

<p>&nbsp;</p>

<img src="http://<?php echo $_SERVER['HTTP_HOST'], preg_replace('~/[^/]+$~', '', $_SERVER['PHP_SELF']), "/abstract-image.php?id=" . $data['id'] ?>" class="picture" width="144" align="left" hspace="13" vspace="13" />

<h2 class="abstract_title"><?php echo $data['abstract_title'] ?></h2>

<p>
<span class="authors">
<?php
	// Get the parallel arrays with keys matching author_*_{firstname,middlename,lastname,affiliation} and reindex them with array_values() so they can be traversed with a for loop
	$authors_firstname = array_values(preg_grep('/^author_\d+_firstname$/', array_keys($data)));
	$authors_middlename = array_values(preg_grep('/^author_\d+_middlename$/', array_keys($data)));
	$authors_lastname = array_values(preg_grep('/^author_\d+_lastname$/', array_keys($data)));
	$authors_affiliation = array_values(preg_grep('/^author_\d+_affiliation$/', array_keys($data)));
	
	// Traverse the author key arrays in parallel and print each author if any of his fields are populated
	$authors = array();
	for ($i = 0; $i < count($authors_firstname); $i++) {
		if ($data[$authors_firstname[$i]] || $data[$authors_middlename[$i]] || $data[$authors_lastname[$i]] || $data[$authors_affiliation[$i]]) {
			$authors[] = $data[$authors_firstname[$i]] . ' '
				. $data[$authors_middlename[$i]] . ' '
				. $data[$authors_lastname[$i]] . ' '
				. '<sup>' . $data[$authors_affiliation[$i]] . '</sup>';
		}
	}
	print join(', ', $authors);
?>
</span>
<br />
<span class="affiliations">
<?php
	// Get the array with keys matching affiliation_* and reindex it with array_values() so it can be traversed with a for loop
	$affiliations = array_values(preg_grep('/^affiliation_\d+$/', array_keys($data)));
	
	// Traverse the affilation key array and print each non-empty affiliation
	$affiliations_out = array();
	for ($i = 0; $i < count($affiliations); $i++) {
		if ($data[$affiliations[$i]]) {
			$affiliations_out[] = '<sup>' . ($i + 1) . '</sup>'
				. $data[$affiliations[$i]];
		}
	}
	print join('; ', $affiliations_out);
?>
</span>
</p>

<div class="abstract_body">
<p>
<?php
	print preg_replace('/(\\r?\\n){2,}/', "</p><p>", $data['abstract_body']);
?>
</p>
</div>

<br class="pagebreak" />

</div>
