<?php 

include('configure/config.php');

$now = "2015-09-01"; 
$latr = date("Y-m-d");

$ctr = 0;
  $get = mysql_query("SELECT distinct date FROM attendance_faculty where date Between '$now' and '$latr'");
  while($data=mysql_fetch_assoc($get))
  {

    $ctr += count($data['date']);
  }
  echo $ctr;
?>