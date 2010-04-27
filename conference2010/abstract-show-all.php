<?php

require 'includes/lib.php';

header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=abstracts.doc");

printAbstractHead();

$db = connectToDB();
$abstracts = AbstractDAO::loadAll();
foreach ($abstracts as $abstract) {
	printAbstractBody($abstract);
}

printAbstractFoot();

?>
