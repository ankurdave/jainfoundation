<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css">
	@page {
		margin: 1in;
	}
	body {
		font-family: Helvetica, Arial, sans-serif;
		font-size: 9pt;
		background: white;
		color: black;
		line-height: 115%;
	}
	.author {
		font-size: 11pt;
		font-weight: bold;
		color: #000080;
	}
	.affiliation_1 {
		font-style: italic;
	}
	.email a {
		color: black;
		text-decoration: none;
	}
	.abstract_title {
		font-size: 9pt;
		font-weight: bold;
		color: black;
	}
	.authors, .affiliations {
		font-size: 8pt;
	}
	.picture {
		float: left;
		width: 1.5in;
		margin-right: 0.13in;
	}
	.abstract_body p {
		margin: 0;
		margin-bottom: 0.14in;
	}
</style>

<title><?php echo $data['abstract_title'] ?> &ndash; <?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>, <?php echo $data['degree'] ?></title>
<body>

<h1 class="author"><?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>, <?php echo $data['degree'] ?></h1>

<p class="affiliation_1"><?php echo $data['affiliation_1'] ?></p>

<p class="email"><a href="mailto:<?php echo urlencode($data_raw['email']) ?>"><?php echo $data['email'] ?></a></p>

<img src="http://<?php echo $_SERVER['HTTP_HOST'], preg_replace('~/[^/]+$~', '', $_SERVER['PHP_SELF']), "/abstract-image?id=" . $data['id'] . "&auth_key=" . $data['auth_key'] ?>" class="picture" align="left" />

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

</body>
</html>
