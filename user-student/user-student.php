<?php session_start();
  include_once("../configure/config.php");
  
  if(!isset($_SESSION['login'])){
    header('Location:design/index.php');
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
                              Add Account <br />
                          </h1>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <form name="adduser" action="user-save.php" method="post" enctype="multipart/form-data">
                        <div class="well clearfix">
                          <div class="col-md-12">
                            <div class="form-group">
                              <a href="../homepage/home.php"><img src="../glyphicons/glyphicons/png/glyphicons-211-left-arrow.png" height="15" width="15">  Back</a>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group profile-photo">
                              <ul class="list-unstyled">
                                <li>
                                  <img <img id="uploadPreview" height="190" width="190">
                                </li>
                                <li><i class="fa fa-fw fa-camera"></i></li>
                                <li><label>Profile Photo</label></li>
                                <li>
                                  <span class="btn btn-\info btn-file btn-green">
                                      Upload Photo <input id="uploadImage" type="file" name="fileToUpload" onchange="PreviewImage();" />
                                  </span>
                                </li>
                              </ul>
                            </div>     
                          </div>
                            <script type="text/javascript">
                              function PreviewImage() {
                                var oFReader = new FileReader();
                                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                                oFReader.onload = function(oFREvent) {
                                  document.getElementById("uploadPreview").src = oFREvent.target.result;
                                };
                              };
                            </script>
                          <div class="col-md-8">
                            <div class="form-group">
                              <label>User Id</label>
                              <input type="text" class="form-control" name="userID" onkeypress="return event.charCode === 0 || /\d/.test(String.fromCharCode(event.charCode));" required>
                            </div>
                          </div>         
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" name="firstname" required>
                                <span style="border-color:red" if="adduser.firstname.$dirty"></span>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>M.I</label>
                              <input type="text" class="form-control" name="mi">
                            </div>  
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" name="lastname" required>
                            </div>  
                          </div>
                          <div class="col-md-2">  
                            <div class="form-group">
                              <label>Birthdate</label>
                              <input type="date" class="form-control" name="birthdate">
                            </div>                                              
                          </div> 
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Gender</label>
                              <select class="form-control selector-options" name="gender" required>
                                <option>Please select:</option>
                                <option>Female</option>
                                <option>Male</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control selector-options" name="status">
                                <option>Please select:</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Widowed</option>
                                <option>Separated</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <div class="form-group">
                              <label>RFID Number</label>
                              <input type="text" class="form-control" name="RFIDNo" onkeypress="return event.charCode === 0 || /\d/.test(String.fromCharCode(event.charCode));" autofocus required>
                            </div>
                          </div> 
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>User Type</label>
                              <input type="text" class="form-control" value="Student" name="usrlevel" readonly>
                            </div>
                          </div>
                           <div class="col-md-5">
                            <div class="form-group">
                              <input type="submit" class="btn btn-success btn-green" value="Save">
                            </div>
                          </div>
                        </div>
                      </form>
                  </div>
                </div>
            </div>
    <!-- /#wrapper -->
