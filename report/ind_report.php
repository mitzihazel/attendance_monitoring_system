<?php session_start();
date_default_timezone_set("Asia/Hong_Kong");
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
<script type="text/javascript" src="image_view.js"></script>

<div id="non-printable">

  <form name="ind_report" method="post" action="">
    <div id="wrapper">
      
      <?php include('../design/sidebar.php');

      include("../configure/config.php"); 

      //query for image and name
      if (isset($_GET['view'])) {

        $que = mysql_query("SELECT * FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$_GET['view']."'");
        $info=mysql_fetch_assoc($que);


      } else if (isset($_GET['viewer'])) {

        $que = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$_GET['viewer']."'");
        $info=mysql_fetch_assoc($que);

      }
       
      ?>
          <div id="page-content-wrapper">
                  <div class="container-fluid">
                      <div class="row">
                          <div class="col-lg-20">
                            <div class="container container">
                              <div id="content">
                                <ul class="nav nav-tabs" role="tablist">
                                <?php 
                                  if (isset($_GET['view'])) {
                                    echo '<li role="presentation" class="active"><a href="#faculty" aria-controls="faculty" role="tab" data-toggle="tab"><img src="../users/'.$info['image'].'" style="height:30px;width:30px"> '.$info['firstName'].' '.$info['lastName'].'</a></li>';
                                  }
                                  else if (isset($_GET['viewer'])) {
                                    echo '<li role="presentation" class="active"><a href="#faculty" aria-controls="faculty" role="tab" data-toggle="tab"><img src="../user-student/'.$info['image'].'" style="height:30px;width:30p"> '.$info['firstName'].' '.$info['lastName'].'</a></li>';
                                  }
                                ?>
                                  </ul>
                                   <div id="my-tab-content" class="tab-content">
                                     <div class="col-sm-100 col-md-50 clearfix">
                                     </div>

                                     <br>
                                      <div class="col-md-4">  
                                        <div class="form-group">
                                          <input type="text" name="search" class="form-control" placeholder="Search Here.. (Date / Subject / Attendance)">  <input type="submit" name="submit" value="Search">
                                        </div>                                              
                                      </div>

                                       <div role="tabpanel" class="tab-pane active" id="faculty">
                                        <br><br>
                                        <center>
                                          <?php
                                            if (isset($_GET['view'])) 
                                            {
                                              if(isset($_POST['submit']))
                                              {
                                                if($_POST['search'] == "")
                                                {
                                                  $query = mysql_query("SELECT * FROM attendance_faculty where userID='".$_GET['view']."'");
                                                }
                                                else
                                                {
                                                  $search = $_POST['search'];

                                                  $query  = mysql_query("SELECT * FROM attendance_faculty where userID='".$_GET['view']."' AND Attendance LIKE '%".$_POST['search']."%' OR date LIKE '%".$search."%'  OR subject LIKE '%".$search."%'");
                                                }
                                              }
                                              else
                                              {

                                                //query for attendance details [for the array of attendance
                                                $query = mysql_query("SELECT * FROM attendance_faculty where userID='".$_GET['view']."'");

                                              }
                                          ?>
                                             <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Action</th>
                                                      <th>Subject</th>
                                                      <th>Date</th>
                                                      <th>Time In</th>
                                                      <th>Time Out</th>
                                                      <th>Attendance</th>
                                                      <th>Total Hours Absent and Late</th>
                                                      <th>Early Time Out</th>
                                                      <th>Excuse Reason</th>
                                                      <th>Time in Image</th>
                                                      <th>Time out Image</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                    function decimalHours($time)
                                                      {
                                                          $hms = explode(":", $time);
                                                          return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
                                                      }

                                                      while($data=mysql_fetch_array($query)) {

                                                      $hms = $data['totalHour'];
                                                      $absent = $data['tardinessCount'];

                                                      $decimalHours = decimalHours($hms);
                                                      $decTardy = decimalHours($absent);
                                                      
                                                      $final = round($decimalHours,2);
                                                      $tardiness = round($decTardy,2);

                                                      $d = strtotime($data['date']);
                                                      $dd = date("l", $d);
                                                  ?>
                                                   <tr>
                                                      <td>
                                                        <a href="edit_report.php?edit=<?php echo $data['subject']; ?>&time=<?php echo $data['timeIn']; ?>&level=faculty&id=<?php echo $data['userID']; ?>"><img src="../glyphicons/glyphicons/png/glyphicons-151-edit.png" height="15" width="15"> </a>
                                                        <a href="edit_report.php?delete=<?php echo $data['subject']; ?>&time=<?php echo $data['timeIn']; ?>&level=student&id=<?php echo $data['userID']; ?>"><img src="../glyphicons/glyphicons/png/glyphicons-208-remove-2.png" height="15" width="15"> </a>
                                                      </td>
                                                      <td><?php echo $data['subject']; ?></td>
                                                      <td><?php echo $data['date']." <small>(".$dd.")</small>"; ?></td>
                                                      <td><?php $boo = strtotime($data['timeIn']); 
                                                              if ($data['timeIn'] == "00:00:00") {
                                                                echo $data['timeIn'];
                                                              }else 
                                                                echo date("h:i:s a", $boo); ?>
                                                      </td>
                                                      <td><?php $boo = strtotime($data['timeOut']); 
                                                              if ($data['timeOut'] == "00:00:00") {
                                                                echo $data['timeOut'];
                                                              }else 
                                                                echo date("h:i:s a", $boo); ?>
                                                      </td>
                                                      <td><?php echo $data['Attendance']; ?></td>
                                                      <td><?php echo $data['tardinessCount']; ?></td>
                                                      <td><?php echo $data['earlyOut']; ?></td>
                                                      <td><?php echo $data['Cause']; ?></td>
                                                      <td>
                                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo date('Y-m-d l', strtotime($data['date'])); ?>" data-caption="Taken at <?php echo $data['timeIn']; ?>" data-image="<?php echo "../attendance/".$data['image_in']; ?>" data-target="#image-gallery">
                                                        <img class="img-responsive" src="<?php echo "../attendance/".$data['image_in']; ?>" alt="Time In Image Capture" style="height:100px;width:150px">
            </a>                                      </td>
                                                      <td>
                                                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo date('Y-m-d l', strtotime($data['date'])); ?>" data-caption="Taken at <?php echo $data['timeIn']; ?>" data-image="<?php echo "../attendance/".$data['image_out']; ?>" data-target="#image-gallery">
                                                        <img class="img-responsive" src="<?php echo "../attendance/".$data['image_out']; ?>" alt="Time Out Image Capture" style="height:100px;width:150px">
            </a>                                      </td>
                                                   </tr>
                                                  <?php
                                                      }
                                                  ?>
                                                </tbody>
                                             </table>
                                          <?php
                                            }
                                            else if (isset($_GET['viewer'])) 
                                            {
                                              if(isset($_POST['submit']))
                                              {
                                                if($_POST['search'] == "")
                                                {
                                                  $query = mysql_query("SELECT * FROM attendance_student where userID='".$_GET['viewer']."'");
                                                }
                                                else
                                                {
                                                  $search = $_POST['search'];

                                                  $query  = mysql_query("SELECT * FROM attendance_student where userID = '".$_GET['viewer']."' AND Attendance LIKE '%".$_POST['search']."%' OR date LIKE '%".$search."%' OR subject LIKE '%".$search."%'");
                                                }
                                              }
                                              else
                                              {

                                                //query for attendance details [for the array of attendance
                                                $query = mysql_query("SELECT * FROM attendance_student where userID='".$_GET['viewer']."'");

                                              }
                                          ?>
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                   <tr>
                                                      <th>Action</th>
                                                      <th>Area</th>
                                                      <th>Date</th>
                                                      <th>Time In</th>
                                                      <th>Time Out</th>
                                                      <th>Attendance</th>
                                                      <th>No. Of hours Attended Class</th>
                                                      <th>Total Hours Absent and Late</th>
                                                      <th>Excuse Reason</th>
                                                      <th>Time in Image</th>
                                                      <th>Time out Image</th>
                                                   </tr>
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                    function decimalHours($time)
                                                      {
                                                          $hms = explode(":", $time);
                                                          return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
                                                      }

                                                      while($data=mysql_fetch_array($query)) {

                                                      $hms = $data['totalHour'];
                                                      $absent = $data['tardinessCount'];

                                                      $decimalHours = decimalHours($hms);
                                                      $decTardy = decimalHours($absent);
                                                      
                                                      $final = round($decimalHours,2);
                                                      $tardiness = round($decTardy,2);

                                                      $d = strtotime($data['date']);
                                                      $dd = date("l", $d);
                                                  ?>
                                                   <tr>
                                                      <td>
                                                        <a href="edit_report.php?edit=<?php echo $data['subject']; ?>&time=<?php echo $data['timeIn']; ?>&level=student&id=<?php echo $data['userID']; ?>"><span class="glyphicon glyphicon-edit"></span> </a>
                                                        <a href="edit_report.php?delete=<?php echo $data['subject']; ?>&time=<?php echo $data['timeIn']; ?>&level=student&id=<?php echo $data['userID']; ?>"><span class="glyphicon glyphicon-trash"></span> </a>
                                                      </td>
                                                      <td><?php echo $data['area']; ?></td>
                                                      <td><?php echo $data['date']." <small>(".$dd.")</small>"; ?></td>
                                                      <td><?php $boo = strtotime($data['timeIn']); 
                                                              if ($data['timeIn'] == "00:00:00") {
                                                                echo $data['timeIn'];
                                                              }else 
                                                                echo date("h:i:s a", $boo); ?>
                                                      </td>
                                                      <td><?php $boo = strtotime($data['timeOut']); 
                                                              if ($data['timeOut'] == "00:00:00") {
                                                                echo $data['timeOut'];
                                                              }else 
                                                                echo date("h:i:s a", $boo); ?>
                                                      </td>
                                                      <td><?php echo $data['Attendance']; ?></td>
                                                      <td><?php echo $data['totalHour']; ?></td>
                                                      <td><?php echo $data['tardinessCount']; ?></td>
                                                      <td><?php echo $data['Cause']; ?></td>
                                                      <td><img src="<?php echo "../attendance/".$data['image_in']; ?>" style="height:100px;width:100px"></td>
                                                      <td><img src="<?php echo "../attendance/".$data['image_out']; ?>" style="height:100px;width:100px"></td>
                                                   </tr>
                                                  <?php } ?>
                                                </tbody>
                                             </table>
                                          <?php
                                            }
                                          ?>
                                        </center>
                                       </div>
                                   </div>
                              </div>
                            </div>
                         </div>
                      </div>
                   </div>
          </div> 
    </div>
  </form>

