<?php

/**
 * Given the numerical index of the current registration page, returns an HTML form navigation menu.
 */
function registerMenu($pageIndex) {
	$pageInfo = array(
		1 => 'Personal Information',
		2 => 'Abstract Submission',
		3 => 'Registration Information',
		4 => 'Submit Registration',
	);
	$extraActions = array(
		2 => array('preview_abstract' => 'Preview Abstract'),
	);
	
	// Create the HTML for the "Previous" button
	$prevIndex = $pageIndex - 1;
	if (isset($pageInfo[$prevIndex])) {
		$prevHtml = <<<EOS
<div class="prev">
	<input type="submit" name="jump_prev" value="Back &ndash; {$pageInfo[$prevIndex]}">
</div>
EOS;
	}

	// Create the HTML for the "Next" button
	$nextIndex = $pageIndex + 1;
	if (isset($pageInfo[$nextIndex])) {
		$description = ($nextIndex < 4)
			? "Next &ndash; {$pageInfo[$nextIndex]}"
			: $pageInfo[$nextIndex];
		$nextHtml = <<<EOS
<div class="next">
	<input type="submit" name="jump_next" value="$description">
</div>
EOS;
	}

	// Create the HTML for any extra actions
	$extraHtml = "";
	if (isset($extraActions[$pageIndex])) {
		foreach ($extraActions[$pageIndex] as $name => $desc) {
			$extraHtml .= <<<EOS
<div class="extra">
	<input type="submit" name="$name" value="$desc">
</div>
EOS;
		}
	}

	// Wrap the buttons in a div and return it
	return <<<EOS
<div class="jump">
	$extraHtml
	$nextHtml
</div>
EOS;
}

?>