<?php session_start();
date_default_timezone_set("Asia/Hong_Kong");
include("../design/links.php");
include("../design/navbar.php");
echo"<br>";
?>


  <div id="wrapper">
    
    <?php include('../design/sidebar.php');

    include("../configure/config.php");

    if(isset($_GET['delete']))
	{
		$delete = mysql_query("DELETE FROM attendance_faculty where userID='".$_GET['id']."' and subject='".$_GET['delete']."' and timeIn='".$_GET['time']."'");
		$id = $_GET['id'];

        echo "<script> alert('Record Deleted.'); window.location.href='ind_report.php?view=$id'; </script>";
	}

    if(isset($_GET['level']) == 'faculty')
    {
    	$que = mysql_query("SELECT * FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$_GET['id']."' and a.subject='".$_GET['edit']."' and timeIn='".$_GET['time']."'");
    	$data=mysql_fetch_assoc($que);
    }
    else if(isset($_GET['level']) == 'student')
    {
		$que = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$_GET['id']."' and a.subject='".$_GET['edit']."' and timeIn='".$_GET['time']."'");
    	$data=mysql_fetch_assoc($que);    	
    }

    // getting Day
	$d = strtotime($data['date']);
    $dd = date("l", $d);

    ?>
    	<div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                <!-- Page Heading -->
		          <div class="row">
		              <div class="col-lg-12">
		                  <h1 class="page-header">
		                      Edit Report <br/>
		                  </h1>
		              </div>
		          </div>
                    <div class="col-lg-20">
                      <div class="container container">
                      	<div id="content">
                      	<br>
                      		<form name="edit" method="post" action="">

                      			<?php
                      				if(isset($_GET['level']) == 'faculty')
                      				{
                      			?>
								      	<table class="table table-bordered table-hover table-striped" width="80%">
								          <thead>
								             <tr>
								                <th>Subject</th>
								                <th>Date</th>
								                <th>Time In</th>
								                <th>Time Out</th>
								                <th>Attendance</th>
								                <th>Excuse Cause</th>
								             </tr>
								          </thead>
								          <tbody>
								             <tr>
								                <td><input type="text" name="subject" value="<?php echo $data['subject']; ?>"></td>
								                <td><input type="date" name="date" value="<?php echo $data['date'] ?>"></td>
								                <td><input type="time" name="timein" value="<?php echo $data['timeIn'] ?>"></td>
								                <td><input type="time" name="timeout" value="<?php echo $data['timeOut']?>"></td>
								                <td><input type="text" name="attendance" value="<?php echo $data['Attendance']; ?>"></td>
								                <td><input type="text" name="excuse" value="<?php echo $data['Cause']; ?>"></td>
								             </tr>
								          </tbody>
							       		</table>
							    <?php
							    	}
							    	else if(isset($_GET['level']) == 'student')
							    	{
							    ?>
							    		<table class="table table-bordered table-hover table-striped" width="80%">
								          <thead>
								             <tr>
								                <th>Task</th>
								                <th>Location</th>
								                <th>Date</th>
								                <th>Time In</th>
								                <th>Time Out</th>
								                <th>Attendance</th>
								                <th>Excuse Cause</th>
								             </tr>
								          </thead>
								          <tbody>
								             <tr>
								                <td><input type="text" name="task" value="<?php echo $data['task']; ?>"></td>
								                <td><input type="text" name="area" value="<?php echo $data['area']; ?>"></td>
								                <td><input type="date" name="date" value="<?php echo $data['date'] ?>"></td>
								                <td><input type="time" name="timein" value="<?php echo $data['timeIn'] ?>"></td>
								                <td><input type="time" name="timeout" value="<?php echo $data['timeOut']?>"></td>
								                <td><input type="text" name="attendance" value="<?php echo $data['Attendance']; ?>"></td>
								                <td><input type="text" name="excuse" value="<?php echo $data['Cause']; ?>"></td>
								             </tr>
								          </tbody>
							       		</table>
							    <?php
							    	}
							    ?>

					       		<input type="submit" name="submit" value="Update">
					       	</form>
				       	</div>
			       	   </div>
			    	</div>
			 	</div>
			</div>
		</div>
    <?php

    if(isset($_POST['submit']))
    {
    	$task = $_POST['task'];
    	$area = $_POST['area'];
    	$subject = $_POST['subject'];
    	$date = $_POST['date'];
    	$timein = $_POST['timein'];
    	$timeout = $_POST['timeout'];
    	$attendance = $_POST['attendance'];
    	$excuse = $_POST['excuse'];

    	if(isset($_GET['level']) == 'faculty')
    	{

    	$query = mysql_query("UPDATE attendance_faculty SET subject='".$_POST['subject']."', date='".$_POST['date']."', timeIn='".$_POST['timein']."', timeOut='".$_POST['timeout']."', Attendance='".$_POST['attendance']."' where userID='".$_GET['id']."' and subject='".$_GET['edit']."' and timeIn='".$_GET['time']."'");

			echo "
				<script>
					alert('Saved.');
				</script>
				<meta http-equiv='refresh' content='0;url= ../report/ind_report.php?view=".$_GET['id']."'>";
		}
		else if(isset($_GET['level']) == 'student')
		{
			$query = mysql_query("UPDATE attendance_student SET task='".$_POST['task']."', area='".$_POST['area']."', subject='".$_POST['subject']."', date='".$_POST['date']."', timeIn='".$_POST['timein']."', timeOut='".$_POST['timeout']."', Attendance='".$_POST['attendance']."' where userID='".$_GET['id']."' and subject='".$_GET['edit']."' and timeIn='".$_GET['time']."'");

			echo "
				<script>
					alert('Saved.');
				</script>
				<meta http-equiv='refresh' content='0;url= ../report/ind_report.php?viewer=".$_GET['id']."'>";
		}
    }

    ?>

  </div>