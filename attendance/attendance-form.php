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
<!-- attendance-chek form -->
<div class="col-md-20">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="account-wall">
          <form class="form-signin" method="post" action="save-attendance.php">
           <div class="col-md-20">
            <div class="form-group">
              <h3><b><center><span id="date_time"></span></center></b></h3>
              <script type="text/javascript">window.onload = date_time('date_time');</script>
            </div>
              <div class="form-group">
                <label>Enter RFID Number Here</label>
                <input type="text" class="form-control" name="rfidNo" autofocus required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" class="form-control" id="time" name="time" value="<?php echo date('h:i:s a'); ?>" readonly="readonly">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
               <input type="hidden" class="form-control" id="dateFormat" name="date" value="<?php echo date('Y-M-D'); ?>" readonly="readonly">
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="submit" class="btn btn-lg btn-primary btn-block">
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
