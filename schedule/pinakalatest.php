<?php session_start();
date_default_timezone_set("Asia/Hong_Kong");

$day = date("l");
$today = strtotime(date("H:i:s"));
$id = $_GET['id'];

?>
	<form method="post" action="">
		<input type="submit" value="Generate Vacant Schedule" name="submit">
	</form>

<?php

	include('../configure/config.php');
	$end = array();
	$start = array();
	$id = array();
	$day = array();

	//
	$query = mysql_query("SELECT * FROM class_student where userID='".$_GET['id']."' order by Days ASC,endClass ASC");

		while($row = mysql_fetch_assoc($query))
		{
				echo $row['startClass']." - ".$row['endClass']." ".$row['Days']."<br>";

				$start[] = $row['startClass'];
				$end[] = $row['endClass'];
				$id[] = $row['userID'];	
				$day[] = $row['Days'];
		}

		echo "<br><hr>";

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
					if($start[$i+1] <= $lunch)
					{

					}
					else if($start[$i+1] == $lunch_end)
					{

					}
					else
					{
						echo $b." - ".$start[$i]." ".$day[$i]." [ <br>";						
					}
				}

					//code for 12 noon
					if($start[$i+1] > $lunch)
					{
						echo $end[$i]." - ".$lunch." ".$day[$i]." ; <br>";
					}
					else
					{
						echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." . <br>";
					}

					//code for STOP TIME 5:00 Pm
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
							echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." ] <br>";
						}
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
				}

				//code for 12:00 pm
				if($end[$i] <= 	$lunch)
				{
					echo $end[$i]." - ".$lunch." ".$day[$i]." -- <br>";
				}

				//code for STOP TIME 5:00 Pm
				if($start[$i+1] >= $s)
				{
				}
				else if($start[$i+1] == $end[$i])
				{
				}
				else if($start[$i] < $lunch_end)
				{
					echo $lunch_end." - ".$s." ".$day[$i]." ) <br>";
				}
				else
				{
					if($start[$i] >= $s)
					{
						echo $lunch_end." - ".$s." ".$day[$i]." > <br>";
					}
					else if($start[$i] < $s && $end[$i] > $s)
					{
					}
					else
					{
						echo $end[$i]." - ".$s." ".$day[$i]." / <br>";
					}
				}
				echo "<br>";
			}

		}


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
						//echo $start[$i]." - ".$plus." ".$day[$i]." == <br>";
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

						//code for 12 noon
						if($start[$i+1] > $lunch)
						{
							//echo $end[$i]." - ".$lunch." ".$day[$i]." -s <br>";
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
						else
						{
							//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." fd- <br>";
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

						//code for STOP TIME 5:00 Pm
						if($start[$i+1] >= $s)
						{
						}
						else if($start[$i+1] == $end[$i])
						{
						}
						else
						{
							if($start[$i+1] < $lunch)
							{

							}
							else
							{
								//echo $lunch_end." - ".$start[$i+1]." ".$day[$i]." -- <br>";
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
				}
				else
				{
					//code for 7:30 am
					if($start[$i] == $b)
					{
						//echo $b." - ".$plus." ".$day[$i]." a <br>";
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
					}

					//code for 12:00 pm
					if($end[$i] <= 	$lunch)
					{
						//echo $end[$i]." - ".$lunch." ".$day[$i]." !- <br>";
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

					//code for STOP TIME 5:00 Pm
					if($start[$i+1] >= $s)
					{
					}
					else if($start[$i+1] == $end[$i])
					{
					}
					else if($start[$i] < $lunch_end && $end)
					{
						//echo $lunch_end." - ".$s." ".$day[$i]." !-fa <br>";
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
						//echo $end[$i]." - ".$s." ".$day[$i]." - <br>";
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