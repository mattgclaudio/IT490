#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

# checks if logs are equivalent, if not it rewrites the log file with the new one. 
# it works, i hope, because if a server reports an error it apends it to the existing 
# shared log file. that is sent to the log server which updates its # log file to match,
# and when it responds to the original server theirs will not match.
# When the other machines check in, loggingServer pushes the new log  
# file to them, they dont match, and the clients overwrite their file with the new contents. 

function checkLog($sentlog) {

        
        $ourlog = file_get_contents("home/matt/logbook.txt");
        $oursha = sha1($ourlog);
        $sentsha = sha1($sentlog);
	if ($oursha != $sentsha):
		# here we are overwriting the logbook with the new updated log 
		# from one of the VM's
                $scribe = fopen("/home/matt/logbook.txt", "w")  or die("Error opening logbook.txt");
                fwrite($scribe, $sentlog);
		fclose($scribe);
		return true;


}


function getLog() {

	$jar = file_get_contents("/home/matt/logbook.txt");
	return $jar;

}



#  what this will do is run rabbitlogserver run continually, and the individual
#  VM's will do a cron job which occasionally makes a rabbitclient to report errors/they
# will always be connected if we can't sort out how to end the connections correctly.


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
