<!DOCTYPE html>
<html>

  <?php include('links.php'); ?>
<body>

    <!-- Navigation for logged out-->
    <nav class="navbar navbar navbar-fixed-top" role="navigation" style="background:#005200">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           <div class="navbar-brand" style="color:white">Faculty and Working Students Attendance Monitoring System</div>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-nav navbar-right">
          <li><a href="../admin/profile.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-4-user.png" height="15" width="15">--><span class="glyphicon glyphicon-cog"></span>  Settings </a></li>
          <li><a href="../configure/logout.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-64-power.png" height="15" width="15">--><span class="glyphicon glyphicon-off"></span>  Log Out</a></li>
        </ul>
        <!-- /.navbar-collapse -->
    </nav>
    <!-- session end here -->


    </body>
</html>
