<?php
require_once __DIR__ . '/lib/ltsv.php';

$test_string = "time:28/Feb/2013:12:00:00 +0900\thost:192.168.0.1\treq:GET /list HTTP/1.1\tstatus:200";

$test_array = array(
	"label1_1:value1_1\tlabel1_2:value1_2",
	"label2_1:value2_1\tlabel2_2:value2_2"
);

$test_value =  array(
	'time'   => '28/Feb/2013:12:00:00 +0900',
	'host'   => '192.168.0.1',
	'req'    => 'GET /list HTTP/1.1',
	'status' => '200',
);

$result_string = Ltsv::decode($test_string, array('encoding' => 'utf-8'));
$result_array  = Ltsv::decode($test_array, array('encoding' => 'utf-8'));
$result_value  = Ltsv::encode($test_value, array('encoding' => 'utf-8'));

echo 'Decode Test:' . '<br />';
echo 'String Test:' . '<br />';
echo '<pre>';
var_dump($result_string);
echo '</pre>';
echo '<br />';
echo 'Array Test:' . '<br />';
echo '<pre>';
var_dump($result_array);
echo '</pre>';

echo 'Encode Test:' . '<br />';
echo '<pre>';
var_dump($result_value);
echo '</pre>';
?>
