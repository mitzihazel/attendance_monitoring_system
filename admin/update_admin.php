<?php session_start();

include('../configure/config.php');

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$dept = $_POST['department'];
$confirm = $_POST['confirm'];


	if($password == $confirm)
	{
		$query = mysql_query("SELECT * FROM login where userLevel = 'Admin' ");

		if(mysql_num_rows($query) > 0)
		{
			$update = mysql_query("UPDATE login SET Name = '".$_POST['name']."', Department = '".$_POST['department']."',username = '".$_POST['username']."', password = '".$_POST['password']."'");

			echo 
			"<script>
				alert('Success!');
			</script>
			<meta http-equiv='refresh' content='0;url= ../admin/profile.php'>";

		}
	}
	else
	{
		echo 
			"<script>
				alert('Password not match!');
			</script>
			<meta http-equiv='refresh' content='0;url= ../admin/profile.php'>";
	}

?>