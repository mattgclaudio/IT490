#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

# it seems like there is no harm in leaving the server running for days at a time, 
# and i cannot at this point see any benefit in trying to rewrite the work 
#  that at the professor has done creating the rabbitMQClient/Server objects in
# Lib.inc, so i think it's better we not have to mess around with that base code too much. 
# That being said, it would be highly beneficial to find a way to close client 
# connections in a way which is reflected in the management login for RabbitMQ,
# or else we will have to leave those lines running forever..which seems wasteful.


function updateLog($errmsg) {
	# with this a+ opening mode we APPEND to this existing logbook
	$newentry = fopen("/home/matt/logbook.txt", "a+");
	fwrite($newentry, $errmsg);
	fclose($newentry);

}

function getLog() {

	$jar = file_get_contents("/home/matt/logbook.txt");
	return $jar;

}

function changeLog($rablog) {
	# here we are OVERWRITING the existing log with the new one from the server. 
	$newentry = fopen("/home/matt/logbook.txt", "w");
	fwrite($newentry, $rablog);
	fclose($newentry);

}


$client = new rabbitMQClient("logging_server.ini","loggingServer");


$request = array();
$request['type'] = "log_update";
$request['log_update'] = getLog();
$response = $client->send_request($request);


echo "client received response: ".PHP_EOL;
changeLog($response['update']);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;
exit(0);
