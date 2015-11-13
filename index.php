<?php session_start();
	  include_once("configure/config.php");
	  
	if(isset($_SESSION['login'])) {
	  header("Location: homepage/home.php");
	}
?>
<html>
	<?php 
		include("design/links.php"); 
	?>
	<body>

	    <div class="wrapper">
		<div class="container">
			<h1>Welcome</h1>
			
			<form class="form" method="post" action='login/login-check.php'>
				<input type="text" name='username' placeholder="Username">
				<input type="password" name='password' placeholder="Password">
				<input type="submit" value='Login' name='submit' id="login-button">
			</form>
		</div>
		
		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>

	