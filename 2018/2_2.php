<?php
$raw_input = trim(file_get_contents('input.txt'));
$input = explode(PHP_EOL, $raw_input);
$input = preg_replace('!\s+!', ' ', $input);

foreach($input as &$space_element) {
	$space_element = explode(" ", $space_element);
}

foreach($input as &$line) {
	foreach($line as &$word) {
		$word = str_split($word);
	}
}


foreach($input as &$pline) {
	foreach($pline as &$element) {
			foreach($input as $kline){
				foreach($kline as $element2){
					if(count($x = array_diff_assoc($element,$element2)) == 1 ){
						foreach($element2 as $key=>$char){
							if(!isset($x[$key])){
								echo $char;
							}
						}
						die();
					}
				}
			}
	}
}
