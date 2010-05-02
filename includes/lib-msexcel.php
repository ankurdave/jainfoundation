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
    return utf16_encode(join("\t", array_map('remove_linebreaks', $row)) . "\r\n");
}

/**
 * Returns the Excel-formatted version of the given cell. Alternative to xlsWriteRow
 */
function xlsWriteCell($cell) {
	return utf16_encode(remove_linebreaks($cell));
}

/**
 * Returns the Excel cell separator. Alternative to xlsWriteRow
 */
function xlsWriteCellSeparator() {
	return utf16_encode("\t");
}

/**
 * Returns the Excel row terminator. Alternative to xlsWriteRow
 */
function xlsWriteRowTerminator() {
	return utf16_encode("\r\n");
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

function utf16_encode($string) {
	return mb_convert_encoding($string, 'UTF-16LE', 'UTF-8');
}

?>
