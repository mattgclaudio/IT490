<?php
session_start();


if (!isset($_POST))
{
	$msg= "NO POST MESSAGE SET, POLITELY FUCK OFF";
	$_SESSION["msg"]=$msg;
        # echo json_encode($msg);
        # exit(0);
}
$request=$_POST;

$pullone=$request["uname"];
$_SESSION["ret"]=$pullone;

$pulltwo=$request["pword"];
$_SESSION["ret0"]=$pulltwo;
# echo json_encode($response);


?>



<html>

<head>

<title> YahooFin Portal </title>

<link rel="stylesheet" href="stylesheet0.css">

</head>


<body>

<h1>You are now logged in! </h1>

<table>

<tr><td><input type="text" value="<?php echo $_SESSION["ret"];  ?>"></td></tr> 
<tr><td><input type="text" value="<?php echo $_SESSION["ret0"]; ?>"></td></tr>

</table>

<p> Please peruse our vast array of financial information at your leisure.</p>



</body>


</html>

