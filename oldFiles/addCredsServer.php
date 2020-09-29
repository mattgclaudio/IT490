#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
# require_once('login.php.inc');

function doLogin($username,$password)
    # $login = new loginDB();
    # return $login->validateLogin($username,$password);
    //return false if not valid
{
    $login = new mysqli("localhost", " ", " ");
    $name = $_post['search'];
    # Comment: does post need to be capitalized here? added ending quote mark. 
    
    $select = mysqli_select_db("login_db", $connect);
    
    $userName = $_POST['username'];
    $password = $_POST['password']'
                   
    $sql = "SELECT * FROM users WHERE username='$userName' and password = '$password'";
                   $result = mysqli_query($sql);
                   $count = mysqli_num_rows($result);
                   
                   echo $sql;
                   
    if ($count==1){
            echo 'You have successfully logged in.';
               return true;
    } else {
        echo 'Failed to login.';
    }
                   
    if (mysqli_connect_errno())
                   {
                       echo"Failed to connect to MySql: " . mysqli_connect_error();
                       return false;
                   }
                   

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
  return array("returnCode" => '0', 'username' => $request['username'],       'password' => $request['password']);
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

echo "Server With apache2 BEGIN".PHP_EOL;

$server->process_requests('requestProcessor');

echo "Server With apache2 END".PHP_EOL;

exit();
?>
