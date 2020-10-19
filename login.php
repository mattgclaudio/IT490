<?php
session_start();
#This line has to be run before anything else for the session vars to work

# this line will have to be changed based on where the RabbitCLIENT file is in # relation to the login.php
require('/home/matt00/Downloads/git/WebRabbitConn/ServerClient.php');



# Var for what post returned
$request=$_POST;


if(isset($_POST['cashButton'])) {

	$retcash = doDelOne("cash");


}


# call function in the RabbitCLIENT file which passes the data to Rabbit to be # passed to the DB etc.
#
$lucky = doItAll($un, $pw);
$arg1 = $lucky['pubkey'];
$arg2 = $lucky['privkey'];

$_SESSION['pubkey'] = $arg1;
$_SESSION['privkey'] = $arg2;


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

<form method="post" action="">
	<label> Cash Button </label>
	<input type="submit" name="cashButton" />

</form>

</table>

<p> Please peruse our vast array of financial information at your leisure.</p>



</body>


</html>

