<?php session_start();
  include_once("../configure/config.php");
  
  if(!isset($_SESSION['login'])){
    header('Location:../index.php');
  }
  
  if($_SESSION['login'] == "Admin"){
    $out = '<li> <a href="../php/logout.php"> Logout </a> </li>';
  }
  else{
    $out = '<a class="button"> LOGIN </a>';
  }
  include("../design/links.php"); 
  include("../design/navbar.php");

  echo"<br>";

?>

<div id="wrapper">
  <?php include('../design/sidebar.php'); ?>

    <div id="page-wrapper">
      <div class="container-fluid content-wrapper">
        <div class="col-md-12">
          <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Add Schedule <br />
                    </h1>
                </div>
            </div>
            <div>
<?php         if($_GET['sched'] == 'Faculty') 
              {
                echo '<form name="scheduleForm" method="post" action="create-sched.php?viewer=Faculty">';
              }
              if($_GET['sched'] == 'Student') 
              {
                echo '<form name="scheduleForm" method="post" action="create-sched.php?viewer=Student">';
              }
?>  
                    <div class="col-md-12">
                      <div class="col-md-12">
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Subject Code</label>
                         <select name="code" id="code" class="form-control selector-options" onchange="viewDescr()">
                            <option>Please Select: </option>
                          <?php
                            $q = mysql_query("SELECT * FROM subject_master");
                            while($r = mysql_fetch_array($q))
                            {
                              echo "<option value='".$r['subject_id']."'>".$r['subject_code']."</option>";
                            }
                          ?>
                         </select>
                        </div>
                      </div>

                     <!-- <script>
                      function viewDescr() {
                          var x = document.getElementById("code").value;
                          //document.getElementById("description").value = x;
                          window.location.href= "create-schedule.php?sched=Faculty&desc=" + x;
                      }
                      </script>

                      <?php
                      //  if(isset($_GET['desc']))
                        {
                      //    $subj_det = mysql_query("SELECT * FROM subject_master where subject_id = '".$_GET['desc']."'");
                      //    $details = mysql_fetch_assoc($subj_det);
                      ?>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Description</label>
                          <input type="text" class="form-control" name="description" id="description" placeholder="<?php// echo $details['subject_Desc']; ?>">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Unit/s</label>
                          <input type="text" class="form-control" name="units" id="units" placeholder="<?php// echo $details['units']; ?>">
                        </div>
                      </div>
                      <?php } ?> -->
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Name</label>
                            <select class="form-control selector-options" id="faculty" name="faculty">
                      <?php

                        if($_GET['sched'] == 'Faculty') {

                          $result = mysql_query("SELECT * FROM user_faculty");

                        } else if ($_GET['sched'] == 'Student') {

                          $result = mysql_query("SELECT * FROM user_student");

                        }

                          while ($row = mysql_fetch_array($result)) {
                      ?>
                            <option value="<?php echo $row['userID'] ?>"><?php echo $row['firstName'].' '.$row['lastName'] ?></option>
                      <?php
                        }
                      ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Room</label>
                      <?php

                        if($_GET['sched'] == 'Faculty') {

                          $result = mysql_query("SELECT * FROM setting_room");

                          echo '<select class="form-control selector-options" id="room" name="room">';
                          
                          while ($row = mysql_fetch_array($result)) 
                          {
                      ?>
                            <option value="<?php echo $row['roomName']; ?>"><?php echo $row['roomName']; ?></option>
                          
                      <?php
                          }
                          echo '</select>';

                        }
                        else if ($_GET['sched'] == 'Student') {

                          echo '<input type="text" class="form-control" name="room" id="room" placeholder="Room Name">';

                        }
                      ?>
                        </div>
                      </div>
                    <?php 
                      if ($_GET['sched'] == 'Student') {

                          echo '<div class="col-md-5">
                                  <div class="form-group">
                                    <label>Instructor</label>
                                    <input type="text" class="form-control" name="teacher" id="teacher" placeholder="Instructor">
                                  </div>
                                </div>';
                          echo '<div class="col-md-5">
                                  <div class="form-group">
                                    <label>Course / Department </label>
                                    <input type="text" class="form-control" name="course" id="course" placeholder="Course">
                                  </div>
                                </div>';

                        }
                    ?>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Time Start</label>
                          <input type="time" class="form-control" name="time_start" id="time_start" placeholder="Time Start">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Time End</label>
                          <input type="time" class="form-control"  name="time_end" id="time_end" placeholder="Time End">
                        </div>
                      </div> 
                      <div class="col-md-10">
                        <div class="form-group">
                          <label>Days</label><br>
                          <input type="checkbox" id="monday" name="days[]" value="Monday" placeholder="Days"> Monday   
                          <input type="checkbox" id="tuesday" name="days[]" value="Tuesday" placeholder="Days"> Tuesday   
                          <input type="checkbox" id="wednesday" name="days[]" value="Wednesday" placeholder="Days"> Wednesday
                          <input type="checkbox" id="thursday" name="days[]" value="Thursday" placeholder="Days"> Thursday   
                          <input type="checkbox" id="friday" name="days[]" value="Friday" placeholder="Days"> Friday   
                          <input type="checkbox" id="saturday" name="days[]" value="Saturday" placeholder="Days"> Saturday 
                        </div>
                      </div>
                   <div class="col-md-12">
                      <div class="form-group">
                      <?php
                        if(isset($_GET['edit']))
                        {
                          $_SESSION['t'] = $_GET['t'];
                      ?>
                         <input type="submit" class="btn btn-success btn-green" name="update" value="Save Schedule">
                      <?php
                        }
                        else
                        {
                      ?>
                         <input type="submit" class="btn btn-success btn-green" name="submit" value="Save Schedule">
                      <?php
                        }
                      ?>
                      </div>
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
</div>

