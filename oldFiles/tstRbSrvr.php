#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
# require_once('login.php.inc');

function doLogin($username,$password)
{
    return true;	
    # $login = new loginDB();
    # return $login->validateLogin($username,$password);
    //return false if not valid
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
    case "login":
      return doLogin($request['username'],$request['password']);	    

    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"WE GOT ONE!");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "Server With apache2 BEGIN".PHP_EOL;

$server->process_requests('requestProcessor');

echo "Server With apache2 END".PHP_EOL;

exit();

?>
