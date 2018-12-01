<?php
$raw_input = trim(file_get_contents('input.txt'));
$input = explode(PHP_EOL, $raw_input);
$input = preg_replace('!\s+!', ' ', $input);
foreach($input as &$space_row) {
	$space_row = explode(" ", $space_row);
}

$result = 0;

$numbers = array();
foreach($input as &$pline) {
	foreach($pline as &$pword) {
		$result += $pword;
	}
}

echo $result;
