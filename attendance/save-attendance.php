<?php date_default_timezone_set("Asia/Hong_Kong");

include("../configure/config.php");
include("../ip_check.php");

function decimalHours($time)
{
    $hms = explode(":", $time);
    return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
}


//getting current date and time
$day = date("l");
$today = strtotime(date("H:i:s"));
$time = date('H:i:s');

if(isset($_POST['submit']))
{
	$check_ip = mysql_query("SELECT * FROM setting_room as s, class_faculty as c where s.roomName=c.locationDescr and s.ip_add='$ip'");

	if(mysql_num_rows($check_ip) > 0)
	{
		$query = mysql_query("SELECT * FROM user_faculty as u, class_faculty as c, subject_master as s where u.userID=c.userID and c.subject_id=s.subject_id and u.rfidNo = '".$_POST['rfidNo']."'");

		if(mysql_num_rows($query) > 0)
		{
			while ($fetch = mysql_fetch_array($query)) 
			{
				if($fetch['Days'] == $day)
				{
					echo "day";
					if($fetch['startClass'] <= $time && $fetch['endClass'] >= $time)
					{
						echo "time";
						$start = decimalHours($fetch['startClass']);
						$end = decimalHours($fetch['endClass']);

						$time_range = $end - $start;

						if($time_range == 1)
						{
							$la = strtotime("+15 minutes", strtotime($fetch['startClass']));
							$late = date("H:i:s",$la);
						}
						else if($time_range == 1.5)
						{
							$la = strtotime("+20 minutes", strtotime($fetch['startClass']));
							$late = date("H:i:s",$la);
						}
						else if($time_range == 2)
						{
							$la = strtotime("+25 minutes", strtotime($fetch['startClass']));
							$late = date("H:i:s",$la);
						}
						else if($time_range == 3)
						{
							$la = strtotime("+30 minutes", strtotime($fetch['startClass']));
							$late = date("H:i:s",$la);
						}

							$attendance_check = mysql_query("SELECT * FROM attendance_faculty where userID='".$fetch['userID']."' and subject='".$fetch['subject_code']."' and date='".date("Y-m-d")."' order by attendId DESC");
							$check = mysql_fetch_assoc($attendance_check);


								if(mysql_num_rows($attendance_check) > 0)
								{
									echo "b";
									if($check['timeOut'] == 0)
									{
										$total = strtotime($time) - strtotime($check['timeIn']);
										$early = strtotime("-15 minutes", strtotime($fetch['endClass']));

										echo $fetch['endClass']." ".date("H:i:s", $early);

										$earlys = $early - strtotime($time);
										echo date("H:i:s",strtotime($time))."<br>".gmdate("H:i:s",$earlys)."<br>";
										if(strtotime($time) >= $early) 
										{
											$earlys = $early - strtotime($time);
											echo gmdate("H:i:s", $earlys);
										}

										$update = mysql_query("Update attendance_faculty set timeOut=NOW(),totalHour='".gmdate("H:i:s", $total)."',earlyOut='".gmdate("H:i:s", $earlys)."' where timeIn='".$check['timeIn']."' and subject='".$check['subject']."'");
										echo "<script> window.location.href='attendance-form.php' </script>";
									} else 
									{
										if($time > $late)	
										{
											//echo $time." - ".$late;
											$late_check = 'Late';
											$tardy = strtotime($late) - strtotime($time);
										}
										else 
										{
											$late_check = 'Present';
										}

											if($check['timeIn'] != 0)
											{
												echo "we";
												$add = mysql_query("INSERT INTO attendance_faculty(userID,subject,date,timeIn) VALUES('".$fetch['userID']."','".$fetch['subject_code']."',NOW(),NOW())");
												echo "<script> window.location.href='attendance-form.php'; </script>";
											}
											else
											{
												$add = mysql_query("INSERT INTO attendance_faculty(userID,subject,date,timeIn,tardinessCount,Attendance) VALUES('".$fetch['userID']."','".$fetch['subject_code']."',NOW(),NOW(),'".gmdate('H:i:s',$tardy)."','$late_check')");
												echo "<script> window.location.href='attendance-form.php'; </script>";
											}
									}
								}
								else
								{
									 echo "a";
										if($time > $late)
										{
											$late_check = 'Late';
											$tardy = strtotime($time) - strtotime($late);

											$add = mysql_query("INSERT INTO attendance_faculty(userID,subject,date,timeIn,tardinessCount,Attendance) VALUES('".$fetch['userID']."','".$fetch['subject_code']."',NOW(),NOW(),'".gmdate('H:i:s',$tardy)."','$late_check')");

										}
										else 
										{
											$late_check = 'Present';

											$add = mysql_query("INSERT INTO attendance_faculty(userID,subject,date,timeIn,Attendance) VALUES('".$fetch['userID']."','".$fetch['subject_code']."',NOW(),NOW(),'$late_check')");

										}

										echo "<script> window.location.href='attendance-form.php'; </script>";

								}
					}
				}
			}
		}
		else
		{
			$query = mysql_query("SELECT * FROM user_student as u, stud_vacant as c where u.userID=c.studID and u.rfidNo = '".$_POST['rfidNo']."'");

			if(mysql_num_rows($query) > 0)
			{
				while ($fetch = mysql_fetch_array($query)) 
				{
					if($fetch['Day'] == $day)
					{
						echo "day";
						if($fetch['time_start'] <= $time && $fetch['time_end'] >= $time)
						{
							echo "time";
							$start = decimalHours($fetch['time_start']);
							$end = decimalHours($fetch['time_end']);

							$time_range = $end - $start;

							if($time_range == 1)
							{
								$la = strtotime("+15 minutes", strtotime($fetch['time_start']));
								$late = date("H:i:s",$la);
							}
							else if($time_range == 1.5)
							{
								$la = strtotime("+20 minutes", strtotime($fetch['time_start']));
								$late = date("H:i:s",$la);
							}
							else if($time_range == 2)
							{
								$la = strtotime("+25 minutes", strtotime($fetch['time_start']));
								$late = date("H:i:s",$la);
							}
							else if($time_range == 3)
							{
								$la = strtotime("+30 minutes", strtotime($fetch['time_start']));
								$late = date("H:i:s",$la);
							}

								$attendance_check = mysql_query("SELECT * FROM attendance_student where userID='".$fetch['userID']."' and subject='".$fetch['Subject']."' and date='".date("Y-m-d")."' order by attendId DESC");
								$check = mysql_fetch_assoc($attendance_check);


									if(mysql_num_rows($attendance_check) > 0)
									{
										echo "b";
										if($check['timeOut'] == 0)
										{
											$total = strtotime($time) - strtotime($check['timeIn']);

											$update = mysql_query("Update attendance_student set timeOut=NOW(),totalHour='".gmdate("H:i:s", $total)."' where timeIn='".$check['timeIn']."' and subject='".$check['subject']."'");
											 echo "<script> window.location.href='attendance-form.php'; </script>";
										} else 
										{
											if($time > $late)	
											{
												//echo $time." - ".$late;
												$late_check = 'Late';
												$tardy = strtotime($late) - strtotime($time);
											}
											else 
											{
												$late_check = 'Present';
											}

												if($check['timeIn'] != 0)
												{
													echo "we";
													$add = mysql_query("INSERT INTO attendance_student(userID,subject,date,timeIn) VALUES('".$fetch['userID']."','".$fetch['Subject']."',NOW(),NOW())");
													echo "<script> window.location.href='attendance-form.php'; </script>";
												}
												else
												{
													$add = mysql_query("INSERT INTO attendance_student(userID,subject,date,timeIn,tardinessCount,Attendance) VALUES('".$fetch['userID']."','".$fetch['Subject']."',NOW(),NOW(),'".gmdate('H:i:s',$tardy)."','$late_check')");
													echo "<script> window.location.href='attendance-form.php'; </script>";
												}
										}
									}
									else
									{
										 echo "a";
											if($time > $late)
											{
												$late_check = 'Late';
												$tardy = strtotime($time) - strtotime($late);

												$add = mysql_query("INSERT INTO attendance_student(userID,subject,date,timeIn,tardinessCount,Attendance) VALUES('".$fetch['userID']."','".$fetch['Subject']."',NOW(),NOW(),'".gmdate('H:i:s',$tardy)."','$late_check')");

											}
											else 
											{
												$late_check = 'Present';

												$add = mysql_query("INSERT INTO attendance_student(userID,subject,date,timeIn,Attendance) VALUES('".$fetch['userID']."','".$fetch['Subject']."',NOW(),NOW(),'$late_check')");

											}

											echo "<script> window.location.href='attendance-form.php'; </script>";

									}
								}
							}
						}
					}
			}	
		}
		else
		{
			echo "Wrong room";
		}
	}

?>