<?php
$raw_input = trim(file_get_contents('input.txt'));
$input = explode(PHP_EOL, $raw_input);
$input = explode("\n", $input[0]);

$result = 0;
$count = 0;
$array = array();
foreach($input as &$word) {
	$n = substr($word, 0, 18);
	$n = ltrim($n, '[15');
	$n = rtrim($n, ']');
	$n = '201' . $n;
	$n = strtotime($n);
	$d = substr($word, 19, strlen($word) - 19);
	$word = array($n, $d);
}

usort($input, function($a, $b) {
	return $a[0] <=> $b[0];
});


$current = '';
$current_time = '';

foreach($input as $pline) {
	preg_match('!\d+!', $pline[1], $current2);
	if(!empty($current2[0])) {
		$current = $current2;
		if(!isset($array[$current[0]])) {
			$array[$current[0]] = 0;
		}
	}
	if($pline[1] == 'wakes up') {
		$array[$current[0]] += (($pline[0]) - ($current_time)) / 60;
	}

	if($pline[1] == 'falls asleep') {
		$current_time = $pline[0];

	}
}
$my_guard = array_search(max($array), $array);

$current = 0;
$dates = array();
$current_time = 0;
foreach($input as $key => &$line_b) {
	preg_match('!\d+!', $line_b[1], $current2);

	if(!empty($current2[0])) {
		$current = $current2;
	}

	if($current[0] == $my_guard) {
		if($line_b[1] == 'wakes up') {
			$h1 = 1 * date('H', ($current_time));
			$h2 = 1 * date('H', ($line_b[0]));

			$m1 = date('i', ($current_time));
			$m2 = date('i', ($line_b[0]));
			for($i = $h1; $i <= $h2; $i++) {
				for($j = $m1; $j <= $m2; $j++) {

					if(isset($dates[$i][$j])) {
						$dates[$i][$j]++;
					} else {
						if($i != 23) {
							$dates[$i][$j] = 0;
						}
					}


				}
			}
		}
		if($line_b[1] == 'falls asleep') {
			$current_time = $line_b[0];
		}
	}
}
echo array_search(max($dates[0]), $dates[0]) * $my_guard;
