	for($i=0;$i<count($day);$i++)
		{
			//echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
			
			if($day[$i] == $day[$i+1])
			{
				//echo $end[$i]." - ".$end[$i+1]." ".$day[$i]."  == <br>";

				if($start[$i+1] >= $s)
				{
				}
				else if($start[$i+1] == $end[$i])
				{
				}
				else
				{
					echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." -- <br>";
				}

			}
			else
			{
				//echo $end[$i]." - ".$end[$i+1]." ".$day[$i]."  != <br>";
				if($start[$i] < $s)
				{
					if($end[$i] > $s)
					{

					}
					else if($end[$i] == $s)
					{

					}
					else
					{
						echo $end[$i]." - ".$s." ".$day[$i]." = <br>";						
					}
				}
				else if($start[$i] >= $s)
				{
					echo $end[$i-1]." - ".$s." ".$day[$i]." . <br>";
				}
				
				echo "<br>";

				if($start[$i] != $b)
				{	
					if($start[$i+1] == 0)
					{
						echo $b." - ".$start[0]." ".$day[0]." , <br>";
					}
					else
					{
						echo $b." - ".$start[$i+1]." ".$day[$i+1]." / <br>";
					}

					
				}
				else
				{
					/* $a = strtotime("+15 minutes", $begin);
					$plus = date("H:i:s", $a);

					if($start[$i+1] == 0)
					{
						echo $b." - ".$plus." ".$day[0]." // <br>";
					}
					else
					{
						echo $b." - ".$plus." ".$day[$i+1]." /// <br>";
					}*/
				}
			}

		} 





















		for($i=0;$i<count($day);$i++)
		{
			//echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
			
			if($day[$i] == $day[$i+1])
			{
				if($start[$i] == $b)
				{
					echo $start[$i]." - ".$plus." ".$day[$i]."<br>";					
				}
				else
				{
					echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
				}
			}
			else
			{
				echo "<br>";
				if($start[$i] == $b)
				{
					echo $start[$i]." - ".$plus." ".$day[$i]."<br>";
				}
			}

		}



















		for($i=0;$i<count($day);$i++)
		{
			//echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
			
			if($day[$i] == $day[$i+1])
			{
				//echo $end[$i]." - ".$end[$i+1]." ".$day[$i]."  == <br>";

				if($start[$i] == $b)
				{
					echo $start[$i]." - ".$plus." ".$day[$i]."<br>";					
				}
				else
				{
					echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
				}
				
				if($start[$i+1] >= $s)
				{
				}
				else if($start[$i+1] == $end[$i])
				{
				}
				else
				{
					echo $end[$i]." - ".$start[$i+1]." ".$day[$i]." -- <br>";
				}

			}
			else
			{
				//echo $end[$i]." - ".$end[$i+1]." ".$day[$i]."  != <br>";
				if($start[$i] < $s)
				{
					if($end[$i] > $s)
					{

					}
					else if($end[$i] == $s)
					{

					}
					else
					{
						echo $end[$i]." - ".$s." ".$day[$i]." = <br>";						
					}
				}
				else if($start[$i] >= $s)
				{
					echo $end[$i-1]." - ".$s." ".$day[$i]." . <br>";
				}
				
				echo "<br>";

				if($start[$i] != $b)
				{	
					if($start[$i+1] == 0)
					{
						echo $b." - ".$start[0]." ".$day[0]." , <br>";
					}
					else
					{
						echo $b." - ".$start[$i+1]." ".$day[$i+1]." / <br>";
					}

					
				}
				else
				{
					 $a = strtotime("+15 minutes", $begin);
					$plus = date("H:i:s", $a);

					if($start[$i+1] == 0)
					{
						echo $b." - ".$plus." ".$day[0]." // <br>";
					}
					else
					{
						echo $b." - ".$plus." ".$day[$i+1]." /// <br>";
					}
				}
			}

		} 




			//SUBMITTING FORM
	/*	if(isset($_POST['submit']))
		{
			for($i=0;$i<count($day);$i++)
			{
				//echo $start[$i]." - ".$end[$i]." ".$day[$i]."<br>";
				
				if($day[$i] == $day[$i+1])
				{
					//echo $end[$i]." - ".$end[$i+1]." ".$day[$i]."  == <br>";

					if($start[$i+1] >= $s)
					{
					}
					else if($start[$i+1] == $end[$i])
					{
					}
					else
					{
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
							//echo $end[$i]." - ".$start[$i+1]." ".$day[$i]."  == <br>";
						}
					}
				}
				else
				{
					//echo $end[$i]." - ".$end[$i+1]." ".$day[$i]."  != <br>";
					if($start[$i] < $s)
					{
						if($end[$i] > $s)
						{

						}
						else if($end[$i] == $s)
						{

						}
						else
						{
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
								//echo $end[$i]." - ".$s." ".$day[$i]." end <br>";
							}						
						}
					}
					else if($start[$i] >= $s)
					{

						if($_GET['do']=='Re')
						{
							$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i]."' and time_start='".$end[$i-1]."'");
							$get = mysql_fetch_assoc($view);

							if(mysql_num_rows($view) > 0)
							{
								$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i]."',time_end='".$s."',time_start='".$end[$i-1]."' where studID='".$_GET['id']."')");
							}
							else
							{
							$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i-1]."')");
							}
						}
						else 
						{
							$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i]."','".$s."','".$end[$i-1]."')");
							//echo $end[$i-1]." - ".$s." ".$day[$i]." end <br>";
						}
					}
					echo "<br>";
					if($start[$i] != $b)
					{	
						if($start[$i+1] == 0)
						{

							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[0]."' and time_start='".$b."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[0]."',time_end='".$start[0]."',time_start='".$b."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[0]."','".$start[0]."','".$b."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[0]."','".$start[0]."','".$b."')");
								//echo $b." - ".$start[0]." ".$day[0]." try <br>";	
							}
						}
						else
						{

							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i+1]."' and time_start='".$b."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i+1]."',time_end='".$start[$i+1]."',time_start='".$b."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i+1]."','".$start[$i+1]."','".$b."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i+1]."','".$start[$i+1]."','".$b."')");
								//echo $b." - ".$start[$i+1]." ".$day[$i+1]." try <br>";	
							}
						}
					}
					else
					{
						$a = strtotime("+15 minutes", $begin);
						$plus = date("H:i:s",$a);

						if($start[$i+1] == 0)
						{
							//echo $b." - ".$plus." ".$day[0]." <br>";
							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[0]."' and time_start='".$b."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[0]."',time_end='".$plus."',time_start='".$b."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[0]."','".$plus."','".$b."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[0]."','".$plus."','".$b."')");
							}
						}
						else
						{
							//echo $b." - ".$plus." ".$day[$i+1]." <br>";
							if($_GET['do']=='Re')
							{
								$view = mysql_query("SELECT * From stud_vacant where studID='".$_GET['id']."' and Day='".$day[$i+1]."' and time_start='".$b."'");
								$get = mysql_fetch_assoc($view);

								if(mysql_num_rows($view) > 0)
								{
									$query = mysql_query("UPDATE stud_vacant set studID='".$_GET['id']."',Day='".$day[$i+1]."',time_end='".$plus."',time_start='".$b."' where studID='".$_GET['id']."')");
								}
								else
								{
									$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i+1]."','".$plus."','".$b."')");
								}
							}
							else 
							{
								$query = mysql_query("INSERT INTO stud_vacant(studID,Day,time_end,time_start) VALUES ('".$_GET['id']."','".$day[$i+1]."','".$plus."','".$b."')");
							}
						}
					}
				}

			}

			echo"
                <script>
                alert('Schedule Successfully Generated!');
                </script>
                <meta http-equiv='refresh' content='0;url= ../schedule/show-sched.php'>
                ";
		}
	*/