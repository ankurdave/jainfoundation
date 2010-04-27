<?php

  /**
   * Password protects any page where it is called, using digest authentication. Note: only supports PHP running as an Apache module, not in CGI. See php.net/manual/en/features.http-auth.php
   * @param string $realm the digest authentication realm to use. You must escape any weird characters in it yourself.
   * @param array $users the assoc array of usernames and passwords to allow
   */
function passwordProtect($realm, $users) {
	if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
		send401($realm);
	}

	// Analyze the PHP_AUTH_DIGEST variable
	if (!($data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST'])) || !isset($users[$data['username']])) {
		send401($realm);
	}

	// Generate the valid response
	$A1 = md5($data['username'] . ':' . $realm . ':' . $users[$data['username']]);
	$A2 = md5($_SERVER['REQUEST_METHOD'] . ':' . $data['uri']);
	$valid_response = md5($A1 . ':' . $data['nonce'] . ':' . $data['nc'] . ':' . $data['cnonce'] . ':' . $data['qop'] . ':' . $A2);

	if ($data['response'] != $valid_response) {
		die('Wrong username or password. <a href="">Try again.</a>');
	}
}

function send401($realm) {
	header('HTTP/1.1 401 Unauthorized');
	header('WWW-Authenticate: Digest realm="' . $realm . '",qop="auth",nonce="' . uniqid() . '",opaque="' . md5($realm) . '"');
	die("You must enter a username and password to access $realm. <a href=\"\">Try again.</a>");
}

/**
 * Parses the $_SERVER['PHP_AUTH_DIGEST'] variable, returning an array of parts. Copied straight from http://php.net/manual/en/features.http-auth.php
 */
function http_digest_parse($txt) {
	// protect against missing data
	$needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
	$data = array();
	$keys = implode('|', array_keys($needed_parts));

	preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

	foreach ($matches as $m) {
		$data[$m[1]] = $m[3] ? $m[3] : $m[4];
		unset($needed_parts[$m[1]]);
	}

	return $needed_parts ? false : $data;
}


?>