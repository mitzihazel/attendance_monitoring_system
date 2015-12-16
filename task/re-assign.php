<?php session_start();
	include_once("../configure/config.php");

	$a = extract($_POST);
	mysql_real_escape_string($a);

	if(isset($_POST['submit']))
	{
		$query = mysql_query("UPDATE area_assign SET studentID='$stud_name' where area='$id'");
?>
		<script>
			alert('Success');
			window.location.href='../logs/logs.php';
		</script> 
<?php
	} 

?>