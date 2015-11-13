<?php
$dbhost = 'localhost';
$dbuser= 'root';
$dbpass = '';
$dbname = 'ourdb';

$con = mysql_connect($dbhost,$dbuser,$dbpass);

mysql_select_db($dbname);
?>