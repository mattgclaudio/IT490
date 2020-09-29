<?php

# require_once('dbserver.php');

function chkcreds($username,$password)

{
    $ret = "error";
    $mysqli = new mysqli('localhost', 'testdb', 'data', 'vault');

    if ($mysqli->connect_errno) {
            $ret = "failed to connect to DB";

    }


    if ($retrow = $mysqli->query("SELECT * FROM vault.users WHERE username='$username' and password = '$password'")) {


            $retrow->close();
            $ret = "success, logged in!";
    }

    return $ret;

}

echo chkcreds('kenney', 'football').PHP_EOL;

                                    
