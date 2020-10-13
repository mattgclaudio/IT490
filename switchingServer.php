#!/usr/bin/php
<?php
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function callDB($unthree, $pwthree) {

$client = new rabbitMQClient("db_server.ini","dbServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();

$request['type'] = "login";
$request['username'] = $unthree;
$request['password'] = $pwthree;
$request['message'] = $msg;

$response = $client->send_request($request);

return $response;
}





function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  $pass = "";
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
	    $pass = callDB($request['username'],$request['password']);	    

  }
  return array("returnCode" => '0', 'message'=>$pass['response'], 'pubkey' => $pass['pubkey'], 'privkey' => $pass['privkey']);
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "Switching Server BEGIN".PHP_EOL;

$server->process_requests('requestProcessor');

echo "Server With apache2 END".PHP_EOL;

exit();

?>
