<?php date_default_timezone_set("Asia/Hong_Kong");

include("../configure/config.php");

//user info
$rfidNo = $_POST['rfidNo'];

//getting current date and time
$day = date("l");
$today = strtotime(date("H:i:s"));


if(isset($_POST['submit']))
	 {//to run PHP script on submit

		  $get = mysql_query("SELECT * FROM user_faculty where rfidNo='".$_POST['rfidNo']."'");
		  //getting the faculty that owns the RFID no entered.

				if(mysql_num_rows($get) > 0) 
				{

					 while ($data = mysql_fetch_array($get)) 
					 {

						$subject = mysql_query("SELECT * FROM class_faculty, user_faculty where class_faculty.userID=user_faculty.userID and user_faculty.rfidNo='".$_POST['rfidNo']."'");
						//getting the schedule of the faculty that owns the RFID No.

						  if(mysql_num_rows($subject) > 0) 
						  {

							 while ($getSubj = mysql_fetch_array($subject))
							 {

								if($getSubj['Days'] == $day)
								{

									//get class start
									$end_class = strtotime($getSubj['endClass']);
		                           	$end = date('H:i', $end_class);

		                           	$start_class = strtotime($getSubj['startClass']);
		                           	$start = date('H:i', $start_class);

									// Late attendance
									$late = strtotime("+15 minutes", $start_class);

									$tardy = $end_class - $start_class;

									// Query to search if naa na ba ang subject sa attendance and if dili pa ba lapas ang oras sa iya class sa currnet. ABSENT.
									$absent = mysql_query("SELECT * FROM attendance_faculty where userID='".$data['userID']."' and subject = '".$getSubj['Subject']."' and date='".date('Y-m-d')."'");
									$abs_query = mysql_fetch_assoc($absent);

										if(mysql_num_rows($absent) > 0)
										{

											// IF DATA is already in database and time is already over.
											if($today > $end_class)
											{

												echo "Already in database.";

											}
											else if($today >= $start_class)
											{

												$timein = $abs_query['timeIn'];
			                                	$time_in = strtotime($timein);

			                                	$total = $today-$time_in;

			                                	if($abs_query['timeOut']!=0) 
			                                	{
			                                     echo"
			                                       <script>
			                                       alert('You have already timed out');
			                                       </script>
			                                       <meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
			                                       ";   

				                      	         } else {         

				                                      $que = "UPDATE attendance_faculty set timeOut=NOW(), totalHour='".gmdate("H:i:s", $total)."' where subject='".$getSubj['Subject']."'";
				                                      $res = mysql_query($que) or die ("Error in query:" .mysql_error());
				                                           
				                                             echo"
				                                               <meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
				                                               ";   
				                                    
				                        	      }


											}

										} // IF subject and user and date is in the database.
										else 
										{
											if($today > $end_class)
											{
												// I SEARCH DIRI SA DATABASE IF NAAY WA KA LOG OUT THEN I LOG OUT USA BEFORE I ABSENT ANG UBAN
												
												/* Code for recording absences for the day */
												$query = "INSERT INTO attendance_faculty(userID,subject,date,timeIn, timeout, Attendance,tardinessCount) 
			                                   	VALUES ('".$data['userID']."','".$getSubj['Subject']."',NOW(), '00:00:00', '00:00:00', 'Absent','".gmdate("H:i", $tardy)."')";
			                                   	$result = mysql_query($query) or die ("Error in query:" .mysql_error());
			                                      
			                                   	echo"
			                                  	<meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
			                                  	";

											}
											else if($today >= $start_class)
											{

												$lateCount = $today - $late; 

												if($today >= $late)
												{

													$query = "INSERT INTO attendance_faculty(userID,subject,date,timeIn,Attendance,tardinessCount) 
						                           VALUES ('".$data['userID']."','".$getSubj['Subject']."',NOW(),NOW(),'Late','".gmdate("H:i:s", $lateCount)."')";
						                           $result = mysql_query($query) or die ("Error in query:" .mysql_error());
						                           
						                             echo"
						                               <meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
						                               ";

												} else {

						                              $query = "INSERT INTO attendance_faculty(userID,subject,date,timeIn,Attendance) 
					                                 VALUES ('".$data['userID']."','".$getSubj['Subject']."',NOW(),NOW(),'Present')";
					                                 $result = mysql_query($query) or die ("Error in query:" .mysql_error());
					                                 
					                                   echo"
					                                     <meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
					                                     ";											
												}

											}

										} // Else if the subject and user and date is not in the database.

								} else {

								  /*  echo"
										<script>
										alert('No Schedule today.');
										</script>
										<meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
										"; */
										//end of checking for equal schedule of today.
										echo "No Schedule today."; 
								} 

							 }

						  } else {
							 echo"
								<script>
								alert('".$data['lastName']." has no schedule.');
								</script>
								<meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
								";
						  } //end of getting schedule.

					 }

				} else {

				  	$stud = mysql_query("SELECT * FROM user_student where rfidNo='".$_POST['rfidNo']."'");
 			  		$stud_get = mysql_fetch_assoc($stud);

				  if(mysql_num_rows($stud) > 0) 
				  {

				  	$check_day = mysql_query("SELECT * FROM stud_vacant where studID ='".$stud_get['userID']."'");
			  		
			  		while ($row = mysql_fetch_assoc($check_day)) 
			  		{
			  			
			  			if($row['Day'] == $day)
			  			{
			  				$time_start = strtotime($row['time_start']);
			  				$time_end = strtotime($row['time_end']);
			  				$late = strtotime("+15 minutes", $row['time_start']);
			  				
			  				if($today >= $time_start && $today <= $time_end)
			  				{
			  					//FOR TIME-Out CHECKING
			  					$abs = mysql_query("SELECT * FROM attendance_student where userID = '".$row['studID']."' and date='".date('Y-m-d')."'");
			  					$abs_get = mysql_fetch_assoc($abs);

			  					$timeIn = strtotime($abs_get['timeIn']);
			  					$timeOut = strtotime($abs_get['timeOut']);

			  					//GETTING THE AREA ASSIGNED FOR STUDENT
			  					$area = mysql_query("SELECT area from area_assign where studentID='".$row['studID']."'");
				  				$area_get = mysql_fetch_assoc($area);

			  					if($timeIn >= $time_start && $timeIn <= $time_end)
			  					{
			  						mysql_query("UPDATE attendance_student set timeOut='".date('H:i:s')."' where userID='".$row['studID']."'");
				  					echo "<script> alert('a'); window.location.href='../attendance/attendance-form.php'; </script>";
			  					}
			  					else
			  					{
			  						if($today > $late)
			  						{
			  							$lateCtr = $today - $late;

				  						//for TIME IN = LATE
				  						mysql_query("INSERT INTO attendance_student(userID,area,date,timeIn,tardinessCount,Attendance) VALUES ('".$row['studID']."','".$area_get['area']."',NOW(),NOW(),'".gmdate('H:i:s',$lateCtr)."','Late')");
				  						echo "<script> alert('a'); window.location.href='../attendance/attendance-form.php'; </script>";

			  						}
			  						else
			  						{
				  						//for TIME IN = LATE
				  						mysql_query("INSERT INTO attendance_student(userID,area,date,timeIn,Attendance) VALUES ('".$row['studID']."','".$area_get['area']."',NOW(),NOW(),'Present')");
				  						echo "<script> alert('b'); window.location.href='../attendance/attendance-form.php'; </script>";
			  						}
			  					}
			  				}
			  				else
			  				{
			  					echo "No Scheule now.";
			  				}
			  			}
			  		}


				  } else {

					 echo"
						<script>
						alert('".$_POST['rfidNo']." not Found.');
						</script>
						<meta http-equiv='refresh' content='0;url= ../attendance/attendance-form.php'>
						";
				  }
				 
				} //end of searching the owner of RFID No for FACULTY.
		}

?>