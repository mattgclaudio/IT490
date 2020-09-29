#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function callDB() {

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
$request['username'] = "kenney";
$request['password'] = "football";
$request['message'] = $msg;
$response = $client->send_request($request);

return $response;
}
