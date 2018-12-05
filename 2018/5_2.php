<?php
$raw_input = trim(file_get_contents('input'));
$input = $raw_input;
$couples = array();
foreach(range('a', 'z') as $number => $letter) {
	$couples[] = strtoupper($letter) . $letter;
	$couples[] = $letter . strtoupper($letter);
}
$var = $input;
$keys = array();
foreach(range('a', 'z') as $letter) {
	$x = str_replace(array($letter, strtoupper($letter)), '', $var);
	do {
		$length = strlen($x);
		$x = str_replace($couples, '', $x);
	} while(strlen($x) < $length);

	$keys[] = $length;
}
echo min($keys);
die();
do {
	$length = strlen($var);
	$var = str_replace($couples, '', $var);
} while(strlen($var) < $length);

echo strlen($var);
