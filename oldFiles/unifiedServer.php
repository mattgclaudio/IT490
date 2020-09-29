#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('[INSERT_PATH_TO_FILE_HERE/loginScript.php]');


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      $retDB = doLogin($request['username'],$request['password']);
  }
  return array("returnCode" => '0', 'response' => $retDB);
}
$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
echo "Server With apache2 BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');

echo "Server With apache2 END".PHP_EOL;

exit();
?>
