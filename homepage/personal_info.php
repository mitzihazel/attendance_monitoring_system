<?php include("../design/links.php"); 
include("../design/navbar.php");
echo"<br>";?>
  <div id="wrapper">

  <?php include('../design/sidebar.php'); 

  include("../configure/config.php");

  if(isset($_GET['view'])) {

    $get_info = mysql_query("SELECT * FROM user_faculty where userID='".$_GET['view']."'");
    $data = mysql_fetch_assoc($get_info);

  } else if (isset($_GET['viewer'])) {

    $get_info = mysql_query("SELECT * FROM user_student where userID='".$_GET['viewer']."'");
    $data = mysql_fetch_assoc($get_info);

  }

  

  ?>

          <div id="page-wrapper">
              <div class="container-fluid content-wrapper">
                <div class="col-md-12">
                  <!-- Page Heading -->
                  <div class="row">
                      <div class="col-lg-12">
                          <h1 class="page-header">
                              <?php echo $data['lastName'].", ".$data['firstName']; ?> <br />
                          </h1>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12">
                      <form name="adduser" action="" method="post" enctype="multipart/form-data">
                        <div class="well clearfix">
                          <div class="col-md-12">
                            <div class="form-group">
                              <a href="../homepage/home.php"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"> Back </span></a>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group profile-photo">
                              <ul class="list-unstyled">
                                <li>
                                <?php if(isset($_GET['view'])) {

                                  echo '<img src="../users/'.$data['image'].'" id="uploadPreview" height="190" width="190">';

                                } else if(isset($_GET['viewer'])) {

                                  echo '<img src="../user-student/'.$data['image'].'" id="uploadPreview" height="190" width="190">';

                                }


                                ?>
                                </li>
                                <li><i class="fa fa-fw fa-camera"></i></li>
                                <li><label>Profile Photo</label></li>
                                <li>
                                  <span class="btn btn-\info btn-file btn-green">
                                      Upload Photo <input id="uploadImage" type="file" name="fileToUpload" onchange="PreviewImage();" value="<?php echo $data['image']; ?>" />
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
                              <input type="text" class="form-control" name="userID" value="<?php echo $data['userID']; ?>" required>
                            </div>
                          </div>         
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>First Name</label>
                              <input type="text" class="form-control" name="firstname" value="<?php echo $data['firstName']; ?>" required>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>M.I</label>
                              <input type="text" class="form-control" name="mi" value="<?php echo $data['mi']; ?>">
                            </div>  
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Last Name</label>
                              <input type="text" class="form-control" name="lastname" value="<?php echo $data['lastName']; ?>" required>
                            </div>  
                          </div>
                          <div class="col-md-2">  
                            <div class="form-group">
                              <label>Birthdate</label>
                              <input type="date" class="form-control" name="birthdate" value="<?php echo $data['birthdate']; ?>">
                            </div>                                              
                          </div>
                          <div class="col-md-2">  
                            <div class="form-group">
                              <label>Age</label>
                              <input type="text" class="form-control" name="age" value="<?php echo $data['age']; ?>">
                            </div>                                              
                          </div>  
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Gender</label>
                              <select class="form-control selector-options" name="gender" value="<?php echo $data['gender']; ?>" required>
                                <option>Please select:</option>
                                <option>Female</option>
                                <option>Male</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Status</label>
                              <select class="form-control selector-options" name="status" value="<?php echo $data['status']; ?>">
                                <option>Please select:</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Widowed</option>
                                <option>Separated</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>RFID Number</label>
                              <input type="text" class="form-control" name="RFIDNo" value="<?php echo $data['rfidNo']; ?>" autofocus required>
                            </div>
                          </div> 
                          <div class="col-md-3">
                            <div class="form-group">
                              <label>User Type</label>
                              <input type="text" class="form-control" name="usrlevel" value="<?php echo $data['userType']; ?>">
                            </div>
                          </div>
                           <div class="col-md-5">
                            <div class="form-group">
                              <input type="submit" name="update" class="btn btn-success btn-green" value="Save">
                            </div>
                          </div>
                      </form>
                  </div>
                </div>
            </div>
    <!-- /#wrapper -->
<?php

    include("../configure/config.php");

      if(isset($_POST['update'])) 
      {
        //user info
        $userID = $_POST['userID'];
        $first = $_POST['firstname'];
        $last  = $_POST['lastname'];
        $mi = $_POST['mi'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $RFIDNo = $_POST['RFIDNo'];
        $usrlevel = $_POST['usrlevel'];

        //image info
        if(isset($_GET['view']))
        {
          $target_dir = "../users/uploads/";
        }
        else if(isset($_GET['viewer']))
        {
          $target_dir = "../user-student/uploads/";
        }
        
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 1000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        }
        else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                if(isset($_GET['view'])) 
                {
                  $query_upload="UPDATE user_faculty set userID='".$_POST['userID']."',lastName='".$_POST['lastname']."',firstName='".$_POST['firstname']."',mi='".$_POST['mi']."',age='".$_POST['age']."',status='".$_POST['status']."',gender='".$_POST['gender']."',userType='".$_POST['usrlevel']."',rfidNo='".$_POST['RFIDNo']."',image='".$target_file."' where userID='".$_GET['view']."'";
                  mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());
                  echo"<script>
                    alert('Updated Successfully');
                    </script>
                    <meta http-equiv='refresh' content='0;url= ../homepage/home.php'>";

                   // The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.

                }
                else if(isset($_GET['viewer'])) 
                {

                  $query_upload="UPDATE user_student set userID='".$_POST['userID']."',lastName='".$_POST['lastname']."',firstName='".$_POST['firstname']."',mi='".$_POST['mi']."',age='".$_POST['age']."',status='".$_POST['status']."',gender='".$_POST['gender']."',userType='".$_POST['usrlevel']."',rfidNo='".$_POST['RFIDNo']."',image='".$target_file."' where userID='".$_GET['viewer']."'";
                  mysql_query($query_upload) or die("error in $query_upload == ----> ".mysql_error());
                  echo"<script>
                    alert('Updated Success');
                    </script>
                    <meta http-equiv='refresh' content='0;url= ../homepage/home.php'>";

                }

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

    } // end of Submti

?>