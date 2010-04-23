<?php

/**
 * Given the numerical index of the current registration page, prints an HTML form navigation menu.
 */
function registerMenu($pageIndex) {
	$pageInfo = array(
		1 => 'Personal Information',
		2 => 'Abstract Submission',
		3 => 'Registration Information',
	);
	$pages = array();
	foreach ($pageInfo as $index => $label) {
		$currentPageHtml = ($index == $pageIndex) ? 'disabled="disabled"' : '';
		$pages[] = <<<EOS
			<li><input type="submit" name="jump$index" value="$label" $currentPageHtml></li>
EOS;
	}
	$pagesHtml = join(' ', $pages);
	
	return <<<EOS
<div class="jump">
<p>Save and jump to:</p>
<ol class="form_nav">
	$pagesHtml
</ol>
</div>
EOS;
}

?>