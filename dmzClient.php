#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


function callDMZ($pkey, $prkey, $action) {

	$client = new rabbitMQClient("dmzServer.ini","dmzServer");

	$request = array();
	$request['action'] =  $action;
	$request['pubkey'] = $pkey;
	$request['privkey'] = $prkey;

	$response = $client->send_request($request);

	return $response;

}


