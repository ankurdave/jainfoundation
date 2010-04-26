<?php

/**
 * Prints the specified abstract field, HTML-encoded.
 */
function f($field) {
	global $abstract;
	echo print_html($abstract->getField($field));
}

/**
 * Prints the specified registrant field, HTML-encoded.
 */
function fReg($field) {
	global $abstract;
	echo print_html($abstract->getRegistrant()->getField($field));
}

function printAbstractHead() {
	include 'abstract-show-template-head.inc.php';
}

function printAbstractBody($abstract) {
	$authors = $abstract->getAuthors();
	$affiliations = $abstract->getAffiliations();

	include 'abstract-show-template-body.inc.php';
}

function printAbstractFoot() {
	include 'abstract-show-template-foot.inc.php';
}

?>