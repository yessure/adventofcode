<?php
$raw_input = trim(file_get_contents('input'));
$input = $raw_input;

$couples = array();
foreach(range('a', 'z') as $letter) {
	$couples[] = strtoupper($letter) . $letter;
	$couples[] = $letter . strtoupper($letter);
}
$var = $input;
do {
	$length = strlen($var);
	$var = str_replace($couples, '', $var);
} while(strlen($var) < $length);

echo strlen($var);
