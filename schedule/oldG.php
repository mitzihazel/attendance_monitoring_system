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
		
		$edit = mysql_query("SELECT * FROM class_student where classID='".$_GET['edit']."'");
		$ed = mysql_fetch_assoc($edit);

			if($_GET['edit'])
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


		/*$dis = mysql_query("SELECT distinct Days FROM class_student order by Days ASC");
		while($dis_get = mysql_fetch_assoc($dis))
		{
			//echo "<tr>";
			$q = mysql_query("SELECT * FROM class_student where Days='".$dis_get['Days']."'");
			while($qq = mysql_fetch_assoc($q))
			{
				for($i=0;$i<count($day);$i++)
				{
					
					
				}
			echo $qq['startClass']." <br>";
			}
		} */

		for($i=0;$i<count($day);$i++)
		{
			//echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
			if($day[$i] == $day[$i+1])
			{
				//echo "<br>";

				//code for 7:30 start time
				if($start[$i] == $b)
				{
					echo $start[$i]." - ".$plus." ".$day[$i]." '' <br>";
				}
				else
				{
					if($start[$i+1] == $lunch)
					{
					}	
					else if($start[$i+1] == $lunch_end)
					{	
					}
					else
					{
						if($start[$i+1] < $lunch_end)
						{
							if($start[$i+1] > $lunch)
							{
								//echo $end[$i]." - ".$start[$i]." ".$day[$i]." [ <br>";
							}
							else
							{
								if($start[$i-1] != $b)
								{
									echo $b." - ".$start[$i]." ".$day[$i]." [n <br>";	
								}
								else
								{

								}
														
							}
						}
						else
						{
							if($start[0] >= $lunch_end)
							{
								echo $b." - ".$lunch." ".$day[$i]." / <br>";
							}
						}
					}

				}

					//code for 12 noon
					if($start[$i+1] > $lunch)
					{
						if($end[$i] == $start[$i+1])
						{

						}
						else if($end[$i+1] > $s)
						{
							if($end[$i] == $lunch)
							{
								if($start[$i+1] > $s)
								{
									echo $lunch_end." - ".$s." ".$day[$i]." =|= <br>";
								}
								else
								{
									echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." |= <br>";
								}
							}
							else
							{
								if($end[$i+1] > $s)
								{
									if($end[$i] > $lunch && $end[$i] < $lunch_end)
									{
										if($start[$i+1] == $lunch_end)
										{
											echo $start[$i+1]." - ".$s." ".$day[$i]." |s <br>";
										}
										else
										{
											echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." |s <br>";
										}

									}
									else
									{
										echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." |s <br>";
									}
								}
								else
								{
									echo $end[$i]." - ".$s." ".$day[$i]." | <br>";
								}
							}
						}
						else if($start[$i+1] >= $lunch)
						{
							if($end[$i] > $lunch && $end[$i] < $lunch_end)
							{
								//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." ;s <br>";
							}
							else if($end[$i] == $lunch)
							{

							}
							else
							{
								if($start[$i] > $lunch && $start[$i] < $lunch_end)
								{

								}
								else
								{
									if($start[$i+1] > $lunch_end)
									{
										if($start[$i-1] > $lunch_end)
										{
											echo $b." - ".$start[$i]." ".$day[$i]." []n <br>";
										}
										else
										{

										}
									}
									else
									{
										echo $end[$i]." - ".$lunch." ".$day[$i]." += <br>";
									}
								}
							}

							if($start[$i+1] > $lunch_end)
							{
								if($end[$i] >= $lunch)
								{
									echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." =+1 <br>";
								}
								else
								{
									echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." +=+ <br>";
								}
							}
						}
						else
						{
							echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." ;+ <br>";
						}
					}
					else if($start[$i+1] == $end[$i])
					{

					}
					else
					{
						echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." . <br>";
					}

					// code for STOP TIME 5:00 Pm
					if($start[$i+1] >= $s)
					{
					}
					else if($start[$i+1] == $end[$i])
					{
					}
					else
					{
						if($start[$i+1] <= $lunch)
						{

						}
						else if($start[$i+1] == $lunch_end)
						{

						}
						else
						{
							
							//echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." ] <br>";
						}
					}
					if($end[$i] >= $s)
					{

					}
			}
			else
			{
				//code for 7:30 am
				if($start[$i] == $b)
				{
					echo $b." - ".$plus." ".$day[$i]." = <br>";
				}
				else
				{
					if($start[$i] < $lunch)
					{
						if($start[$i-1] == $b)
						{

						}
						else
						{
							if($start[$i-1] < $lunch)
							{
								echo $b." - ".$start[$i]." ".$day[$i]." =..sv <br>";
							}
							else
							{
								echo $b." - ".$start[$i]." ".$day[$i]." =..s <br>";
							}
						}					
					}
					else if($start[$i] >= $lunch)
					{
						if($start[$i] >= $lunch_end)
						{
							if($start[$i] <= $lunch)
							{
								echo $b." - ".$lunch." ".$day[$i]." =.. <br>";
							}
							else
							{
								if($start[$i-1] == $b)
								{

								}
								else
								{
									if($start[$i-1] >= $lunch)
									{
										//echo $b." - ".$lunch." ".$day[$i]." =..''a <br>";
									}
									else
									{
										echo $b." - ".$start[$i-1]." ".$day[$i]." =..'' <br>";																	
									}
								}
							}
						}
						else
						{
							echo $b." - ".$start[$i]." ".$day[$i]." =..b <br>";
						}
					}
				}

				//code for 12:00 pm
				if($end[$i] <= 	$lunch)
				{
					echo $end[$i]." - ".$lunch." ".$day[$i]." -- <br>";
				}

				// code for STOP TIME 5:00 Pm
				if($start[$i] >= $s)
				{
				}
				else if($start[$i] == $end[$i])
				{
				}
				else if($start[$i] < $lunch_end)
				{
					if($start[$i] > $lunch && $start[$i] < $lunch_end)
					{
						if($end[$i] >= $s)
						{

						}
						else
						{
							echo $end[$i]." - ".$s." ".$day[$i]." as <br>";							
						}
					}
					else if($end[$i] > $lunch_end && $end[$i] < $s)
					{
						echo $end[$i]." - ".$s." ".$day[$i]." ]\[ <br>";
					}
					else
					{
						echo $lunch_end." - ".$s." ".$day[$i]." ) <br>";
					}
				}
				else
				{
					if($start[$i] > $s)
					{
						echo $lunch_end." - ".$s." ".$day[$i]." > <br>";
					}
					else if($start[$i] < $s && $end[$i] > $s)
					{
					}
					else if($start[$i] == $s)
					{
						if($start[$i] < $lunch_end)
						{

						}
						else
						{
							echo $lunch_end." - ".$s." ".$day[$i]." >s <br>";
						}
					}
					else
					{
						if($end[$i] == $s)
						{

						}
						else
						{
							echo $end[$i]." - ".$s." ".$day[$i]." /\ <br>";
						}
					}
				} 
				echo "<br>";
			}

		}

		//echo "<div class='panel-body col-lg-6'>";
		//echo "<table class='table table-bordered table-hover table-striped'>";
		//echo "<tr><th>  Time Start </th><th> Time End </th><th> Day </th></tr>";


		/*$z=0;
		$dis = mysql_query("SELECT distinct Days FROM class_student order by Days ASC");
		while($dis_get = mysql_fetch_assoc($dis))
		{
			//echo "<tr>";
			for($i=0;$i<count($day);$i++)
			{
				if($day[$i] == $dis_get['Days'])
				{
					if($start[$i] == $b)
					{
						echo $b." - ".$plus." ".$day[$i]." <br>";
					}
					else
					{
						if($z == 0)
						{
							echo $b." - ".$start[$i]." ".$day[$i]." <br>";	
						}
						else
						{
							if($end[$i-1] == $start[$i])
							{

							}
							else
							{
								//CODE For 12:30 to 1:00
								if($end[$i-1] >= $lunch)
								{
									//echo $start[$i-1];
									if($end[$i-1] > $lunch && $end[$i-1] < $lunch_end)
									{

									}
									else
									{
										if($end[$i-1] >= $lunch_end)
										{
											echo $end[$i-1]." - ".$start[$i]." ".$day[$i]." //<br>";
										}
										else
										{
											echo $end[$i-1]." - ".$lunch." ".$day[$i]." /s<br>";
										}
									}
								}
								else
								{
									if($end[$i-1] > $lunch && $end[$i-1] < $lunch_end)
									{

									}
									else
									{
										//echo $start[$i];
										if($start[$i] < $lunch)
										{
											echo $end[$i-1]." - ".$start[$i]." ".$day[$i]." <br>";
										}
										else
										{
											echo $end[$i-1]." - ".$lunch." ".$day[$i]." /<br>";
										}
									}
								}
								//END for LESS THAN 12 PM

								//CODE FOR 1PM
								if($start[$i] > $lunch_end)
								{
									if($start[$i] != $lunch_end)
									{
										//echo $lunch_end." - ".$start[$i]." ".$day[$i]." .<br>";
									}
									else
									{
										echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." <br>";	
									}
								}

								//CODE FOR 5PM
								//echo $start[$i]." - ";
								if($start[$i] < $s && $start[$i] > $lunch_end)
								{
									echo $end[$i]." - ".$s." ".$day[$i]." <br>";	
								}
								else if($start[$i] >= $s)
								{

								}
							}
						}
					}
					$z=$z+1;
				}
				else
				{
					$z = 0;
				}
			}
		}

		*/

		if(isset($_POST['submit']))
		{
			for($i=0;$i<count($day);$i++)
			{
				//echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
				
				if($day[$i] == $day[$i+1])
				{
					//echo "<br>";

					//code for 7:30 start time
					if($start[$i] == $b)
					{
						//echo $start[$i]." - ".$plus." ".$day[$i]." '' <br>";
						if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$start[$i]."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$plus."',time_start='".$start[$i]."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$plus."','".$start[$i]."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$plus."','".$start[$i]."')");
							}
					}
					else
					{

						if($start[$i+1] == $lunch)
						{
						}	
						else if($start[$i+1] == $lunch_end)
						{	
						}
						else
						{
							if($start[$i+1] < $lunch_end)
							{
								if($start[$i+1] > $lunch)
								{
									//echo $end[$i]." - ".$start[$i]." ".$day[$i]." [ <br>";
								}
								else
								{
									if($start[$i-1] != $b)
									{
										//echo $b." - ".$start[$i]." ".$day[$i]." [n <br>";
										if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$b."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i]."',time_start='".$b."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i]."','".$b."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i]."','".$b."')");
										}	
									}
									else
									{

									}
															
								}
							}
							else
							{
								if($start[0] >= $lunch_end)
								{
									//echo $b." - ".$lunch." ".$day[$i]." / <br>";
									if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$b."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$lunch."',time_start='".$b."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$lunch."','".$b."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$lunch."','".$b."')");
										}
								}
							}
						}

					}

						//code for 12 noon
						if($start[$i+1] > $lunch)
						{
							if($end[$i] == $start[$i+1])
							{

							}
							else if($end[$i+1] > $s)
							{
								if($end[$i] == $lunch)
								{
									if($start[$i+1] > $s)
									{
										//echo $lunch_end." - ".$s." ".$day[$i]." =|= <br>";
										if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$lunch_end."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$lunch_end."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$lunch_end."')");
										}
									}
									else
									{
										//echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." |= <br>";
										if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$lunch_end."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$lunch_end."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$lunch_end."')");
										}
									}
								}
								else
								{
									if($end[$i+1] > $s)
									{
										if($end[$i] > $lunch && $end[$i] < $lunch_end)
										{
											if($start[$i+1] == $lunch_end)
											{
												//echo $start[$i+1]." - ".$s." ".$day[$i]." |s <br>";
												if($_GET['do']=='Re')
												{
													$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$start[$i+1]."'");
													$get = mysql_fetch_assoc($view);

													if(mysql_num_rows($view) > 0)
													{
														$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$start[$i+1]."' where studID='".$_GET['id']."')");
													}
													else
													{
														$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$start[$i+1]."')");
													}
												}
												else 
												{
													$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$start[$i+1]."')");
												}
											}
											else
											{
												//echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." |s <br>";
												if($_GET['do']=='Re')
												{
													$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
													$get = mysql_fetch_assoc($view);

													if(mysql_num_rows($view) > 0)
													{
														$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$lunch_end."' where studID='".$_GET['id']."')");
													}
													else
													{
														$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$lunch_end."')");
													}
												}
												else 
												{
													$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$lunch_end."')");
												}
											}

										}
										else
										{
											//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." |s <br>";
											if($_GET['do']=='Re')
											{
												$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
												$get = mysql_fetch_assoc($view);

												if(mysql_num_rows($view) > 0)
												{
													$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
												}
												else
												{
													$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
												}
											}
											else 
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
											}
										}
									}
									else
									{
										//echo $end[$i]." - ".$s." ".$day[$i]." | <br>";
										if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
										}
									}
								}
							}
							else if($start[$i+1] >= $lunch)
							{
								if($end[$i] > $lunch && $end[$i] < $lunch_end)
								{
									//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." ;s <br>";
								}
								else if($end[$i] == $lunch)
								{

								}
								else
								{
									if($start[$i] > $lunch && $start[$i] < $lunch_end)
									{

									}
									else
									{
										if($start[$i+1] > $lunch_end)
										{
											if($start[$i-1] > $lunch_end)
											{
												//echo $b." - ".$start[$i]." ".$day[$i]." []n <br>";
												if($_GET['do']=='Re')
												{
													$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$b."'");
													$get = mysql_fetch_assoc($view);

													if(mysql_num_rows($view) > 0)
													{
														$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i]."',time_start='".$b."' where studID='".$_GET['id']."')");
													}
													else
													{
														$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i]."','".$b."')");
													}
												}
												else 
												{
													$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i]."','".$b."')");
												}
											}
											else
											{

											}
										}
										else
										{
											//echo $end[$i]." - ".$lunch." ".$day[$i]." += <br>";
											if($_GET['do']=='Re')
											{
												$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
												$get = mysql_fetch_assoc($view);

												if(mysql_num_rows($view) > 0)
												{
													$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$lunch."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
												}
												else
												{
													$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$lunch."','".$end[$i]."')");
												}
											}
											else 
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$lunch."','".$end[$i]."')");
											}
										}
									}
								}

								if($start[$i+1] > $lunch_end)
								{
									if($end[$i] >= $lunch)
									{
										//echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." =+1 <br>";
										if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$lunch_end."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$lunch_end."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$lunch_end."')");
										}
									}
									else
									{
									//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." +=+ <br>";
										if($_GET['do']=='Re')
										{
											$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
											$get = mysql_fetch_assoc($view);

											if(mysql_num_rows($view) > 0)
											{
												$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
											}
											else
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
											}
										}
										else 
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
										}
									}
								}
							}
							else
							{
								//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." ;+ <br>";
								if($_GET['do']=='Re')
											{
												$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
												$get = mysql_fetch_assoc($view);

												if(mysql_num_rows($view) > 0)
												{
													$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
												}
												else
												{
													$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
												}
											}
											else 
											{
												$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
											}
							}
						}
						else if($start[$i+1] == $end[$i])
						{

						}
						else
						{
							//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." . <br>";
							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i+1]."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i+1]."','".$end[$i]."')");
							}
						}

						// code for STOP TIME 5:00 Pm
						if($start[$i+1] >= $s)
						{
						}
						else if($start[$i+1] == $end[$i])
						{
						}
						else
						{
							if($start[$i+1] <= $lunch)
							{

							}
							else if($start[$i+1] == $lunch_end)
							{

							}
							else
							{
								
								//echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." ] <br>";
							}
						}
						if($end[$i] >= $s)
						{

						}
				}
				else
				{
					//code for 7:30 am
					if($start[$i] == $b)
					{
						//echo $b." - ".$plus." ".$day[$i]." = <br>";
						if($_GET['do']=='Re')
						{
							$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$b."'");
							$get = mysql_fetch_assoc($view);

							if(mysql_num_rows($view) > 0)
							{
								$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$plus."',time_start='".$b."' where studID='".$_GET['id']."')");
							}
							else
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$plus."','".$b."')");
							}
						}
						else 
						{
							$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$plus."','".$b."')");
						}
					}
					else
					{
						if($start[$i] < $lunch)
						{
							if($start[$i-1] == $b)
							{

							}
							else
							{
								if($start[$i-1] < $lunch)
								{

								}
								else
								{
									//echo $b." - ".$start[$i]." ".$day[$i]." =.. <br>";
									if($_GET['do']=='Re')
									{
										$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$b."'");
										$get = mysql_fetch_assoc($view);

										if(mysql_num_rows($view) > 0)
										{
											$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$start[$i]."',time_start='".$b."' where studID='".$_GET['id']."')");
										}
										else
										{
											$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i]."','".$b."')");
										}
									}
									else 
									{
										$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$start[$i]."','".$b."')");
									}
								}
							}					
						}
					}

					//code for 12:00 pm
					if($end[$i] <= 	$lunch)
					{
						//echo $end[$i]." - ".$lunch." ".$day[$i]." -- <br>";
						if($_GET['do']=='Re')
						{
							$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
							$get = mysql_fetch_assoc($view);

							if(mysql_num_rows($view) > 0)
							{
								$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$lunch."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
							}
							else
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$lunch."','".$end[$i]."')");
							}
						}
						else 
						{
							$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$lunch."','".$end[$i]."')");
						}
					}

					// code for STOP TIME 5:00 Pm
					if($start[$i] >= $s)
					{
					}
					else if($start[$i] == $end[$i])
					{
					}
					else if($start[$i] < $lunch_end)
					{
						if($start[$i] > $lunch && $start[$i] < $lunch_end)
						{
							if($end[$i] >= $s)
							{

							}
							else
							{
								//echo $end[$i]." - ".$s." ".$day[$i]." as <br>";
								if($_GET['do']=='Re')
								{
									$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
									$get = mysql_fetch_assoc($view);

									if(mysql_num_rows($view) > 0)
									{
										$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
									}
									else
									{
										$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
									}
								}
								else 
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
								}							
							}
						}
						else if($end[$i] > $lunch_end && $end[$i] < $s)
						{
							//echo $end[$i]." - ".$s." ".$day[$i]." ]\[ <br>";
							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
							}
						}
						else
						{
							//echo $lunch_end." - ".$s." ".$day[$i]." ) <br>";
							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
							}
						}
					}
					else
					{
						if($start[$i] > $s)
						{
							//echo $lunch_end." - ".$s." ".$day[$i]." > <br>";
							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
							}
						}
						else if($start[$i] < $s && $end[$i] > $s)
						{
						}
						else if($start[$i] == $s)
						{
							if($start[$i] < $lunch_end)
							{

							}
							else
							{
								//echo $lunch_end." - ".$s." ".$day[$i]." >s <br>";
								if($_GET['do']=='Re')
								{
									$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$lunch_end."'");
									$get = mysql_fetch_assoc($view);

									if(mysql_num_rows($view) > 0)
									{
										$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$lunch_end."' where studID='".$_GET['id']."')");
									}
									else
									{
										$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$lunch_end."')");
									}
								}
								else 
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$lunch_end."')");
								}
							}
						}
						else
						{
							if($end[$i] == $s)
							{

							}
							else
							{
								//echo $end[$i]." - ".$s." ".$day[$i]." /\ <br>";
								if($_GET['do']=='Re')
								{
									$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i]."'");
									$get = mysql_fetch_assoc($view);

									if(mysql_num_rows($view) > 0)
									{
										$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i]."' where studID='".$_GET['id']."')");
									}
									else
									{
										$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
									}
								}
								else 
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i]."')");
								}
							}
						}
					} 
					echo "<br>";
				}

			}
			echo"
                <script>
                alert('Schedule Successfully Generated!');
                </script>
                <meta http-equiv='refresh' content='0;url= ../schedule/show-sched.php'>
                ";
		}
	
?>	