<?php
$host = "localhost";    
$user = "root";    
$pass = "password";    
$db = "datasensor";    
mysql_connect($host, $user, $pass) or die("Could not connect to database"); 
mysql_select_db($db) or die("Could not connect to database"); 
mysql_query("SET NAMES utf8")
?>