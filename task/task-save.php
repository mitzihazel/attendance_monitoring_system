<?php

include("../configure/config.php");

//user info
$student = $_POST['student'];
$area = $_POST['area'];

if(isset($_POST['submit']))
    {//to run PHP script on submit

        $query = "INSERT INTO area_assign(studentID,area,position) 
        VALUES ('".$_POST['student']."','".$_POST['area']."','".$_POST['position']."')";
        $result = mysql_query($query) or die ("Error in query:" .mysql_error());
            echo"
            <script>
            alert('Record Successfully Added!');
            </script>
            <meta http-equiv='refresh' content='0;url= show-task.php'>
            ";
    } 

?>