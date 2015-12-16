<?php 
	include "../configure/config.php";
	date_default_timezone_set("Asia/Hong_Kong");


	if(isset($_GET['AbsentF']))
	{
		$id = $_GET['AbsentF'];
		$subj = $_GET['subject'];
		$start = $_GET['start'];

		$query = mysql_query("SELECT * FROM class_faculty where userID='$id' and Subject='$subj' and startClass='$start' and Days='".date('l')."'");
		$fetch = mysql_fetch_array($query);

			//echo $fetch['startClass'];

			$end_class = strtotime($fetch['endClass']);
           	$end = date('H:i', $end_class);

           	$start_class = strtotime($fetch['startClass']);
           	$start = date('H:i', $start_class);

			$tardy = $end_class - $start_class;

			$cheking = mysql_query("SELECT * FROM attendance_faculty where userID='$id' and subject='$subj' and date='".date('Y-m-d')."'");
			if(mysql_num_rows($cheking) > 0)
			{
				echo "<script> alert('Checked already.'); window.location.href='../logs/logs.php'; </script>";
			}
			else
			{
				$absent = "INSERT INTO attendance_faculty(userID,subject,date,timeIn, timeout, Attendance,tardinessCount) 
	           	VALUES ('".$fetch['userID']."','".$fetch['Subject']."',NOW(), '00:00:00', '00:00:00', 'Absent','".gmdate("H:i", $tardy)."')";
	           	$result = mysql_query($absent) or die ("Error in query:" .mysql_error());
	              
	           	echo "<script> window.location.href='../logs/logs.php'; </script>";
	        }
	}
	else if(isset($_GET['ExcuseF']))
	{
		
		$i = extract($_POST);

		$query = mysql_query("SELECT * FROM class_faculty as c, subject_master as s where c.subject_id=s.subject_id and c.classID='$exID'");
		$fetch = mysql_fetch_array($query);

		if(mysql_num_rows($query) > 0)
		{
			if(isset($_POST['submit']))
			{
				$cheking = mysql_query("SELECT * FROM attendance_faculty where userID='".$fetch['userID']."' and subject='".$fetch['subject_code']."' and date='".date('Y-m-d')."'");
				if(mysql_num_rows($cheking) > 0)
				{
					echo "<script> alert('Checked alreadyfazd.'); window.location.href='../logs/logs.php'; </script>";
				}
				else
				{
					$a = extract($_POST);
					$absent = "INSERT INTO attendance_faculty(userID,subject,date,timeIn, timeout, Attendance,Cause) 
		           	VALUES ('".$fetch['userID']."','".$fetch['subject_code']."',NOW(), '00:00:00', '00:00:00', 'Excuse','$cause')";
		           	$result = mysql_query($absent) or die ("Error in query:" .mysql_error());
		              
		           	echo "<script> window.location.href='../logs/logs.php'; </script>";
		        }
			}
		}
		else
		{
			if(isset($_POST['submit']))
			{
				/*if(isset($_POST['sub']))
				  {
				    extract($_POST);

				    print "<script> alert('Yow this is PHP Excuse'); </script>";
				    print $exID;
				    echo '
				      <script>
				      	window.location.href="../logs/logs.php?load='.$area.'";
				      </script>
				    ';
				  }*/

				$area = mysql_query("SELECT area from area_assign where studentID='$exID'");
				$area_get = mysql_fetch_assoc($area);

				$cheking = mysql_query("SELECT * FROM attendance_student where userID='$exID' and date='".date('Y-m-d')."'");
				if(mysql_num_rows($cheking) > 0)
				{
					echo "<script> alert('Checked already.'); window.location.href='../logs/logs.php'; </script>";
				}
				else
				{
					$a = extract($_POST);
					mysql_query("INSERT INTO attendance_student(userID,area,date,timeIn, timeout, Attendance,Cause) VALUES ('$exID','".$area."',NOW(), '00:00:00', '00:00:00', 'Excuse','$cause')");

					echo '
						<script>
					      	window.location.href="../logs/logs.php?load='.$area.'";
					    </script> ';
		        }
			}
		} 

		

 
	}
	else if(isset($_GET['AbsentS']))
	{
		$id = $_GET['AbsentS'];
		$time = $_GET['time'];

		$query = mysql_query("SELECT * FROM stud_vacant where studID='$id' and time_start='$time' and Days='".date('l')."'");
		$fetch = mysql_fetch_array($query);

		$area = mysql_query("SELECT area from area_assign where studentID='$id'");
		$area_get = mysql_fetch_assoc($area);

			echo $fetch['startClass'];

			$end_class = strtotime($fetch['time_end']);
           	$end = date('H:i', $end_class);

           	$start_class = strtotime($fetch['time_start']);
           	$start = date('H:i', $start_class);

			$tardy = $end_class - $start_class;

			$cheking = mysql_query("SELECT * FROM attendance_student where userID='$id' and date='".date('Y-m-d')."'");
			if(mysql_num_rows($cheking) > 0)
			{
				echo date('Y-m-d');
				//echo "<script> alert('Checked already..'); window.location.href='../logs/logs.php'; </script>";
			}
			else
			{
				mysql_query("INSERT INTO attendance_student(userID,area,date,Attendance) VALUES ('$id','".$area_get['area']."',NOW(),'Absent')");
	           	
	           	echo '
					<script>
				      	window.location.href="../logs/logs.php?load='.$area_get['area'].'";
				    </script> ';
	        } 
	}
	
?>