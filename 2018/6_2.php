<?php
$raw_input = trim(file_get_contents('input'));

$input = explode(PHP_EOL, $raw_input);
$input = explode("\n", $input[0]);

$alphabet = range(1,100);

$points = array();
$point_names = array();
foreach($input as $key => &$space_element) {
	$space_element = explode(", ", $space_element);
	$points[$alphabet[$key]] = $space_element;
	$point_names[$alphabet[$key]] = true;
}
$result = 0;

$array = array();
$keys = array();

$max_x = max(array_column($points, 0));
$max_y = max(array_column($points, 1));

$areas = array();
$map = array();
foreach($points as $key => &$row) {
	for($i = 0; $i <= $max_x * 2; $i++) {
		for($j = 0; $j <= $max_y * 2; $j++) {
			$map[$j][$i][$key] = abs($row[0] - $i) + abs($row[1] - $j);				
		}
	}
}
foreach($map as $m => &$foo){
	foreach($foo as $l => &$line) {
		$line = array_sum($line);
		if($line < 10000) {
			$result++;
		}
		unset($line);
	}
}
echo $result;
