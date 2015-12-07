<?php session_start();
date_default_timezone_set("Asia/Hong_Kong");
include("../design/links.php");

$day = date("l");
$today = strtotime(date("H:i:s"));
$id = $_GET['id'];

	echo "<center>";

	include('../configure/config.php');
	$end = array();
	$start = array();
	$id = array();
	$day = array();

	//
	$query = mysql_query("SELECT * FROM class_student where userID='".$_GET['id']."' order by Days ASC,endClass ASC");
				echo "<form name='generate' method='post' action=''>";
				echo "<div class='panel-body col-lg-6'>";
				echo "<h3><b><i> Class Schedule </i></b></h3>";
				echo "<table class='table table-bordered table-hover table-striped'>";
				echo "<tr><th> Time Start </th><th> Time End </th><th> Day </th><th> Subject </th><th> Action </th></tr>";
		while($row = mysql_fetch_assoc($query))
		{

				echo "<tr><td>".$row['startClass']."</td><td>".$row['endClass']."</td><td>".$row['Days']."</td><td>".$row['Subject']."</td>";
				echo "<td><a href='generate_vacant.php?edit=".$row['classID']."'><span class='glyphicon glyphicon-edit'></span></a><a href='generate_vacant.php?edit=".$row['classID']."'><span class='glyphicon glyphicon-remove'></span></a></td>";
				echo "</tr>";
				$start[] = $row['startClass'];
				$end[] = $row['endClass'];
				$id[] = $row['userID'];
				$day[] = $row['Days'];
		}


			if(isset($_GET['edit']))
			{
				echo "<tr><td><input type='time' name='startClass' value='".$ed['startClass']."'></td><td><input type='time' name='endClass' value='".$ed['endClass']."'></td><td><input type='text' name='days' value='".$ed['Days']."'></td><td><input type='text' name='subject' value='".$ed['Subject']."'></td><td><input type='submit' name='update' value='Update Schedule'></td>";
			}

		echo "</table></div></form>";


		if(isset($_POST['update']))
		{
			$some = extract($_POST);
			mysql_query("UPDATE class_student set startClass='$startClass',endClass='$endClass',Days='$days',Subject='$subject' where classID='".$_GET['edit']."'");
			echo "<script> alert('Schedule Updated!'); window.location.href='generate_vacant.php?id=".$ed['userID']."'; </script>";

		}

		if(isset($_GET['edit']))
		{

		}
		else
		{
			echo '<form method="post" action="">
					<input type="submit" value="Generate" name="submit">
				  </form>';
			echo "<h3><b><i> Generated Vacant Schedule </i></b></h3>";
		}

		$begin = strtotime("7:30:00");
		$b = date("H:i:s", $begin);

		$stop = strtotime("17:00:00");
		$s = date("H:i:s", $stop);

		$a = strtotime("+15 minutes", $begin);
		$plus = date("H:i:s", $a);

		$l = strtotime("12:00:00");
		$lunch = date("H:i:s", $l);

		$le = strtotime("+1 hour",$l);
		$lunch_end = date("H:i:s", $le);

	$track_day = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
	$track_time = array();

	foreach($track_day as $day => $value)
	{
		//print $day;
		//QUERY HERE
		$starting = array();
		$times = array();
		$count = 0;

		$que = mysql_query("SELECT * FROM `class_student` where `Days` = '".$value."'");
		while($row = mysql_fetch_array($que))
		{
			//print '['.$row['startClass'].']';
			$starting[] = $row['startClass'];
		}

		///TIME LOOP HERE
		$t = strtotime("7:00:00");
		for ($i=0; $i < 20;$i++) {
			$t = strtotime("+30 minutes",$t);
			$track_time[$i] = $t;
			$time = date("H:i:s", $t);

			print date("H:i", $t)."<br>";

			foreach ($starting as $s) {
				if($s == $time)
				{
					$count++;
					print '['.$count.']';
				}
				else
				{
					//print date("H:i", $t)."<br>";
					//print $time."<br>";
				}

			}
	 	}

		$res = ($count != 0) ? $a : $b ;
		print $res;
	 	echo "--------------- ".$value."<br>";
	}

	/*$user_id = $_GET['id'];
	for($x=0;$x<count($track_day);$x++){
		$days=$track_day[$x];
		$count = 0;
		$result = mysql_query("SELECT * FROM `class_student` WHERE `userID`='$user_id' AND `Days`='$days'");
		while($row=mysql_fetch_array($result)){
			if($count == 0){
				$count++;
				echo "first time:".$row['endClass']."</br>";
			}
			//echo $row['Days']."</br>";
			//echo $row['startClass']."-".$row['endClass']."</br>";
			//$last_time = $row['startClass'];
		}

		//echo "Last Time".$last_time."</br>";
	} */


?>