</div>

<div id="printable">
  <center>
    <h3><img src="../logo/10374235_10152363031077171_436135685_n.gif" style="height:50px;width:50px">   Western Leyte College of Ormoc Inc.,</h3>
      <h5>A. Bonifacio St., Ormoc City, Leyte<br> Tel. Nos. (053/561 - 5310 / 255 - 8549)</h5>
  </center>
  <div class="container">

    <center><b><h3>  Detailed Report </h3></center></b></center>

  <?php
  //query for image and name
    if (isset($_GET['view'])) {

      $que = mysql_query("SELECT * FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$_GET['view']."'");
      $info=mysql_fetch_assoc($que);

      echo "<h4>Name : ".$info['lastName'].", ".$info['firstName']."</h4>";

      //query for attendance details [for the array of attendance
      $query = mysql_query("SELECT * FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$_GET['view']."'");


    } else if (isset($_GET['viewer'])) {

      $que = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$_GET['viewer']."'");
      $info=mysql_fetch_assoc($que);

      echo "<h4>Name : ".$info['lastName'].", ".$info['firstName']."</h4>";

      //query for attendance details [for the array of attendance
      $query = mysql_query("SELECT * FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$_GET['viewer']."'");


    }
    ?>
        <?php
          if (isset($_GET['view'])) 
          {
            if(isset($_POST['submit']))
              {
                $search = $_POST['search'];

                $query  = mysql_query("SELECT * FROM attendance_faculty where date LIKE '%".$search."%' or subject LIKE '%".$search."%' or Attendance LIKE '%".$search."%' and userID = '".$_GET['view']."'");

              }
              else
              {

                //query for attendance details [for the array of attendance
                $query = mysql_query("SELECT * FROM attendance_faculty where userID='".$_GET['view']."'");

              }
        ?>
           <table border="1" width="100%" class="table table-bordered table-hover table-striped">
              <thead>
                 <tr colspan="3">
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Attendance</th>
                    <th>No. Of hours Attended Class</th>
                    <th>Total Hours Absent and Late</th>
                 </tr>
              </thead>
              <tbody>
                <?php

                    while($data=mysql_fetch_array($query)) {

                    $hms = $data['totalHour'];
                    $absent = $data['tardinessCount'];

                    $decimalHours = decimalHours($hms);
                    $decTardy = decimalHours($absent);
                    
                    $final = round($decimalHours,2);
                    $tardiness = round($decTardy,2);

                    $d = strtotime($data['date']);
                    $dd = date("l", $d);
                ?>
                 <tr colspan="3">
                    <td><?php echo $data['subject']; ?></td>
                    <td><?php echo $data['date']." <small>(".$dd.")</small>"; ?></td>
                    <td><?php $boo = strtotime($data['timeIn']); echo date("h:i:s a", $boo) ?></td>
                    <td><?php $boo = strtotime($data['timeOut']); echo date("h:i:s a", $boo) ?></td>
                    <td><?php echo $data['Attendance']; ?></td>
                    <td><?php echo $final." hour/s"; ?></td>
                    <td><?php echo $tardiness." hour/s"; ?></td>
                 </tr>
                <?php } ?>
              </tbody>
           </table>
        <?php
          }
          else if (isset($_GET['viewer'])) 
          {
            if(isset($_POST['submit']))
              {
                $search = $_POST['search'];

                $query  = mysql_query("SELECT * FROM attendance_student where date LIKE '%".$search."%' or subject LIKE '%".$search."%' or Attendance LIKE '%".$search."%' and userID = '".$_GET['view']."'");

              }
              else
              {

                //query for attendance details [for the array of attendance
                $query = mysql_query("SELECT * FROM attendance_student where userID='".$_GET['view']."'");

              }
        ?>
          <table border="1" width="100%" class="table table-bordered table-hover table-striped">
              <thead>
                 <tr>
                    <th>Area</th>
                    <th>Task</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Attendance</th>
                    <th>No. Of hours Attended Class</th>
                    <th>Total Hours Absent and Late</th>
                 </tr>
              </thead>
              <tbody>
                <?php 

                    while($data=mysql_fetch_array($query)) {

                    $hms = $data['totalHour'];
                    $absent = $data['tardinessCount'];

                    $decimalHours = decimalHours($hms);
                    $decTardy = decimalHours($absent);
                    
                    $final = round($decimalHours,2);
                    $tardiness = round($decTardy,2);

                    $d = strtotime($data['date']);
                    $dd = date("l", $d);
                ?>
                 <tr>
                    <td><?php echo $data['area']; ?></td>
                    <td><?php echo $data['task']; ?></td>
                    <td><?php echo $data['date']." <small>(".$dd.")</small>"; ?></td>
                    <td><?php $boo = strtotime($data['timeIn']); echo date("h:i:s a", $boo) ?></td>
                    <td><?php $boo = strtotime($data['timeOut']); echo date("h:i:s a", $boo) ?></td>
                    <td><?php echo $data['Attendance']; ?></td>
                    <td><?php echo $final." hour/s"; ?></td>
                    <td><?php echo $tardiness." hour/s"; ?></td>
                 </tr>
                <?php } ?>
              </tbody>
           </table>
        <?php
          }
        ?>
  </div>
</div>


<!-- Modal for viewing images of attendance -->
<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="image-gallery-title"></h4>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive" src="">
            </div>
            <div class="modal-footer">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" id="show-previous-image">Previous</button>
                </div>

                <div class="col-md-8 text-justify" id="image-gallery-caption">
                    This text will be overwritten by jQuery
                </div>

                <div class="col-md-2">
                    <button type="button" id="show-next-image" class="btn btn-default">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>