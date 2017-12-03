<?php
$host = 'localhost';
$user = 'root';
$password = 'password';
$database = 'datasensor';
 
mysql_connect($host, $user, $password) or die("Could not connect to database");
mysql_select_db($database) or die("Could not connect to database");
mysql_query("SET NAMES UTF8");
?>