<?php

  if(isset($_GET['edit'])) 
  {
    /*
        var code = document.getElementById("teacher").value = "'.$fetch['teacher'].'";
        var code = document.getElementById("course").value = "'.$fetch['course'].'";
    */
    $que = mysql_query("SELECT * FROM class_faculty as i, user_faculty as a WHERE i.userID=a.userID and subject_id='".$_GET['edit']."' and startClass='".$_GET['t']."'");
    $fetch = mysql_fetch_assoc($que);

    echo'
      <script>
        var code = document.getElementById("code").value = "'.$fetch['subject_id'].'";
        var code = document.getElementById("room").value = "'.$fetch['locationDescr'].'";
        var code = document.getElementById("time_start").value = "'.$fetch['startClass'].'";
        var code = document.getElementById("time_end").value = "'.$fetch['endClass'].'";
        var code = document.getElementById("faculty").value = "'.$fetch['userID'].'";
      </script>';

      $quer = mysql_query("SELECT * FROM class_faculty where subject_id='".$_GET['edit']."' and startClass='".$_GET['t']."'");
      $day = array();
      while($row = mysql_fetch_assoc($quer))
      {
          $day[]=$row["Days"];
          $show_day = $row["Days"];
          //echo $show_day;

          if($show_day == 'Monday')
          {
            echo "<script> document.getElementById('monday').checked = true; </script>";
          }
           if($show_day == 'Tuesday')
          {
            echo "<script> document.getElementById('tuesday').checked = true; </script>";
          }
           if($show_day == 'Wednesday')
          {
            echo "<script> document.getElementById('wednesday').checked = true; </script>";
          }
           if($show_day == 'Thursday')
          {
            echo "<script> document.getElementById('thursday').checked = true; </script>";
          }
           if($show_day == 'Friday')
          {
            echo "<script> document.getElementById('friday').checked = true; </script>";
          }
           if($show_day == 'Saturday')
          {
            echo "<script> document.getElementById('saturday').checked = true; </script>";
          }
          
      }
  }

?>