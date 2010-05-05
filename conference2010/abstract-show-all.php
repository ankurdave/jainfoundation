<?php

require 'includes/lib.php';

passwordProtect('Conference pages', array('jainfoundation' => 'speed4jf'));

header("Content-Type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=abstracts.doc");

printAbstractHead();

$db = connectToDB();
$abstracts = AbstractDAO::loadAll($db);
foreach ($abstracts as $abstract) {
	printAbstractBody($abstract);
}

printAbstractFoot();

?>
