#!/usr/bin/php
<?php
session_start();
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function callDB($unthree, $pwthree) {

$client = new rabbitMQClient("db_server.ini","dbServer");


$request = array();

$request['type'] = "login";
$request['username'] = $unthree;
$request['password'] = $pwthree;


$response = $client->send_request($request);

$_SESSION['pubkey'] = $response['pubkey'];
$_SESSION['privkey'] = $response['privkey'];

return $response;
}


function callDMZ($pkey, $prkey, $action) {

        $client = new rabbitMQClient("dmzServer.ini","dmzServer");

        $request = array();
        $request['action'] =  $action;
        $request['pubkey'] = $pkey;
        $request['privkey'] = $prkey;

        $response = $client->send_request($request);

        return $response;

}


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
  	case "dmz1":
		$retmsg = callDMZ($_SESSION['pubkey'], $_SESSION['privkey'], $request['action']);

  	case "login":
		$retmsg = callDB($request['username'],$request['password']);
  		$retmsg = $retmsg['response'];		

  }
  return array("returnCode" => '0', 'message'=>$retmsg);
}

$server = new rabbitMQServer("webconn.ini","testServer");

echo "Switching Server BEGIN".PHP_EOL;

$server->process_requests('requestProcessor');

echo "Switching server  END".PHP_EOL;

exit();

?>
