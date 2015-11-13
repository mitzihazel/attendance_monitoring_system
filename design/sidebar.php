<!-- Sidebar -->
  <br>
        <div id="sidebar-wrapper" style="background:#004100">
            <ul class="sidebar-nav" style="font-size:17px;">
                <li class="sidebar-brand">
                    <a href="#">
                    </a>
                </li>
                <li <?php if ($_SERVER['REQUEST_URI']=="/thesis/homepage/home.php" || $_SERVER['REQUEST_URI']=="/thesis/users/add-users.php" || $_SERVER['REQUEST_URI']=="/thesis/user-student/user-student.php" | stripos($_SERVER['REQUEST_URI'], "personal_info") !== FALSE)  echo " id=\"currentpage\""; ?>>
                    <a href="../homepage/home.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-25-parents.png" height="17" width="17">--><span class="glyphicon glyphicon-user"></span>    User Management</a>
                </li>    
                <li <?php if ($_SERVER['REQUEST_URI']=="/thesis/schedule/show-sched.php" || $_SERVER['REQUEST_URI']=="/thesis/schedule/create-schedule.php?sched=Student" || $_SERVER['REQUEST_URI']=="/thesis/schedule/create-schedule.php?sched=Faculty") echo " id=\"currentpage\""; ?>>
                    <a href="../schedule/show-sched.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-158-show-thumbnails-with-lines.png" height="17" width="17">--><span class="glyphicon glyphicon-list"></span> Schedule</a>
                </li>
                <li <?php if ($_SERVER['REQUEST_URI']=="/thesis/task/show-task.php" || $_SERVER['REQUEST_URI']=="/thesis/task/add-task.php") echo " id=\"currentpage\""; ?>>
                    <a href="../task/show-task.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-157-show-thumbnails.png" height="17" width="17">--><span class="glyphicon glyphicon-tasks"></span>    Task</a>
                </li>
                <li <?php if ($_SERVER['REQUEST_URI']=="/thesis/attendance/attendance-form.php") echo " id=\"currentpage\""; ?>>
                    <a href="../attendance/attendance-form.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-153-check.png" height="17" width="17">--><span class="glyphicon glyphicon-check"></span> Attendance</a>
                </li>
                <li <?php if ($_SERVER['REQUEST_URI']=="/thesis/report/report.php" || stripos($_SERVER['REQUEST_URI'], "ind_report.php") !== FALSE) echo " id=\"currentpage\""; ?>>
                    <a href="../report/report.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-159-show-lines.png" height="17" width="17">--><span class="glyphicon glyphicon-list-alt"></span>  Reports</a>
                </li>
                <li <?php if ($_SERVER['REQUEST_URI']=="/thesis/logs/logs.php") echo " id=\"currentpage\""; ?>>
                    <a href="../logs/logs.php"><!--<img src="../glyphicons/glyphicons/png/glyphicons-324-calculator.png" height="17" width="17">--><span class="glyphicon glyphicon-calendar"></span> LOGS</a>
                </li>
            </ul>
        </div>
  <!-- /#sidebar-wrapper -->