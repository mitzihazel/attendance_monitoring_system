<?php date_default_timezone_set("Asia/Hong_Kong");

$todays = date("H:i:s a");
$today = strtotime($todays);
$today_hour = date("h", $today);
$today_minute = date("i", $today);
$today_plus = strtotime("+1 hour", $today);
$today_hp = date("H", $today_plus);

echo $todays;
echo $today;
?>