<?php
$raw_input = trim(file_get_contents('input.txt'));
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
$count = 0;

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
		$min_val = min($line);
		$val = array_search($min_val, $line);
		if($m == 0 || $m == $max_y || $l == 0 || $l == $max_x) {
			if(isset($point_names[$val])) {
				unset($point_names[$val]);
			}
		}		
		unset($line[$val]);
		if(min($line) == $min_val) {
			$line = '.';
		} else {
			$line = $val;
		}
	}
}

foreach($point_names as $my_point => $k) {
	$result2 = 0;
	foreach($map as $linex) {
		$result2 += (isset(array_count_values($linex)[$my_point])) ? array_count_values($linex)[$my_point] : 0;
	}
	if($result2 > $result) {
		$result = $result2;
	}
}
echo $result;
