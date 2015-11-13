<?php session_start();
date_default_timezone_set("Asia/Hong_Kong");
  include_once("../configure/config.php");
  
  if(!isset($_SESSION['login'])){
    header('Location:../index.php');
  }

include("../design/links.php");
include("../design/navbar.php");
echo"<br>";
?>

<script type="text/javascript">
  $('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
</script>

<div id="wrapper">
  
  <?php include('../design/sidebar.php'); 
        include('../configure/config.php');
  ?>

      <div id="page-content-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                        <div class="container container">
                          <div id="content">
                            <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#faculty" aria-controls="faculty" role="tab" data-toggle="tab"><img src="../glyphicons/glyphicons/png/glyphicons-44-group.png" height="12" width="18"> Faculty</a></li>
                              <li role="presentation"><a href="#working" aria-controls="working" role="tab" data-toggle="tab"><img src="../glyphicons/glyphicons/png/glyphicons-44-group.png" height="12" width="18"> Working Students</a></li>
                            </ul>
                            <div id="my-tab-content" class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="faculty">
                                <br>
                                <a href="../schedule/create-schedule.php?sched=Faculty"><button type="button"><span class="glyphicon glyphicon-plus"></span> Add new Subject</button></a>
                                <br><br>
                                <!-- tabs for daily attendance -->
                                  <div class="container">

                                    <!-- ul start for tabs -->
                                    

                                    <!-- Tab panes -->
                                    <div class="col-sm-10 col-md-10">
                                       <div class="caption text-center">
                                        <div class="caption-location">
                                           <div class="col-lg-20">
                                              <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                      <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
                                                  </div>
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table table-bordered table-hover table-striped">
                                                              <thead>
                                                                  <tr colspan="3">
                                                                      <th>
                                                                        Subject Code
                                                                      </th>
                                                                      <th>
                                                                        Description
                                                                      </th>
                                                                      <th>
                                                                        Faculty
                                                                      </th>
                                                                      <th>
                                                                        Time
                                                                      </th>
                                                                      <th>
                                                                        Room
                                                                      </th>
                                                                      <th>
                                                                        Day
                                                                      </th>
                                                                      <th>
                                                                        Action
                                                                      </th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                              <?php

                                                                $result = mysql_query("SELECT distinct subject_id, startClass,endClass FROM class_faculty");

                                                                while ($row = mysql_fetch_array($result)) 
                                                                {

                                                                    $get = mysql_query("SELECT * FROM class_faculty where subject_id='".$row['subject_id']."' AND startClass='".$row['startClass']."' AND endClass='".$row['endClass']."'");

                                                                      $roll = mysql_fetch_assoc($get); 

                                                                        //GETTING DETAILS FROM SUBJECT MASTER
                                                                        $master = mysql_query("SELECT * FROM subject_master where subject_id = '".$roll['subject_id']."'");
                                                                        $collect = mysql_fetch_assoc($master);
                      
                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$collect['subject_code'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$collect['subject_Desc'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.subject_id ='".$row['subject_id']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($roll['startClass'])).' - '.date("h:i:s a", strtotime($roll['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$roll['locationDescr'].
                                                                                '</td>
                                                                                <td>';
                                                                                    $getDay = mysql_query("SELECT * from class_faculty where userID='".$ro['userID']."' and subject_id = '".$ro['subject_id']."' AND startClass='".$row['startClass']."' AND endClass='".$row['endClass']."' order by classID ASC");
                                                                                      while($ros = mysql_fetch_array($getDay))
                                                                                      {
                                                                                        if($ros['Days'] == 'Monday')
                                                                                        {
                                                                                          echo 'M';
                                                                                        }
                                                                                        if($ros['Days'] == 'Tuesday')
                                                                                        {
                                                                                          echo 'T';
                                                                                        }
                                                                                        if($ros['Days'] == 'Wednesday')
                                                                                        {
                                                                                          echo 'W';
                                                                                        }
                                                                                        if($ros['Days'] == 'Thursday')
                                                                                        {
                                                                                          echo 'Th';
                                                                                        }
                                                                                        if($ros['Days'] == 'Friday')
                                                                                        {
                                                                                          echo 'F';
                                                                                        }
                                                                                        if($ros['Days'] == 'Saturday')
                                                                                        {
                                                                                          echo 'S';
                                                                                        }
                                                                                      }
                                                                        echo    '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?sched=Faculty&&edit='.$roll['subject_id'].'"><img src="../glyphicons/glyphicons/png/glyphicons-151-edit.png" height="15" width="15"> </a>
                                                                                  <a href="show-sched.php?sched=Faculty&&delete='.$row['subject_id'].'"><img src="../glyphicons/glyphicons/png/glyphicons-208-remove-2.png" height="15" width="15"> </a>
                                                                                </td>
                                                                              </tr>
                                                                        ';
                                                                }

                                                              ?>
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                         </div>
                                      </div>
                                    </div>

                                  </div>

                                </div>
                                <div role="tabpanel" class="tab-pane" id="working">
                                <br>
                                <a href="../schedule/create-schedule.php?sched=Student"><button type="button"><span class="glyphicon glyphicon-plus"></span> Add new Subject</button></a>
                                <br><br>
                                <hr>

                                <!-- FORM FOR GENERATING VACANT SCHEDULES -->
                                <div class="col-sm-10">
                                  <form name="vacant" method="post" action="">
                                    <div class="table-responsive">
                                      <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                          <tr colspan="3">
                                            <td>Name</td>
                                            <td>No Of Subjects</td>
                                            <td>Action</td>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $student = mysql_query("SELECT distinct userID from class_student");

                                            while ($row = mysql_fetch_assoc($student)) 
                                            {

                                              $stud_name = mysql_query("SELECT * from user_student where userID = '".$row['userID']."'");
                                              $get_stud_name = mysql_fetch_assoc($stud_name);

                                        ?>
                                          <tr colspan="3">
                                            <td><?php echo $get_stud_name['lastName'].", ".$get_stud_name['firstName']; ?></td>

                                            <?php
                                              $countSubj = mysql_query("SELECT distinct Subject from class_student where userID = '".$row['userID']."'");
                                              
                                                $ctr = array();
                                                $c = 0;

                                                while($count = mysql_fetch_array($countSubj))
                                                {
                                                  $ctr[] = count($count['Subject']);
                                                  $c += count($count['Subject']);
                                                }
                                            ?>
                                            <td><?php echo $c; ?></td>
                                            <?php
                                              $look = mysql_query("SELECT * from stud_vacant where studID='".$row['userID']."'");
                                              
                                              if(mysql_num_rows($look) > 0)
                                              {
                                            ?>
                                              <td><a href="generate_vacant.php?id=<?php echo $row['userID']; ?>&&do=Re">Re-Generate Vacant</a></td>
                                            <?php
                                              }
                                              else
                                              {
                                            ?>
                                                <td><a href="generate_vacant.php?id=<?php echo $row['userID']; ?>">Generate Vacant</a></td>
                                            <?php  } ?>

                                          </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                      </table>
                                    </div>  
                                  </form>
                                </div>

                                <br>
                                <!-- tabs for daily attendance -->
                                  <div class="container">

                                    <!-- ul start for tabs -->
                                    <form name="searchs" method="post" action="" id="student">
                                      <div class="col-sm-4">
                                      <b>Student Name : </b> 
                                      <select name="student">
                                        <?php $query = mysql_query("SELECT * FROM user_student"); 
                                              while ($r = mysql_fetch_assoc($query))
                                                { 
                                        ?>
                                          <option value="<?php echo $r['userID']; ?>"><?php echo $r['lastName']; ?></option>
                                        <?php   } ?>
                                      </select>
                                      <b>Day :  </b>
                                      <select name="day">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                      </select>
                                      </div>
                                      <div class="col-sm-3">
                                        <input type="submit" class="btn btn-success" name="submit" value="Submit"><br><br>
                                      </div>
                                    </form>
                                    

                                    <!-- Tab panes -->
                                    <div class="col-sm-10 col-md-10">
                                       <div class="caption text-center">
                                        <div class="caption-location">
                                           <div class="col-lg-20">
                                              <div class="panel panel-default">
                                                  <div class="panel-heading">
                                                      <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
                                                  </div>
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table table-bordered table-hover table-striped">
                                                              <thead>
                                                                  <tr colspan="3">
                                                                      <th>
                                                                        Student
                                                                      </th>
                                                                      <th>
                                                                        Time
                                                                      </th>
                                                                      <th>
                                                                        Day
                                                                      </th>
                                                                      <th>
                                                                        Action
                                                                      </th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                              <?php

                                                              if(isset($_POST['submit']))
                                                              {
                                                                if(isset($_POST['student']))
                                                                {
                                                                  if(isset($_POST['day']))
                                                                  {
                                                                    $extra = extract($_POST);
                                                                    $result = mysql_query("SELECT * FROM stud_vacant where studID = '$student' and Day ='$day' order by Day, time_start ASC");
                                                                  }
                                                                }
                                                              }
                                                              else
                                                              {
                                                                $result = mysql_query("SELECT * FROM stud_vacant where Day = '".date('l')."' order by studID, Day, time_start ASC");
                                                              }
                                                                while ($row = mysql_fetch_array($result)) 
                                                                {
                      
                                                                  echo '
                                                                     
                                                                        <tr colspan="3">';
                                                                              $getName = mysql_query("Select * from stud_vacant, user_student where user_student.userID=stud_vacant.studID and stud_vacant.studID ='".$row['studID']."'");
                                                                              $ro = mysql_fetch_array($getName);
                                                                  echo    '<td>'
                                                                            .$ro['lastName'] . ", " .$ro['firstName']. " " .$ro['mi']. 
                                                                          '</td>
                                                                          <td>'
                                                                            .date("h:i:s a", strtotime($row['time_start'])).' - '.date("h:i:s a", strtotime($row['time_end'])).
                                                                          '</td>
                                                                          <td>'
                                                                              .$row['Day'].
                                                                         '</td>
                                                                          <td>
                                                                            <a href="create-schedule.php?sched=Student&&edit='.$row['vac_ID'].'"><img src="../glyphicons/glyphicons/png/glyphicons-151-edit.png" height="15" width="15"> </a>
                                                                            <a href="show-sched.php?sched=Student&&delete='.$row['vac_ID'].'"><img src="../glyphicons/glyphicons/png/glyphicons-208-remove-2.png" height="15" width="15"> </a>
                                                                          </td>
                                                                        </tr>
                                                                  ';
                                                                }

                                                              ?>
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                         </div>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
      </div>
      <!-- /#page-content-wrapper -->

</div>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>

<?php

if(isset($_GET['delete'])) 
  {

    echo'
      <script>
        var result = confirm("Want to delete?");
        if (result) {
            '.
              $que=mysql_query("DELETE FROM class_faculty where Subject='".$_GET['delete']."'")
            .'
        }
        window.location.href="show-sched.php";
      </script>'; 
  }

?>