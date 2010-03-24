<?php

/**
 * Returns the beginning (BOM) of a Unicode Excel file.
 */
function xlsBegin() {
    return chr(255) . chr(254);
}

/**
 * Returns an Excel row.
 * @param array $row the cells to print
 */
function xlsWriteRow($row) {
    return mb_convert_encoding(join("\t", array_map('remove_linebreaks', $row)) . "\r\n", 'UTF-16LE', 'UTF-8');
}

/**
 * Removes the linebreaks (CR and LF) from a string so it can be written as a CSV field.
 */
function remove_linebreaks($text) {
	$text = str_replace("\n", '', $text);
	$text = str_replace("\r", '', $text);
	return $text;
}

/**
 * Encodes a CSV field by adding surrounding quotes, and escaping the quote marks within it.
 */
function csv_encode($string) {
	return '"' . str_replace('"', '""', $string) . '"';
}

?>
