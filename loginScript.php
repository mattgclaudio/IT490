#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function doLogin($username, $password)
{
    # this function needs to pass the parameters to the RabbitClient code which connects to the                     	# RabbitServer code running on the DB. This file needs to live in a separate directory, as it needs its own testRabbitMQ.ini file which points at the RabbitServer on the DB rather than the one on the RabbitMQ VM. The $response returned by this method is then passed back to Apache2 and printed to the screen as "logged in" or not logged in. 
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$request = array();
$request['type'] = "Login";
$request['username'] = $username;
$request['password'] = $password;
$response = $client->send_request($request);
return $response;
                   
}



?>
