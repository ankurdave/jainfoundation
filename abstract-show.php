<?php
	require 'lib.php';
	
	$form_location = 'abstract';
	
	$data = getAbstract($_GET['id'], $_GET['auth_key']);
	if (!$data) {
		header("Location: $form_location");
		exit;
	}
	
	// Escape all data fields before printing
	$data_raw = $data;
	$data = array_map('htmlentities', $data);
	
	// Output a Word document with HTML in it
	// See http://stackoverflow.com/questions/124959/create-word-document-using-php-in-linux#answer-125009
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment; filename=abstract-" . $_GET['id'] . ".doc"); // note: inserting the ID without escaping is OK because, if it was an HTML injection, it wouldn't have existed in the DB
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo $data['abstract_title'] ?> &ndash; <?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>, <?php echo $data['degree'] ?></title>
<body>

<h1 class="author"><?php echo $data['firstname'] ?> <?php echo $data['middlename'] ?> <?php echo $data['lastname'] ?>, <?php echo $data['degree'] ?></h1>

<p class="affiliation_1"><?php echo $data['affiliation_1'] ?></p>

<p class="email"><a href="mailto:<?php echo urlencode($data_raw['email']) ?>"><?php echo $data['email'] ?></a></p>

<h2 class="abstract_title"><?php echo $data['abstract_title'] ?></h2>

<p class="authors">
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
</p>

<p class="affiliations">
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
</p>

<p class="abstract_body">
<?php
	print str_replace("\n\n", "</p><p>", $data['abstract_body']);
?>
</p>

</body>
</html>
