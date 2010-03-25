<?	session_start();	if(isset($_SESSION['SESSION_ID'])){		$login = true;	}else{		session_destroy();		$login=false;		include "login.php";		exit;	}?><?include('includes/mysql.php');

// See http://php.net/manual/en/function.html-entity-decode.php
// This is necessary because html_entity_decode isn't working properly on this server (PHP 4.3.9) for some reason
function unhtmlentities($string) {
	// replace numeric entities
	$string = preg_replace('~&#x([0-9a-f]+);~ei', 'unichr(hexdec("\\1"))', $string);
	$string = preg_replace('~&#([0-9]+);~e', 'unichr("\\1")', $string);
	// replace literal entities
	$trans_tbl = get_html_translation_table(HTML_ENTITIES);
	$trans_tbl = array_flip($trans_tbl);
	return strtr($string, $trans_tbl);
}
function unichr($u) {
	return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
}
// XLS creation tools
function xlsBegin() {
    return chr(255) . chr(254);
}
function xlsWriteRow($row) {
    return convert_utf8_to_utf16(join("\t", $row) . "\r\n");
}
// Returns UTF-16 text
// See http://xhtml.net/breves/435-Un-parlement-ouvert-et-au-passage-Excel-csv-et-utf-8
function convert_utf8_to_utf16($text) {
	return mb_convert_encoding($text, 'UTF-16LE', 'UTF-8');
}
function convert_mixed_to_utf8_no_linebreaks($text) {
	$text = str_replace("\n", '', $text);
	$text = str_replace("\r", '', $text);
	$text = utf8_encode($text);
	$text = unhtmlentities($text);
	return $text;
}
$select = "SELECT * FROM registrants order by patient_id desc";$export = mysql_query($select);$fields = mysql_num_fields($export); 

// Print the HTTP headers
header("Content-Type: text/csv");header("Content-Disposition: attachment; filename=patient-data.csv");

// IE has a bug that breaks downloads from SSL sites with the no-cache header set (see http://support.microsoft.com/kb/812935).
// The previous developer had used the following header:
// header("Pragma: no-cahce"); // note the typo!
// The typo caused the Pragma header to be reset, avoiding the bug. If the typo is fixed, the bug is triggered. If the entire line is removed, PHP still defaults to no-cache, again triggering the bug (see http://www.php.net/manual/en/function.header.php#46846).
// Therefore we must clear the caching header.
header('Pragma:');

// Print the data
print xlsBegin();

$header = array();
for ($i = 0; $i < $fields; $i++) {    $header[] = mysql_field_name($export, $i);}
print xlsWriteRow($header);
while($row = mysql_fetch_row($export)) {
	print xlsWriteRow(array_map('convert_mixed_to_utf8_no_linebreaks', $row));
}?>
