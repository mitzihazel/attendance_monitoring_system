<?php session_start();
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
<style>
p {
    text-indent: 40px;
}
</style>

<div id="non-printable">
  <div id="wrapper">
    <?php include('../design/sidebar.php'); ?>
      <br>
      <div id="page-wrapper">
          <div class="container-fluid content-wrapper">
            <div class="col-md-12">
              <div class="container">
                <!-------->
                <div id="content">
                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="active"><a aria-controls="schedule" data-toggle="tab">Report</a></li>
                    </ul>
                    <div id="my-tab-content" class="tab-content">
                      <div class="tab-pane active" id="schedule">
                      <br>
                      <div class="col-md-12">
                        <div class="form-group">
                          <form name="search" method="post" action="">
                            <p>
                              <label>User Type :  </label>
                              <select name="type">
                                <option value="faculty">Faculty</option>
                                <option value="student">Working Student</option>
                              </select>
                              <label>From :  </label>
                              <input type="date" name="from" placeholder="Start Date ..(y-m-d)">
                              <label>To :  </label>
                              <input type="date" name="to" placeholder="End Date ..(y-m-d)"> 
                            </p>
                            <hr>
                            <p>
                              <div class="col-sm-1">
                                Search Here:
                              </div>
                              <div class="col-sm-3">
                                <input type="text" name="search" class="form-control" placeholder="Name">
                              </div>
                              <div class="col-sm-3">
                                <input type="submit" class="btn btn-success" name="submit" value="Submit"><br><br>
                               </div>
                            </p>
                            </form>
                        </div>
                      </div>
                        <div class="col-sm-20 col-md-11">
                           <div class="caption text-center">
                            <div class="caption-location">
                               <div class="col-lg-20">
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                      <?php
                                        if(isset($_POST['submit']))
                                        {
                                          if($_POST['from'] && $_POST['to'])
                                          {
                                      ?>
                                          <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Attendance Report ( <?php echo date("F/d/y", strtotime($_POST['from'])); ?> - <?php echo date("F/d/y", strtotime($_POST['to'])); ?>  ) </h3>
                                      <?php
                                          }
                                          else
                                          {
                                      ?>
                                          <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Attendance Report ( <?php echo date("F/d/y"); ?>  ) </h3>                                      
                                      <?php
                                          }
                                        }
                                        else
                                        {
                                      ?>
                                          <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Attendance Report </h3>   
                                      <?php
                                        }
                                      ?>                                   
                                      </div>
                                      <div class="panel-body">
                                          <div class="table-responsive">
                                            <br>
                                              <table class="table table-bordered table-hover table-striped">
                                                  <thead>
                                                   <tr>
                                                      <th>Name</th>
                                                      <th>On Time in Class</th>
                                                      <th>No. Of Absences</th>
                                                      <th>No. Of Lates</th>
                                                      <th>Excused from Class</th>
                                                      <th>Total Classes</th>
                                                   </tr>
                                                </thead>
                                                  <tbody>
                                                  <?php
                                                  //to run PHP script on submit.

                                                    if(isset($_POST['submit']))
                                                    {
                                                      $abs = array();
                                                      $abs_ctr = 0;

                                                      //check if the TYPE OF USER
                                                      if(isset($_POST['type']))
                                                      {
                                                        //TYPE
                                                        if($_POST['type'] == 'faculty')
                                                        {
                                                          $query = mysql_query("SELECT distinct u.userID FROM user_faculty as u, attendance_faculty as a where u.userID=a.userID"); 
                                                        }
                                                        else if($_POST['type'] == 'student')
                                                        {
                                                          $query = mysql_query("SELECT distinct u.userID FROM user_student as u, attendance_student as a where u.userID=a.userID order by u.lastName ASC"); 
                                                        }
                                                          
                                                      }
                                                      if($_POST['search'])
                                                      {
                                                        if($_POST['type'] == 'faculty')
                                                        {
                                                          $query = mysql_query("SELECT distinct u.userID FROM user_faculty as u, attendance_faculty as a where u.userID=a.userID and u.lastName LIKE '%".$_POST['search']."%' || u.userID=a.userID and u.firstName LIKE '%".$_POST['search']."%' order by u.lastName ASC");
                                                        }
                                                        else if($_POST['type'] == 'student')
                                                        {
                                                          $query = mysql_query("SELECT distinct u.userID user_student as u, attendance_student as a where u.userID=a.userID and u.lastName LIKE '%".$_POST['search']."%' || u.userID=a.userID and u.firstName LIKE '%".$_POST['search']."%' order by u.lastName ASC");
                                                        }
                                                      }

                                                        if(mysql_num_rows($query) > 0) 
                                                        {
                                                          /*
                                                          function decimalHours($time)
                                                          {
                                                              $hms = explode(":", $time);
                                                              return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
                                                          }            
                                                          */                
                                                          while ($rows = mysql_fetch_array($query)) 
                                                          {
                                                            /*
                                                              $hms = $rows['totalHour'];
                                                              $absent = $rows['tardinessCount'];

                                                              $decimalHours = decimalHours($hms);
                                                              $decTardy = decimalHours($absent);
                                                              
                                                              $final = round($decimalHours,2);
                                                              $tardiness = round($decTardy,2);

                                                            
                                                            
                                                              $d = strtotime($rows['date']);
                                                              $dd = date("l", $d);
                                                            */  
                                                            $ctr=0;
                                                              echo '<tr colspan="3">';
                                                                
                                                              if($_POST['type'] == 'faculty')
                                                              {
                                                                $name = mysql_query("SELECT * FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."'");     
                                                                $name=mysql_fetch_assoc($name);

                                                                echo '<td><a href="ind_report.php?view='.$rows['userID'].'">'.$name['lastName'] . ", " .$name['firstName']. " " .$name['mi']. '</a></td>';

                                                                if($_POST['from'] && $_POST['to'])
                                                                {
                                                                  $present = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Present' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $present=mysql_fetch_assoc($present);

                                                                  echo '<td>'.$present['total'].'</td>';

                                                                  $absent = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Absent' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $absent=mysql_fetch_assoc($absent); 

                                                                  echo '<td>'.$absent['total'].'</td>';

                                                                  $late = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Late' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $late=mysql_fetch_assoc($late);

                                                                  echo '<td>'.$late['total']."</td>";

                                                                  $excused = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Excuse' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $excused=mysql_fetch_assoc($excused);

                                                                  echo '<td>'.$excused['total']."</td>";

                                                                  $get = mysql_query("SELECT distinct date,subject FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  while($data=mysql_fetch_assoc($get))
                                                                  {

                                                                    $ctr += count($data['date']);
                                                                  }
                                                                  echo '<td>'.$ctr."</td>";
                                                                }
                                                                else
                                                                {
                                                                  $present = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Present' and date='".date('y-m-d')."'");
                                                                  $present=mysql_fetch_assoc($present);

                                                                  echo '<td>'.$present['total'].'</td>';

                                                                  $absent = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Absent' and date='".date('y-m-d')."'");
                                                                  $absent=mysql_fetch_assoc($absent); 

                                                                  echo '<td>'.$absent['total'].'</td>';

                                                                  $late = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Late' and date='".date('y-m-d')."'");
                                                                  $late=mysql_fetch_assoc($late);

                                                                  echo '<td>'.$late['total']."</td>";

                                                                  $excused = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Excuse' and date='".date('y-m-d')."'");
                                                                  $excused=mysql_fetch_assoc($excused);

                                                                  echo '<td>'.$excused['total']."</td>";

                                                                  $get = mysql_query("SELECT distinct date,subject FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$rows['userID']."' and date='".date('y-m-d')."'");
                                                                  while($data=mysql_fetch_assoc($get))
                                                                  {

                                                                    $ctr += count($data['date']);
                                                                  }
                                                                  echo '<td>'.$ctr."</td>";
                                                                }

                                                              }
                                                              else if($_POST['type'] == 'student')
                                                              {
                                                                $name = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."'");     
                                                                $name=mysql_fetch_assoc($name);

                                                                echo '<td><a href="ind_report.php?viewer='.$rows['userID'].'">'.$name['lastName'] . ", " .$name['firstName']. " " .$name['mi']. '</a></td>';

                                                                if($_POST['from'] && $_POST['to'])
                                                                {
                                                                  $present = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Present' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $present=mysql_fetch_assoc($present);

                                                                  echo '<td>'.$present['total'].'</td>';

                                                                  $absent = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Absent' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $absent=mysql_fetch_assoc($absent); 

                                                                  echo '<td>'.$absent['total'].'</td>';

                                                                  $late = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Late' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $late=mysql_fetch_assoc($late);

                                                                  echo '<td>'.$late['total']."</td>";

                                                                  $excused = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Excuse' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  $excused=mysql_fetch_assoc($excused);

                                                                  echo '<td>'.$excused['total']."</td>";

                                                                  $get = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.date BETWEEN '".$_POST['from']."' AND '".$_POST['to']."' order by f.lastName ASC");
                                                                  while($data=mysql_fetch_assoc($get))
                                                                  {

                                                                    $ctr += count($data['date']);
                                                                  }
                                                                  echo '<td>'.$ctr."</td>";
                                                                }
                                                                else
                                                                {
                                                                  $present = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Present' and date='".date('y-m-d')."'");
                                                                  $present=mysql_fetch_assoc($present);

                                                                  echo '<td>'.$present['total'].'</td>';

                                                                  $absent = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Absent' and date='".date('y-m-d')."'");
                                                                  $absent=mysql_fetch_assoc($absent); 

                                                                  echo '<td>'.$absent['total'].'</td>';

                                                                  $late = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Late' and date='".date('y-m-d')."'");
                                                                  $late=mysql_fetch_assoc($late);

                                                                  echo '<td>'.$late['total']."</td>";

                                                                  $excused = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and a.Attendance='Excuse' and date='".date('y-m-d')."'");
                                                                  $excused=mysql_fetch_assoc($excused);

                                                                  echo '<td>'.$excused['total']."</td>";

                                                                  $get = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$rows['userID']."' and date='".date('y-m-d')."'");
                                                                  while($data=mysql_fetch_assoc($get))
                                                                  {

                                                                    $ctr += count($data['date']);
                                                                  }
                                                                  echo '<td>'.$ctr."</td>";
                                                                }
                                                              }
                                                            ?>
                                                            <!--  <td><?php $abs_ctr; ?></td>
                                                              <td><?php //$boo = strtotime($rows['timeIn']); echo date("h:i:s a", $boo) ?></td>
                                                              <td><?php //$boo = strtotime($rows['timeOut']); echo date("h:i:s a", $boo) ?></td>
                                                              <td><?php //echo count($rows['Attendance']); ?></td>
                                                              <td><?php //echo $rows['totalHour']; ?></td>
                                                              <td><?php //echo $rows['tardinessCount']; ?></td> -->
                                                            <?php
                                                              echo  '</tr>';             
                                                          }  
                                                        }
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
  <!-- /#wrapper -->
</div>

<div id="printable">
  <center>
    <h3><img src="../logo/10374235_10152363031077171_436135685_n.gif" style="height:50px;width:50px">   Western Leyte College of Ormoc Inc.,</h3>
      <h5>A. Bonifacio St., Ormoc City, Leyte<br> Tel. Nos. (053/561 - 5310 / 255 - 8549)</h5>
  </center>
  <br>
  <div class="container">
    <?php
      $print = mysql_query("SELECT * FROM user_faculty");
    ?>
      <table class="table table-bordered table-hover table-striped">
          <thead>
            <tr colspan="3">
              <th>Name</th>
              <th>On time attendance</th>
              <th>No. Of Absences and Tardiness</th>
              <th>Total Classes</th>
            </tr>
          </thead>
          <tbody>
      <?php    while ($row = mysql_fetch_array($print)) 
              {

                $attend = mysql_query("SELECT count(*) as total FROM attendance_faculty where userID = '".$row['userID']."' and Attendance='Present' or Attendance='Late'");
                $data = mysql_fetch_assoc($attend);

                $absent = mysql_query("SELECT count(*) as total FROM attendance_faculty where userID = '".$row['userID']."' and Attendance='Absent'");
                $abs = mysql_fetch_assoc($absent);

                $total = mysql_query("SELECT count(*) as total FROM attendance_faculty where userID = '".$row['userID']."'");
                $tot = mysql_fetch_assoc($total);
      ?>
            <tr colspan="3">
              <td><?php echo $row['lastName'].", ".$row['firstName']." ".$row['mi'] ?></td>
              <td><?php echo $data['total']; ?></td>
              <td><?php echo $abs['total']; ?></td>
              <td><?php echo $tot['total']; ?></td>
            </tr>
      <?php

                }
      ?>
      </tbody>
  </table>

  </div>

</div><!-- printable -->

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>