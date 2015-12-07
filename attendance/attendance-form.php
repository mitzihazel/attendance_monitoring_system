<style type="text/css">
body{
  margin:0;
padding:0;
}
.img
    { background:#ffffff;
    padding:12px;
    border:1px solid #999999; }
.shiva{
 -moz-user-select: none;
    background: #2A49A5;
    border: 1px solid #082783;
    box-shadow: 0 1px #4C6BC7 inset;
    color: white;
    padding: 3px 5px;
    text-decoration: none;
    text-shadow: 0 -1px 0 #082783;
    font: 12px Verdana, sans-serif;}
</style>

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
<script type="text/javascript" src="webcam.js"></script>
<div id="wrapper">
  <?php include('../design/sidebar.php'); ?>
    <br>
<!-- attendance-chek form -->
<div class="col-md-20">
  <div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="account-wall">
          <form enctype="multipart/form-data" class="form-signin" method="post" action="save-attendance.php" onsubmit="take_snapshot()">
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
            <script language="JavaScript">
                document.write( webcam.get_html(393, 230) );
            </script>
            <div id="img" style="height:800px; width:393px; float:left; margin-left:0px; margin-top:20px; border:1px">
            <input type=button value="Configure Camera Settings" onClick="webcam.configure()" class="btn btn-lg btn-primary btn-block">
          </div>
        </form>
    </div>
  </div>
</div>



<script  type="text/javascript">
      webcam.set_api_url( 'save-attendance.php' );
      webcam.set_quality( 90 ); // JPEG quality (1 - 100)
      webcam.set_shutter_sound( true ); // play shutter click sound
      webcam.set_hook( 'onComplete', 'my_completion_handler' );

    function take_snapshot(){
      // take snapshot and upload to server
      document.getElementById('img').innerHTML = '<h1>Uploading...</h1>';
      
      webcam.snap();
    }

    function my_completion_handler(msg) {
      // extract URL out of PHP output
      if (msg.match(/(http\:\/\/\S+)/)) {
        // show JPEG image in page
        
        document.getElementById('img').innerHTML ='<h3>Upload Successfuly done</h3>'+msg;
           
        document.getElementById('img').innerHTML ="<img src="+msg+" class=\"img\">";
        
      
        // reset camera for another shot
        webcam.reset();
      }
      else {alert("Error occured we are trying to fix now: " + msg); }
    }
  </script>