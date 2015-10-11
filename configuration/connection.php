<?php
$server="localhost";
$user="root";
$password="";
$database="airline_system";
$conn=mysql_connect($server, $user, $password) or die("error in connection to database");
mysql_select_db($database) or die ("error to select database");

?>