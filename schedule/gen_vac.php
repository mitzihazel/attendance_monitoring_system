<?php session_start();
date_default_timezone_set("Asia/Hong_Kong");
include('../configure/config.php');


//$track_days = array('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$track_time = array();
	$t = strtotime("7:00:00");
	for ($i=0; $i < 20;$i++) { 
		$t = strtotime("+30 minutes",$t);
		$track_time[$i] = $t;
		
			$query = mysql_query("SELECT * FROM class_student where Days='Saturday'");
				while($row = mysql_fetch_array($query)){
					//echo $row['startClass'] . " - " . $row['endClass'] . " - " . $row['Days'] . "<br>";
					if($row['startClass'] != date("H:i", $t))
					{					
						echo date("H:i", $t)."<br/>";
					}
					
				}
}


?>