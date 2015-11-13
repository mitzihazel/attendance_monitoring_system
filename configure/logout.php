<?php
session_start();

 include_once("config.php");
 
$result=mysql_query("UPDATE login SET timeOut = NOW(), status = 'Inactive' WHERE username = '".$_SESSION['user']."'");

		unset($_SESSION['login']); 
		echo "<script> 
				alert('Successfully logged out!');
			  </script>
			<meta http-equiv='refresh' content='0;url= ../index.php'>";
			
		session_destroy();
?>
