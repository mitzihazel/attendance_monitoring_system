<?php

function birthday($birthday){ 
    $age = strtotime($birthday);
    
    if($age === false){ 
        return false; 
    } 
    
    list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
    
    $now = strtotime("now"); 
    
    list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
    
    $age = $y2 - $y1; 
    
    if((int)($m2.$d2) < (int)($m1.$d1)) 
        $age -= 1; 
        
    return $age; 
} 

include("../configure/config.php");

//user info
$userID = $_POST['userID'];
$first = $_POST['firstname'];
$last  = $_POST['lastname'];
$mi = $_POST['mi'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];
$status = $_POST['status'];
$RFIDNo = $_POST['RFIDNo'];
$usrlevel = $_POST['usrlevel'];

//image info
$target_dir = "uploads/";
$date = date("mdyHis");
$target_file = $target_dir . $date . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
}
else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $rfid = mysql_query("SELECT * FROM user_student");

        if(mysql_num_rows($rfid) == 0)
        {
            $birth = birthday($birthdate);

            $query_upload="INSERT into user_student(userID,lastName,firstName,mi,birthdate,age,status,gender,userType,rfidNo,image) VALUES ('".$_POST['userID']."','".$_POST['lastname']."','".$_POST['firstname']."','".$_POST['mi']."','".$_POST['birthdate']."', '".$birth."','".$_POST['status']."','".$_POST['gender']."','".$_POST['usrlevel']."','".$_POST['RFIDNo']."','".$target_file."')";
            mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());
            echo"<script>
              alert('Student Successfully Added');
              </script>
              <meta http-equiv='refresh' content='0;url= ../homepage/home.php'>";

        }
        else
        {
            while($see = mysql_fetch_assoc($rfid))
            {

                if($see['rfidNo'] == $_POST['RFIDNo']) {
                    echo "<script> alert('RFID number already exists'); </script>";
                }
                else if($see['userID'] == $_POST['userID'])
                {
                    echo "<script> alert('User ID already exists'); </script>";
                }
                else {

                    $birth = birthday($birthdate);

                    $query_upload="INSERT into user_student(userID,lastName,firstName,mi,birthdate,age,status,gender,userType,rfidNo,image) VALUES ('".$_POST['userID']."','".$_POST['lastname']."','".$_POST['firstname']."','".$_POST['mi']."','".$_POST['birthdate']."', '".$birth."','".$_POST['status']."','".$_POST['gender']."','".$_POST['usrlevel']."','".$_POST['RFIDNo']."','".$target_file."')";
                    mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());
                    echo"<script>
                      alert('Student Successfully Added');
                      </script>
                      <meta http-equiv='refresh' content='0;url= ../homepage/home.php'>";

                     // The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.
                }
            }
        }

    } else {
        echo "Sorry, there was an error uploading your image.";
    }
}

?>