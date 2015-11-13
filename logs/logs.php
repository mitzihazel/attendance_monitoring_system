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

                                                                            echo '<button type="button" data-toggle="modal" data-target="#myModal" data-id="'.$get['classID'].'" class="open-AddBookDialog">Excuse</button>';

                                                                            if($now > $end)
                                                                            {
                                                                              echo "<a href='../attendance/check.php?AbsentF=".$get['userID']."&&subject=".$get['subject_code']."&&start=".$get['startClass']."'><button>Absent</button></a>";
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
                                                                  ?>
                                                                    <th><?php echo $row['area'] ?></th>
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
                                                                                      echo "<a href='../attendance/check.php?AbsentS=".$dis['studID']."&&time=".$take['time_start']."'><button>Absent</button></a>";
                                                                                      echo '<button type="button" data-toggle="modal" data-target="#myModal" data-id="'.$gets['classID'].'" class="open-AddBookDialog">Excuse</button>';                                                                                 
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

$(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     $(".modal-body #bookId").val( myBookId );
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
          <input type="hidden" name="id" id="bookId" name="bookId">
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