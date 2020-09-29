
#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
# require_once('login.php.inc');

function checkCreds($un,$pw)
{

    $sql = "SELECT * FROM users WHERE username='$un' and password = '$pw'";
    # INTERNAL FUNCTION
    $count = "Insert some kind of internal query here";

    if ($count==1) {

        return true;
    }

    else  {

        return false;
    }

}

function requestProcessor($request)
{
    $retBool = false;

    echo "received request".PHP_EOL;
    var_dump($request);
    if(!isset($request['type']))
    {
        return "ERROR: unsupported message type";
    }
    switch ($request['type'])
    {
        case "login":
            $retBool = checkCreds($request['username'], $request['password']);

    }
    return array("returnCode" => '0', 'query_result'=> $retBool );
}

# the .ini does not have to be in a different directory, i'm not even sure what i was thinking there.  It just has to
# be NAMED something different.

$server = new rabbitMQServer("INSERT .INI FILE HERE","testServer");

# Probably have to name it something other than testServer also....
################################################################

echo "DB Listening Server BEGIN".PHP_EOL;

$server->process_requests('requestProcessor');

echo "DB Listening Server END".PHP_EOL;

exit();
