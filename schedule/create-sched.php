<?php session_start();

include("../configure/config.php");

$success = 0;

//user info

if(isset($_POST['submit']))
    {//to run PHP script on submit
          
        for($i=0;$i<count($_POST['days']);$i++)
        {   
           if($_GET['viewer'] == 'Faculty') {

                $chck_repeat = mysql_query("SELECT * FROM class_faculty where subject_id='".$_POST['code']."'");
                $get_chk = mysql_fetch_assoc($chck_repeat);

                if($_POST['faculty'] == $get_chk['userID'])
                {
                    $query = "INSERT INTO class_faculty(classID,userID,subject_id, Days,startClass,endClass,locationDescr) 
                    VALUES ('','".$_POST['faculty']."','".$_POST['code']."','".$_POST['days'][$i]."','".$_POST['time_start']."','".$_POST['time_end']."','".$_POST['room']."')";
                    $result = mysql_query($query) or die ("Error in query:" .mysql_error());

                    $success = 1;
                }
                else
                {
                    echo "<script> alert('Subject already assigned to another faculty.'); window.location.href='create-schedule.php?sched=Faculty'; </script>";
                }
                  

            } else if($_GET['viewer'] == 'Student') {

                $query = "INSERT INTO class_student(classID,userID,subject_id,Days,startClass,endClass,locationDescr,teacher,course) 
                VALUES ('','".$_POST['faculty']."','".$_POST['code']."','".$_POST['days'][$i]."','".$_POST['time_start']."','".$_POST['time_end']."','".$_POST['room']."','".$_POST['teacher']."','".$_POST['course']."')";
                $result = mysql_query($query) or die ("Error in query:" .mysql_error());

                $success = 1;
                  
            } 
        }

        if($success == 1)
        {
            echo "<script> alert('Subject Successfully Added!'); window.location.href='../schedule/show-sched.php'; </script>"; 
        }
    }
else if(isset($_POST['update']))
    {
    //to run PHP script on submit
        if($_GET['viewer'] == 'Faculty') {

            $que=mysql_query("DELETE FROM class_faculty where subject_id='".$_POST['code']."' and startClass='".$_SESSION['t']."'");
        }
        if($_GET['viewer'] == 'Faculty') {

            $que=mysql_query("DELETE FROM class_student where subject_id='".$_POST['code']."' and startClass='".$_SESSION['t']."'");
        }

        for($x=0;$x<count($_POST['days']);$x++)
        {   
           if($_GET['viewer'] == 'Faculty') {

                $query = "INSERT INTO class_faculty(classID,userID,subject_id, Days,startClass,endClass,locationDescr) 
                VALUES ('','".$_POST['faculty']."','".$_POST['code']."', '".$_POST['days'][$x]."','".$_POST['time_start']."','".$_POST['time_end']."','".$_POST['room']."')";
                $result = mysql_query($query) or die ("Error in query:" .mysql_error());
                  
                    
            } else if($_GET['viewer'] == 'Student') {

                $query = "INSERT INTO class_student(classID,userID,subject_id, Days,startClass,endClass,locationDescr,teacher,course) 
                VALUES ('','".$_POST['faculty']."','".$_POST['code']."', '".$_POST['days'][$x]."','".$_POST['time_start']."','".$_POST['time_end']."','".$_POST['room']."','".$_POST['teacher']."','".$_POST['course']."')";
                $result = mysql_query($query) or die ("Error in query:" .mysql_error());
                  
            } 
        }

         echo "<script> alert('Subject Successfully Added!'); window.location.href='../schedule/show-sched.php'; </script>";
    } 

?>