<?php session_start();

 $con=mysqli_connect("localhost","root","","ourdb"); 
	if (mysqli_connect_errno()) { 
	echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
	} 
$name = $_POST['username'];
$pass = $_POST['password'];

$result = mysqli_query($con, "SELECT * FROM login WHERE username = '".$name."' AND password= '".$pass."' "); 
	$data=mysqli_fetch_assoc($result);  	
	$userlvl=$data['userLevel'];
	if (mysqli_num_rows($result)){
	mysqli_query($con, "UPDATE login SET timeIn = NOW(), status = 'Active' WHERE username = '".$name."'");
	if($userlvl=="Admin"){
			$_SESSION['login'] = "Admin";
			$_SESSION['user']= $data['username'];
			//$_SESSION['first']= $data['Firstname'];
			//$_SESSION['mid']= $data['MI'];
			echo"<script> alert('Welcome');  window.location.href='../homepage/home.php'; </script>
			"; 
			}
	}
	else{ 
		echo " <script> 
			alert('Invalid Username and/or Password!'); 
			</script> "; 
			echo"<meta http-equiv = 'refresh' content = '0; url = ../index.php'/>
		"; 
	} 			
	mysqli_close($con); 
?>

