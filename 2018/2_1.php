<?php
$raw_input = trim(file_get_contents('input.txt'));
$input = explode(PHP_EOL, $raw_input);
$input = preg_replace('!\s+!', ' ', $input);

foreach($input as &$space_element) {
	$space_element = explode(" ", $space_element);
}

$array = array();

foreach($input as &$line) {
	foreach($line as &$word) {
		$word = str_split($word);
	}
}

foreach($input as &$pline) {
	foreach($pline as &$element) {
		$already = array();
		foreach(array_count_values($element) as $key => $value) {
			if(!isset($already[$value])) {
				if($value !== 1) {
					if(isset($array[$value])){
						$array[$value]++;
					} else {
						$array[$value] = 1;
					}
				}
				$already[$value] = true;
			}
		}
	}
}
$result = 1;
foreach($array as $number) {
	$result = $result * ($number);
}

echo $result;
