<?php
	require("database.php");
	
	if(isset($_POST['login'])){
		
	}
?>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<form action="login.php" method="POST">
			Username: <input name="un">
			Password: <input type="password" name="pw">
			<input type="submit" name="login" value="Log In">
		</form>
	</body>
</html>