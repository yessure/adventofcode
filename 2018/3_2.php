 <?php
$raw_input = trim(file_get_contents('input'));
$input = explode(PHP_EOL, $raw_input);
 
$result = 0;
$array = array();
$id_array = array();
 
$input[0] = explode("\n", $input[0]);
foreach($input as &$pline) {
    foreach($pline as &$element) {
        $element = explode(' ', $element);
    }
}
 
foreach($input as $input_line) {
    foreach($input_line as $input_element) {
        $id_array[] = $input_element[0];
    }
}
 
foreach($input as $a) {
    foreach($a as $b) {
        $coordinates = explode(',', $b[2]);
        $coordinates[1] = rtrim($coordinates[1], ':');
        $area = explode('x', $b[3]);
        for($j = 1; $j <= $area[1];$j++) {
            for($i = 1; $i <= $area[0]; $i++) {
                if(isset($array[$coordinates[0] + $i][$coordinates[1] + $j])) {
                    unset($id_array[array_search($array[$coordinates[0] + $i][$coordinates[1] + $j], $id_array)]);
                    unset($id_array[array_search($b[0], $id_array)]);
                    $array[$coordinates[0] + $i][$coordinates[1] + $j] = 'X';
                } else {
                    $array[$coordinates[0] + $i][$coordinates[1] + $j] = $b[0];
                }
            }
        }
    }
}
foreach($id_array as $id){
	echo ltrim($id, '#');
}
