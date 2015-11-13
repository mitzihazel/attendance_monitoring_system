<?php 
	include("../design/links.php");
	include("../design/navbar.php");
	include("../configure/config.php");
echo"<br>";

	if(isset($_GET['edit']))
	{
		$query = mysql_query("SELECT * FROM area_assign as a, user_student as u where a.task_id='".$_GET['edit']."' and a.studentID=u.userID");
		$get = mysql_fetch_assoc($query);
	}
	else if(isset($_GET['delete']))
	{
		$delete = mysql_query("DELETE FROM area_assign where task_id='".$_GET['delete']."'");
		echo "<script> alert('Successfully Deleted'); window.location.href='show-task.php'; </script>";
	}
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
                    Add Task <br />
                </h1>
            </div>
        </div>
          <div>
            <form name="task" method="post" action="action.php?id=<?php echo $get['userID'] ?>">   
        <!-- <div id="choicesDisplay">
                {{ choices }}
             </div> -->
                  <div class="col-md-12">
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12">
                      <div class="form-group" >
                        <label>Student Name</label>
                        <input type="text" class="form-control" name="name" placeholder="<?php echo $get['lastName']; ?>" value="<?php echo $get['userID'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Area / Location</label>
                        <input type="text" class="form-control" name="area" placeholder="<?php echo $get['area'];?>" value="<?php echo $get['area'];?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label> Position </label>
                        <select name="position" class="form-control">
                          <option value="Leader">Leader</option>
                          <option value="Assistant">Assistant</option>
                          <option value="Member">Member</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-success btn-green" name="submit" value="Save Task">
                    </div>
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
</div>

<?php

	if(isset($_POST['submit']))
	{
		$s = extract($_POST);
		$update = mysql_query("UPDATE area_assign set studentID='$name',area='$area',position='$position' where task_id='$name'");
		echo "<script> alert('Updated Successfully'); window.location.href='show-task.php'; </script>";
	}
?>