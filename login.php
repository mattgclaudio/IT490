<?php
session_start();
#This line has to be run before anything else for the session vars to work

# this line will have to be changed based on where the RabbitCLIENT file is in # relation to the login.php
require('/home/matt00/Downloads/git/clnRab/rabbitmqphp_example/ServerClient.php');

# require('/home/matt00/Downloads/git/LogModule/IT490/loggingClient.php');


# this is still stock
if (!isset($_POST))
{
	$msg= "NO POST MESSAGE SET, PLEASE TRY AGAIN";
 }


# Var for what post returned
$request=$_POST;

$un=$request["uname"];
# pull out the username and password passed from the login page through POST

$pw=$request["pword"];
# Same

# call function in the RabbitCLIENT file which passes the data to Rabbit to be # passed to the DB etc.
#
$lucky = doItAll($un, $pw);
$arg1 = $lucky['pubkey'];
$arg2 = $lucky['privkey'];

?>





<html>

<head>

<title> YahooFin Portal </title>

<link rel="stylesheet" href="stylesheet0.css">

</head>


<body>

<h1>You are now logged in! </h1>

<table>

<!--Need to make this top text box larger for the error message, probably best to do it in CSS -->

<tr><td><input type="text" value="<?php echo $arg1;  ?>"></td></tr> 
<tr><td><input type="text" value="<?php echo $arg2; ?>"></td></tr>

<button>Get Cash Balance </button>

</table>

<p> Please peruse our vast array of financial information at your leisure.</p>



</body>


</html>

