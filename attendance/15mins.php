<?php
	$selectedTime = "9:15:00";
$endTime = strtotime("+15 minutes", strtotime($selectedTime));
echo date('h:i:s', $endTime);

echo(strtotime("now") . "<br>");
echo(strtotime("3 October 2005") . "<br>");
echo(strtotime("+5 hours") . "<br>");
echo(strtotime("+1 week") . "<br>");
echo(strtotime("+1 week 3 days 7 hours 5 seconds") . "<br>");
echo(strtotime("next Monday") . "<br>");
echo(strtotime("last Sunday"));

?>




