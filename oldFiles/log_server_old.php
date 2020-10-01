#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');




function getVMlogs($file, $servername) {

#  This method as written will take the ini file of the VM we want to connect to as well as the servername in the ini file to call the VM and get their log records. Not sure if we will need to hardcode all of this, passing the ini file might confuse php depending on how it's packaged, will explore. 
	
		$client = new rabbitMQClient($file, $servername);
		$request = array();
		$request['type'] = "log_update";
		$response = $client->send_request($request);

		return $response;
}

# no, what we need to do is write this rabbitlogserver to run continually, and the individual VM's will do a cron job which occasionally makes a rabbitclient to report errors. 

function requestProcessor($request)
{
  echo "Ready to receive VM logs".PHP_EOL;

  switch ($request['type']) {
  
  	case "log_update":
		$new_entry = $request["log_update"];
  
  
  }


  $log_update = array();
  $log_update['db'] = $db_update;
  $log_update['apache'] = $apache_update;
  # THIS function does not exist, have to write it to get rabbit's internal logs.
  $log_update['rabbit'] = getRabbitLogs(); 
  #we could probably condense this with the line 4 lines above, but i want to test it the long way first
  
  


  return array("returnCode" => '0', 'update'=>$log_update);
}


$server = new rabbitMQServer("logging_server.ini","loggingServer");

echo "Logging Server Begin".PHP_EOL;

$server->process_requests('requestProcessor');

echo "Logging Server END".PHP_EOL;

exit();

?>
