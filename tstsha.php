<?php 

$tl = fopen("/home/matt/logbook.txt", "w");
$test = "error 404 not found";
fwrite($tl, $test);
fclose($tl);
$ourlog = file_get_contents("/home/matt/logbook.txt");

$oursha = sha1($ourlog);
# $rabsha = sha1($rblog);
echo $ourlog.PHP_EOL;
echo $oursha.PHP_EOL;
echo "\n\n";
