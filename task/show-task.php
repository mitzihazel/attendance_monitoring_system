<?php session_start();
  include_once("../configure/config.php");
  
  if(!isset($_SESSION['login'])){
    header('Location:../index.php');
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
    <br>
  <div id="page-wrapper">
      <div class="container-fluid content-wrapper">
        <div class="col-md-12">
          <div class="container">
            <!-------->
            <div class="container">
            <br>
              <a href="add-task.php"><button>Add Task</button></a>
            <br><br>
              <div class="col-sm-10 col-md-10">
                 <div class="caption text-center">
                  <div class="caption-location">
                     <div class="col-lg-20">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Task Assignments</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr colspan="3">
                                                <th>
                                                  Name
                                                </th>
                                                <th>
                                                  Area
                                                </th>
                                                <th>
                                                  Position
                                                </th>
                                                <th>
                                                  Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php 

                                                $query = mysql_query("SELECT * FROM area_assign as a, user_student as u where a.studentID=u.userID order by u.lastName ASC");
                                                while($row = mysql_fetch_array($query))
                                                {
                                                  echo "<tr><td>";
                                                  echo $row['lastName'].", ".$row['firstName']." ".$row['mi'];
                                                  echo "</td>";
                                                  echo "<td>";
                                                  echo $row['area'];
                                                  echo "</td>";
                                                  echo "<td>";
                                                  echo $row['position'];
                                                  echo "</td>";
                                                  echo "<td>";
                                                  echo '<a href="action.php?edit='.$row['task_id'].'"><img src="../glyphicons/glyphicons/png/glyphicons-151-edit.png" height="15" width="15"> </a>';
                                                  echo '<a href="action.php?delete='.$row['task_id'].'"><img src="../glyphicons/glyphicons/png/glyphicons-208-remove-2.png" height="15" width="15"> </a>';
                                                  echo "</td><tr>";
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
<!-- /#wrapper -->