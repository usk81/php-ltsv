php-ltsv
========

LTSV parser for PHP

:LTSV:

	Labeled Tab-separated Values
	http://ltsv.org/

Installation
------------


Usage
-----

### encode LTSV (array to LTSV format)

	$result_value = Ltsv::encode($test_value, array('encoding' => 'utf-8'));

test parameter:

	$test_value =  array(
		'time'   => '28/Feb/2013:12:00:00 +0900',
		'host'   => '192.168.0.1',
		'req'    => 'GET /list HTTP/1.1',
		'status' => '200',
	);

result(example):

 	"time:28/Feb/2013:12:00:00 +0900\thost:192.168.0.1\treq:GET /list HTTP/1.1\tstatus:200"

### decode LTSV (LTSV format to string, array)

string:

	$result_string = Ltsv::decode($test_string, array('encoding' => 'utf-8')); 

test parameter:

	'time:28/Feb/2013:12:00:00 +0900\thost:192.168.0.1\treq:GET /list HTTP/1.1\tstatus:200'


result(example):

	array(4) {
	["time"]=>
 		string(26) "28/Feb/2013:12:00:00 +0900"
  	["host"]=>
		string(11) "192.168.0.1"
	["req"]=>
		string(18) "GET /list HTTP/1.1"
	["status"]=>
		string(3) "200"
	}


array:

	$result_array  = Ltsv::decode($test_array, 	array('encoding' => 'utf-8'));

test parameter:

	array(
		'label1_1:value1_1\tlabel1_2:value1_2',
		'label2_1:value2_1\tlabel2_2:value2_2'
	);


result(example):

	array(2) {
		[0]=>
			array(2) {
				["label1_1"]=>
		    		string(8) "value1_1"
	    		["label1_2"]=>
	    			string(8) "value1_2"
  			}
		[1]=>
			array(2) {
				["label2_1"]=>
					string(8) "value2_1"
				["label2_2"]=>
					string(8) "value2_2"
			}
	}
