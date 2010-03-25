<?php

//create array to temporarily grab variables
$post_arr = array();
//grabs the $_POST variables and adds slashes
foreach ($_POST as $key => $post_arr) {
    $_POST[$key] = addslashes($post_arr);
}

//create array to temporarily grab variables
$get_arr = array();
//grabs the $_GET variables and adds slashes
foreach ($_GET as $key => $get_arr) {
    $_GET[$key] = addslashes($get_arr);
}

//create array to temporarily grab variables
$req_arr = array();
//grabs the $_REQUEST variables and adds slashes
foreach ($_REQUEST as $key => $req_arr) {
    $_REQUEST[$key] = addslashes($req_arr);
}

?>
