#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');



function getLog() {

	$jar = file_get_contents("/home/matt/logbook.txt");
	return $jar;

}


# rewritten to only overwrite rabbit log if the one sent to it is longer than the one it has. 
# we could probably also pull out the last line and compare those? we will have to make sure that all the logs
# are being appended ina  consistent fashion or gauging them by length will not work. 


function updateLog($errmsg) {
	# with this a+ opening mode we APPEND to this existing logbook
	$newentry = fopen("/home/matt/logbook.txt", "a+");
	fwrite($newentry, $errmsg);
	fwrite($newentry, "\n");
	fclose($newentry);

}


function checkLog($sentlog) {

        
        $ourlog = getLog();
        $ourlen = strlen($ourlog);
        $sentlen = strlen($sentlog);
	if ($ourlen < $sentlen) {
		# here we are overwriting the logbook with the new updated log 
		# from one of the VM's
                $scribe = fopen("/home/matt/logbook.txt", "w")  or die("Error opening logbook.txt");
                fwrite($scribe, $sentlog);
		fclose($scribe);

			}

}





#  what this will do is run rabbitlogserver run continually, and the individual
#  VM's will do a cron job which occasionally makes a rabbitclient to report errors/they
# will always be connected if we can't sort out how to end the connections correctly.


# just waits for the clients, then will overwrite if theirs has a new entry, do nothing if not. send rabbits master log as 
# the $response var in both cases. 
function requestProcessor($request)
{
  echo "Ready to receive VM logs".PHP_EOL;

  switch ($request['type']) {
  
  case "log_update":
	  	checkLog($request['log_update']);
 
  }
 

  $current_log = getLog();
  
  return array("returnCode" => '0', 'update'=>$current_log);
}


$server = new rabbitMQServer("logging_server.ini","loggingServer");

echo "Logging Server Begin".PHP_EOL;

$server->process_requests('requestProcessor');

echo "Logging Server END".PHP_EOL;

exit(0);

?>
