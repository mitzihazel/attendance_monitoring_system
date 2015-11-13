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
                                  <a href="../users/add-users.php"><button type="button"><img src="../glyphicons/glyphicons/png/glyphicons-7-user-add.png" height="12" width="18"> Add Faculty</button></a>
                                  <br>
                                  <h5>List of Faculty</h5>

                                    <?php
                                      include("../configure/config.php");

                                      $result = mysql_query("SELECT * FROM user_faculty");

                                      while ($row = mysql_fetch_array($result)) {
                                        
                                          
                                     ?>
                                    <div class="col-sm-2 col-md-2">
                                      <div class="thumbnail">
                                        <a href="">
                                          <img src="<?php echo '../users/'.$row['image']?>" style="height:150px;width:150px">
                                        </a>
                                        <div class="caption text-center">
                                          <div class="caption-location">
                                            <a href='personal_info.php?view=<?php echo $row['userID']; ?>'>
                                              <h5>
                                                <?php echo $row['lastName'].', '.$row['firstName'].' '.$row['mi'] ?>
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
                                  <a href="../user-student/user-student.php"><button type="button"><img src="../glyphicons/glyphicons/png/glyphicons-7-user-add.png" height="12" width="18"> Add Working Student</button></a>
                                  <br>
                                  <h5>List of Working Students</h5>
                                    
                                    <?php
                                      include("../configure/config.php");

                                      $result = mysql_query("SELECT * FROM user_student");

                                      while ($row = mysql_fetch_array($result)) {
                                        
                                          
                                     ?>
                                    <div class="col-sm-2 col-md-2">
                                      <div class="thumbnail">
                                        <a href="">
                                          <img src="<?php echo '../user-student/'.$row['image']?>" style="height:150px;width:150px">
                                        </a>
                                        <div class="caption text-center">
                                          <div class="caption-location">
                                            <a href='personal_info.php?viewer=<?php echo $row['userID']; ?>'>
                                              <h5>
                                                <?php echo $row['lastName'].', '.$row['firstName'].' '.$row['mi'] ?>
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

</div>

<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>