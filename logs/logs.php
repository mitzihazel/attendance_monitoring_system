<?php session_start();
  include_once("../configure/config.php");

if(!isset($_SESSION['login'])){
    header('Location:../index.php');
  }

include("../design/links.php");
include("../design/navbar.php");
echo"<br>";
?>

<style> #not{background-color:lightgreen;} #checked{background-color:lightblue;} #time{color:red;} </style>

<script type="text/javascript">
  $('#myTabs a').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
  })
</script>

<div id="wrapper">
  
  <?php include('../design/sidebar.php'); ?>

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
                              <div class="col-sm-100 col-md-50 clearfix">
                              </div>

                              <!-- TAB FOR FACULTY  -->
                                <div role="tabpanel" class="tab-pane active" id="faculty">
                                  <br>
                                  <div class="col-sm-20 col-md-15">
                                   <div class="caption text-center">
                                    <div class="caption-location">
                                       <div class="col-lg-20">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Schedule List ( <?php echo date("F-d-Y | l"); ?> ) </h3>
                                              </div>
                                              <div class="panel-body">
                                                  <div class="table-responsive">
                                                    <br>
                                                      <table class="table table-bordered table-hover table-striped">
                                                          <thead>
                                                              <tr colspan="3">
                                                                  <th>Time</th>
                                                                  <?php
                                                                    $getRoom = mysql_query("SELECT * FROM setting_room");
                                                                    while($row = mysql_fetch_assoc($getRoom))
                                                                    {
                                                                  ?>
                                                                    <th><?php echo $row['roomName']; ?></th>
                                                                  <?php
                                                                    }
                                                                  ?>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                            <?php

                                                              $now = strtotime(date("H:i:s"));
                                                              $start = strtotime("6:30:00");
                                                              $end = strtotime("7:00:00");
                                                              for($i=0;$i<27;$i++)
                                                              {
                                                                $start = strtotime("+30 minutes",$start);
                                                                $end = strtotime("+30 minutes",$end);
                                                                echo "<tr>
                                                                        <td>".date('h:i',$start)." - ".date('h:i',$end)."</td>";
                                                                //LAB 1
                                                                $getRoom = mysql_query("SELECT * FROM setting_room");
                                                                while($row = mysql_fetch_assoc($getRoom))
                                                                {
                                                                  echo "<td>";
                                                                  $query = mysql_query("SELECT * FROM user_faculty as a, class_faculty as f,subject_master as s where a.userID=f.userID and f.subject_id=s.subject_id and f.locationDescr = '".$row['roomName']."' AND f.Days = '".date('l')."'");
                                                                    while($get = mysql_fetch_assoc($query))
                                                                    {
                                                                      $a = strtotime($get['startClass']);
                                                                      $b = strtotime($get['endClass']);

                                                                      $query1 = mysql_query("SELECT * FROM attendance_faculty where timeIn BETWEEN '".$get['startClass']."' and '".$get['endClass']."' and userID='".$get['userID']."' and date LIKE '%".date('Y-m-d')."%'");
                                                                      $gets = mysql_fetch_assoc($query1); 
                                                                      
                                                                      if(mysql_num_rows($query1) > 0)
                                                                      {
                                                                        if($a == $start)
                                                                        {
                                                                           echo "<p id='checked'><b>".$get['lastName'].", ".$get['firstName']."</b><br>".$get['subject_code']."<br><small id='time'>".date("h:i a",strtotime($gets['timeIn']))."</small></p>";
                                                                        }

                                                                        if($a < $start && $b >= $end)
                                                                        {
                                                                          if($b == $end)
                                                                          {
                                                                            echo "<p id='checked'><b>".$get['lastName'].", ".$get['firstName']."</b><br>".$get['subject_code']."<br><small id='time'>".date('h:i a', strtotime($gets['timeOut']))."</small></p>";
                                                                          }
                                                                          else
                                                                          {
                                                                            echo "<p id='checked'><b>".$get['lastName'].", ".$get['firstName']."</b><br>".$get['subject_code']."</p>";
                                                                          }
                                                                        }
                                                                      }
                                                                      else
                                                                      {
                                                                        if($a == $start)
                                                                        {
                                                                           echo "<p id='not'><b>".$get['lastName'].", ".$get['firstName']."</b><br>".$get['subject_code']."</p>";
                                                                        }

                                                                        if($a < $start && $b >= $end)
                                                                        {
                                                                          if($b == $end)
                                                                          {
                                                                            echo "<p id='not'><b>".$get['lastName'].", ".$get['firstName']."</b><br>".$get['subject_code']."</p>";

                                                                            echo '<button type="button" data-toggle="modal" data-target="#myModal" data-id="'.$get['classID'].'" class="open-Modal">Excuse</button>';

                                                                            if($now > $end)
                                                                            {
                                                                              echo "<a href='../attendance/check.php?AbsentF=".$get['userID']."&subject=".$get['subject_code']."&start=".$get['startClass']."'><button>Absent</button></a>";
                                                                            }
                                                                          }
                                                                          else
                                                                          {
                                                                            echo "<p id='not'><b>".$get['lastName'].", ".$get['firstName']."</b><br>".$get['subject_code']."</p>";
                                                                          }

                                                                        }
                                                                      }
                                                                    }
                                                                    echo "</td>";
                                                                  
                                                                }
                                                                echo "</tr>";
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

                              <!-- TAB FOR Working STUDENTS -->
                                <div role="tabpanel" class="tab-pane fade" id="working">
                                  <br>
                                  <div class="col-sm-20 col-md-11">
                                   <div class="caption text-center">
                                    <div class="caption-location">
                                       <div class="col-lg-20">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Schedule List ( <?php echo date("F-d-Y | l"); ?> ) </h3>
                                              </div>
                                              <div class="panel-body">
                                                  <div class="table-responsive">
                                                    <br>
                                                      <table class="table table-bordered table-hover table-striped">
                                                          <thead>
                                                              <tr colspan="3">
                                                                  <th>Time</th>
                                                                  <?php
                                                                    $que = mysql_query("SELECT * FROM area_assign");
                                                                      while ($row = mysql_fetch_assoc($que)) 
                                                                      {
                                                                        //$assigned_to = mysql_query("SELECT * FROM user_student where userID='".$row['studentID']."'");
                                                                        //$roll = mysql_fetch_assoc($assigned_to);
                                                                  ?>
                                                                    <th><?php echo $row['area'] ?> <a data-toggle="modal" data-target="#reassign" data-id="<?php echo $row['area'] ?>" name="<?php echo $row['area'] ?>" class="open-Modal">[ Re-assign ]</a></th>
                                                                  <?php
                                                                      }
                                                                  ?>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                                <?php

                                                                  $start = strtotime("6:30:00");
                                                                  $end = strtotime("7:00:00");
                                                                  for($i=0;$i<20;$i++)
                                                                  {
                                                                    $start = strtotime("+30 minutes",$start);
                                                                    $end = strtotime("+30 minutes",$end);
                                                                    $lunch = strtotime("12:00:00");
                                                                    $after_lunch = strtotime("13:00:00");
                                                                    echo "<tr>
                                                                            <td>".date('h:i',$start)." - ".date('h:i',$end)."</td>";

                                                                    $quer = mysql_query("SELECT * from area_assign");
                                                                      while ($rows = mysql_fetch_assoc($quer)) 
                                                                      {
                                                                        echo "<td>";
                                                                          $sched = mysql_query("SELECT * FROM stud_vacant where studID ='".$rows['studentID']."' and Day ='".date('l')."' ");
                                                                            while ($dis = mysql_fetch_assoc($sched)) 
                                                                            {
                                                                              $time_s = strtotime($dis['time_start']);
                                                                              $time_e = strtotime($dis['time_end']);

                                                                              $star = date("h:i", $start);
                                                                              $en = date("h:i",$end);
                                                                              $ts = date("h:i",$time_s);
                                                                              $te = date("h:i", $time_e);
                                                                              $lun = date("h:i",$lunch);
                                                                              $aflu = date("h:i",$after_lunch);

                                                                              $user = mysql_query("SELECT * FROM user_student as u,stud_vacant as c where u.userID=c.studID AND u.userID='".$dis['studID']."'");
                                                                              $take = mysql_fetch_assoc($user);

                                                                              $query1 = mysql_query("SELECT * FROM attendance_student where timeIn BETWEEN '".$dis['time_start']."' and '".$dis['time_end']."' and userID='".$take['userID']."' and date LIKE '%".date('Y-m-d')."%'");
                                                                              $gets = mysql_fetch_assoc($query1); 
                                                                              if(mysql_num_rows($query1) > 0)
                                                                              {
                                                                                if($star == $ts)
                                                                                {
                                                                                  echo "<p id='checked'>".$take['lastName'].", ".$take['firstName']."<br><small id='time'>".date("h:i a",strtotime($gets['timeIn']))."</small></p>";
                                                                                }
                                                                                if($star < $te && $star > $ts)
                                                                                {
                                                                                  echo "<p id='checked'>".$take['lastName'].", ".$take['firstName']."</p>";
                                                                                }
                                                                                if($en == $te)
                                                                                {
                                                                                  echo "<p id='checked'><small id='time'>".date("h:i a",strtotime($gets['timeOut']))."</small></p>";
                                                                                } 
                                                                              }
                                                                              else
                                                                              {
                                                                                  if($star < $te && $star >= $ts)
                                                                                  {
                                                                                    echo "<p id='not'>".$take['lastName'].", ".$take['firstName']."</p>";
                                                                                  } 

                                                                                  if($en == $te || $en == "07:45")
                                                                                  {

                                                                                      echo '<button type="button" data-toggle="modal" data-target="#myModal" data-id="'.$dis['studID'].'" name="'.$rows['area'].'" class="open-Modal">Excuse</button>';                                                                                 
                                                                                      echo "<a href='../attendance/check.php?AbsentS=".$dis['studID']."&time=".$dis['time_start']."&day=".$dis['Day']."'><button>Absent</button></a>";
                                                                                  }
                                                                              }
                                                                          }
                                                                       
                                                                        echo "</td>";
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
      <!-- /#page-content-wrapper -->

</div>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

$(document).on("click", ".open-Modal", function () {
     var excuseID = $(this).data('id');
     var area = $(this).attr('name');
     $(".modal-body #exID").val( excuseID );
     $(".modal-body #area").val( area );
});
</script>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Excuse Reason</h4>
      </div>
      <div class="modal-body">
      
        <form name="excuse" method="post" action='../attendance/check.php?ExcuseF'>
          <input type="hidden" id="exID" name="exID">
          <input type="hidden" id="area" name="area">
          <textarea name="cause" class="form-control"></textarea>
          <input type="submit" name="submit" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Re-assign -->
<div id="reassign" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Re-Assigning Task</h4>
      </div>

      <div class="modal-body">
        <form name="reassign" method="post" action='../task/re-assign.php'>
          <input type="text" name="id" id="area" class="form-control" readonly><br>
          <label>Re-assign Task to :</label>
            <select name="stud_name" class="form-control">
              <?php
                $studs = mysql_query("SELECT * FROM user_student");
                while($rows = mysql_fetch_array($studs)){
                  print '<option value="'.$rows['userID'].'">'.$rows['lastName'].', '.$rows['firstName'].'</option>';
                }
              ?>
            </select>
          <input type="submit" name="submit" value="Submit">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php
  if(isset($_GET['load']))
  {
    echo '
        <script>
            $("#reassign").modal("show");
            var ex = "'.$_GET['load'].'";
            $(".modal-body #area").val( ex );
        </script>';

  }
?>