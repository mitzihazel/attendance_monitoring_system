<div id="non-printable">
  <div id="wrapper">
    
  <?php include('../design/sidebar.php'); ?>

    <form name="report" method="post" action="">
      <div id="page-content-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-20">
                        <div class="container container">
                          <div id="content">
                            <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#faculty" aria-controls="faculty" role="tab" data-toggle="tab"><img src="../glyphicons/glyphicons/png/glyphicons-44-group.png" height="12" width="18"> Faculty</a></li>
                              <li role="presentation"><a href="#working" aria-controls="working" role="tab" data-toggle="tab"><img src="../glyphicons/glyphicons/png/glyphicons-44-group.png" height="12" width="18"> Working Students</a></li>
                            </ul>

                              <br>
                              <div class="col-md-4">  
                                <div class="form-group">
                                  <input type="text" name="search" class="form-control" placeholder="Search Here..">  <input type="submit" name="submit" value="Search">
                                </div>                                              
                              </div>

                            <div id="my-tab-content" class="tab-content"><br>
                            
                              <div class="col-sm-100 col-md-50 clearfix">
                              </div>
                                <div role="tabpanel" class="tab-pane active" id="faculty">
                                  <br>

                                    <?php
                                      include("../configure/config.php");

                                      if(isset($_POST['submit']))
                                      {
                                        $search = $_POST['search'];

                                        $result = mysql_query("SELECT * FROM user_faculty where firstName LIKE '%".$search."%' or lastName LIKE '%".$search."%'");
                                      }
                                      else
                                      {

                                      $result = mysql_query("SELECT * FROM user_faculty");

                                      }

                                      while ($row = mysql_fetch_array($result)) 
                                      {

                                     ?>
                                    <div class="col-sm-5 col-md-5">
                                      <div class="thumbnail">
                                        <a href="">
                                          <img src="<?php echo '../users/'.$row['image']?>" style="height:150px;width:150px;">
                                        </a>
                                        <div class="caption text-left">
                                          <div class="caption-location">
                                              <h5>
                                                <?php 
                                                  echo '<b>'.$row['lastName'].', '.$row['firstName'].' '.$row['mi']. '</b><br>';
                                                  echo "<a href='ind_report.php?view=".$row['userID']."'>";

                                                  //getting total of attendance
                                                  $get = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$row['userID']."'");
                                                  $data=mysql_fetch_assoc($get);
                                                  echo "Total No. Of Attendance : ".$data['total']."<br>";

                                                  //getting total of late
                                                  $late = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$row['userID']."' and a.Attendance='Late'");
                                                  $late=mysql_fetch_assoc($late);
                                                  echo "Total No. Of Late Attendance : ".$late['total']."<br>";

                                                  //getting present
                                                  $present = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$row['userID']."' and a.Attendance='Present'");
                                                  $present=mysql_fetch_assoc($present);
                                                  echo "Total No. Of Present Attendance : ".$present['total']."<br>";

                                                  //getting Absents
                                                  $absent = mysql_query("SELECT count(*) as total FROM user_faculty as f, attendance_faculty as a where f.userID=a.userID and f.userID='".$row['userID']."' and a.Attendance='Absent'");
                                                  $absent=mysql_fetch_assoc($absent);
                                                  echo "Total No. Of Absent Attendance : ".$absent['total']."<br>";
                                                ?>
                                              </h5>
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <?php
                                      }
                                    ?>
                                  </div>
                                  <div role="tabpanel" class="tab-pane fade" id="working">
                                  <br>
                                    
                                    <?php
                                      include("../configure/config.php");

                                      if(isset($_POST['submit']))
                                      {
                                        $search = $_POST['search'];

                                        $result = mysql_query("SELECT * FROM user_student where firstName LIKE '%".$search."%' or lastName LIKE '%".$search."%'");
                                      }
                                      else
                                      {

                                      $result = mysql_query("SELECT * FROM user_student");

                                      }

                                      while ($row = mysql_fetch_array($result)) {

                                     ?>
                                    <div class="col-sm-5 col-md-5">
                                      <div class="thumbnail text-left">
                                        <a href="">
                                          <img src="<?php echo '../user-student/'.$row['image']?>" style="height:150px;width:150px">
                                        </a>
                                        <div class="caption text-left">
                                          <div class="caption-location">
                                              <h5>
                                                <?php 
                                                  echo '<b>'.$row['lastName'].', '.$row['firstName'].' '.$row['mi']. '</b><br>';
                                                  echo "<a href='ind_report.php?viewer=".$row['userID']."'>";

                                                  //getting total of attendance
                                                  $get = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$row['userID']."'");
                                                  $data=mysql_fetch_assoc($get);
                                                  echo "Total No. Of Attendance : ".$data['total']."<br>";

                                                  //getting total of late
                                                  $late = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$row['userID']."' and a.Attendance='Late'");
                                                  $late=mysql_fetch_assoc($late);
                                                  echo "Total No. Of Late Attendance : ".$late['total']."<br>";

                                                  //getting present
                                                  $present = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$row['userID']."' and a.Attendance='Present'");
                                                  $present=mysql_fetch_assoc($present);
                                                  echo "Total No. Of Present Attendance : ".$present['total']."<br>";

                                                  //getting Absents
                                                  $absent = mysql_query("SELECT count(*) as total FROM user_student as f, attendance_student as a where f.userID=a.userID and f.userID='".$row['userID']."' and a.Attendance='Absent'");
                                                  $absent=mysql_fetch_assoc($absent);
                                                  echo "Total No. Of Absent Attendance : ".$absent['total']."<br>";
                                                ?>
                                              </h5>
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <?php
                                      }
                                    ?>
                                  </div>
                                </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
      </div>
      <!-- /#page-content-wrapper -->
    </form>

  </div>
</div> <!-- non-printable-->