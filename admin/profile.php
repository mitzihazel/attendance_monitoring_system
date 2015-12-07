<?php session_start();
include("../design/links.php"); 
include("../design/navbar.php");
echo"<br>";
$now = date("Y");
?>
  <div id="wrapper">

  <?php 
  include('../design/sidebar.php');
  include('../configure/config.php'); 

  $user = $_SESSION['user'];

  $admin = mysql_query("SELECT * FROM login where username = '".$_SESSION['user']."'");

  $getUser = mysql_fetch_assoc($admin);

?>
      <div id="page-content-wrapper">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-lg-12">
                        <div class="container container">
                          <div id="content">
                            <ul class="nav nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"> Admin</a></li>
                              <li role="presentation"><a href="#room" aria-controls="room" role="tab" data-toggle="tab"> Room Master </a></li>
                              <li role="presentation"><a href="#subject" aria-controls="room" role="tab" data-toggle="tab"> Subject Master </a></li>
                              <li role="presentation"><a href="#schoolyr" aria-controls="schoolyr" role="tab" data-toggle="tab"> School Year </a></li>
                            </ul>
                            <div id="my-tab-content" class="tab-content">
                              <div class="col-sm-100 col-md-50 clearfix">
                              </div>
                                <div role="tabpanel" class="tab-pane active" id="profile">
                                    <!-- Page Heading -->
                                      <div class="col-lg-12">
                                          <h1 class="page-header">
                                             Edit Profile <br />
                                          </h1>
                                      </div>
                                      <div class="col-lg-12">
                                        <form name="adduser" action="update_admin.php" method="post" enctype="multipart/form-data">
                                          <div class="well clearfix">
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <label>Last Log out : <?php echo $getUser['timeOut']; ?></label>
                                              </div>
                                            </div>
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <label>Full Name (DEAN)</label>
                                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $getUser['Name']; ?>" required>
                                              </div>
                                            </div>
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <label>Department/Course</label>
                                                <input type="text" class="form-control" name="department" id="department" value="<?php echo $getUser['Department']; ?>" required>
                                              </div>
                                            </div> 
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" id="username" value="<?php echo $getUser['username']; ?>" required>
                                              </div>
                                            </div>
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $getUser['password']; ?>" required>
                                              </div>
                                            </div>
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm" id="confirm" value="<?php echo $getUser['password']; ?>" required>
                                              </div>
                                            </div>
                                            <div class="col-md-8">
                                              <div class="form-group">
                                                <input type="submit" name="submit" value="Update">
                                              </div>
                                            </div>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="room">
                                <br>
                                <a href="profile.php?a=room"><button type="button"><span class="glyphicon glyphicon-plus"></span> Add Room</button></a>
                                <br><br>
                                  <div class="col-lg-5">
                                    <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Rooms </h3>
                                      </div>
                                      <div class="panel-body">
                                          <div class="table-responsive">
                                              <table class="table table-bordered table-hover table-striped">
                                                  <thead>
                                                      <tr colspan="3">
                                                          <th>
                                                            Room Name
                                                          </th>
                                                          <th>
                                                            IP Address
                                                          </th>
                                                          <th>
                                                            Action
                                                          </th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                  <?php

                                                  //SAVING DETAILS TO DBASE//
                                                  if(isset($_POST['add']))
                                                  {
                                                    $a = extract(mysql_real_escape_string($_POST));
                                                    mysql_query("INSERT INTO setting_room(roomName,capacity,ip_add) VALUES ('$name','$capacity','$ip')");
                                                    echo "<script> alert('Added Successfully'); window.location.href='profile.php'; </script>";
                                                  }
                                                  else if(isset($_POST['update']))
                                                  {
                                                    $a = extract(mysql_real_escape_string($_POST));
                                                    mysql_query("UPDATE setting_room set roomName='$name', capacity='$capacity', ip_add='$ip' where roomNo='".$_GET['edit']."'");
                                                    echo "<script> alert('Updated Successfully'); window.location.href='profile.php'; </script>";
                                                  }
                                                  else if(isset($_GET['delete']))
                                                  {
                                                    $a = extract(mysql_real_escape_string($_POST));
                                                    mysql_query("DELETE FROM setting_room where roomNo='".$_GET['delete']."'");
                                                    echo "<script> alert('Deleted Successfully'); window.location.href='profile.php'; </script>";
                                                  }

                                                    $result = mysql_query("SELECT * FROM setting_room");

                                                    while ($row = mysql_fetch_array($result)) 
                                                    {

                                                      echo "<tr><td>";
                                                      echo $row['roomName'];
                                                      echo    '</td>
                                                              <td>'.$row["ip_add"].'</td>
                                                              <td>
                                                                <a href="profile.php?edit='.$row['roomNo'].'"><img src="../glyphicons/glyphicons/png/glyphicons-151-edit.png" height="15" width="15"> </a>
                                                                <a href="profile.php?delete='.$row['roomNo'].'"><img src="../glyphicons/glyphicons/png/glyphicons-208-remove-2.png" height="15" width="15"> </a>
                                                              </td>
                                                            </tr>
                                                      ';
                                                    }

                                                    if(isset($_GET['edit']))
                                                    {

                                                      $q = mysql_query("SELECT * FROM setting_room where roomNo='".$_GET['edit']."'");
                                                      $gq = mysql_fetch_assoc($q);

                                                      echo '
                                                      <form name="add" method="post" action="">
                                                        <div id="add">
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Room Name</label>
                                                                  <input type="text" class="form-control" name="name" value="'.$gq['roomName'].'" placeholder="Name">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Capacity</label>
                                                                  <input type="text" class="form-control" name="capacity" value="'.$gq['capacity'].'" placeholder="Capacity">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Room IP Address</label>
                                                                  <input type="text" class="form-control" name="ip" value="'.$gq['ip_add'].'" placeholder="Room IP Address">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <input type="submit" name="update" value="Save">
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </form>
                                                      ';
                                                      }
                                                      else if(isset($_GET['a']))
                                                      {
                                                      echo '
                                                      <form name="edit" method="post" action="">
                                                        <div id="add">
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Room Name</label>
                                                                  <input type="text" class="form-control" name="name" placeholder="Name">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Capacity</label>
                                                                  <input type="text" class="form-control" name="capacity" placeholder="Capacity">
                                                              </div>
                                                            </div
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Capacity</label>
                                                                  <input type="text" class="form-control" name="ip" placeholder="Room IP Address">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <input type="submit" name="add" value="Save">
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </form>
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
                                <div role="tabpanel" class="tab-pane fade" id="subject">
                                <br>
                                <a href="profile.php?set=subject"><button type="button"><span class="glyphicon glyphicon-plus"></span> Add Subject</button></a>
                                <br><br>
                                  <div class="col-lg-5">
                                    <div class="panel panel-default">
                                      <div class="panel-heading">
                                          <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Subjects </h3>
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
                                                            Subject Description
                                                          </th>
                                                          <th>
                                                            Unit/s
                                                          </th>
                                                          <th>
                                                            Action
                                                          </th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                  <?php

                                                  //SAVING DETAILS TO DBASE//
                                                  if(isset($_POST['save']))
                                                  {
                                                    $a = extract($_POST);
                                                    mysql_query("INSERT INTO subject_master(subject_code,subject_Desc,units) VALUES ('$code','$description','$units')");
                                                    echo "<script> alert('Added Successfully'); window.location.href='profile.php'; </script>";
                                                  }
                                                  else if(isset($_POST['update']))
                                                  {
                                                    $a = extract($_POST);
                                                    mysql_query("UPDATE subject_master set subject_code='$code',subject_Desc='$description', units='$units' where subject_id='".$_GET['update']."'");
                                                    echo "<script> alert('Updated Successfully'); window.location.href='profile.php'; </script>";
                                                  }
                                                  else if(isset($_GET['del']))
                                                  {
                                                    $a = extract($_POST);
                                                    mysql_query("DELETE FROM subject_master where subject_id='".$_GET['del']."'");
                                                    echo "<script> alert('Deleted Successfully'); window.location.href='profile.php'; </script>";
                                                  }

                                                    $result = mysql_query("SELECT * FROM subject_master");

                                                    while ($row = mysql_fetch_array($result)) 
                                                    {

                                                      echo "<tr><td>";
                                                      echo $row['subject_code'];
                                                      echo    '</td>
                                                              <td>'.$row["subject_Desc"].'</td>
                                                              <td>'.$row["units"].'</td>
                                                              <td>
                                                                <a href="profile.php?update='.$row['subject_id'].'"><img src="../glyphicons/glyphicons/png/glyphicons-151-edit.png" height="15" width="15"> </a>
                                                                <a href="profile.php?del='.$row['subject_id'].'"><img src="../glyphicons/glyphicons/png/glyphicons-208-remove-2.png" height="15" width="15"> </a>
                                                              </td>
                                                            </tr>
                                                      ';
                                                    }

                                                    if(isset($_GET['update']))
                                                    {

                                                      $q = mysql_query("SELECT * FROM subject_master where subject_id='".$_GET['edit']."'");
                                                      $gq = mysql_fetch_assoc($q);

                                                      echo '
                                                      <form name="add" method="post" action="">
                                                        <div id="add">
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Subject Name</label>
                                                                  <input type="text" class="form-control" name="code" value="'.$gq['subject_code'].'" placeholder="Subject Name">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Description</label>
                                                                  <input type="text" class="form-control" name="description" value="'.$gq['subject_Desc'].'" placeholder="Description">
                                                              </div>
                                                            </div>
                                                           <div class="col-md-3">
                                                            <div class="form-group">
                                                              <label>Units</label>
                                                             <select name="units" id="units" class="form-control selector-options">
                                                              <option value="1">1</option>
                                                              <option value="2">2</option>
                                                              <option value="3">3</option>
                                                              <option value="4">4</option>
                                                              <option value="5">5</option>
                                                             </select>
                                                            </div>
                                                          </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <input type="submit" name="update" value="Save">
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </form>
                                                      ';
                                                      }
                                                      else if(isset($_GET['set']))
                                                      {
                                                      echo '
                                                      <form name="edit" method="post" action="">
                                                        <div id="add">
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Subject Name</label>
                                                                  <input type="text" class="form-control" name="code" placeholder="Subject Name">
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <label>Description</label>
                                                                  <input type="text" class="form-control" name="description" placeholder="Description">
                                                              </div>
                                                            </div
                                                            <div class="col-md-3">
                                                              <div class="form-group">
                                                                <label>Units</label>
                                                               <select name="units" id="units" class="form-control selector-options">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                               </select>
                                                              </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                              <div class="form-group" >
                                                                <input type="submit" name="save" value="Save">
                                                              </div>
                                                            </div>
                                                        </div>
                                                      </form>
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
                                <div role="tabpanel" class="tab-pane fade" id="schoolyr">
                                <br>
                                  <form name="form" method="post" action="">
                                    <p>School Year : </p>
                                    <select name="skulyr" class="form-control">
                                      <option value=""><?php echo $now." - "; echo $now+1; ?></option>
                                    </select>
                                  <br>
                                    <p>Semester : </p>
                                    <select name="sem" class="form-control">
                                      <option value="1st">1st</option>
                                      <option value="2nd">2nd</option>
                                      <option value="summer">Summer</option>
                                    </select>
                                  </form>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
      </div>
      <!-- /#page-content-wrapper -->

