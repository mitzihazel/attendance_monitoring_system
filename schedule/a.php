<ul class="nav nav-tabs" role="tablist">
                                      <li role="presentation" class="active"><a href="#Monday" aria-controls="monday" role="tab" data-toggle="tab"> Monday</a></li>
                                      <li role="presentation"><a href="#Tuesday" aria-controls="tuesday" role="tab" data-toggle="tab"> Tuesday</a></li>
                                      <li role="presentation"><a href="#Wednesday" aria-controls="wednesday" role="tab" data-toggle="tab"> Wednesday</a></li>
                                      <li role="presentation"><a href="#Thursday" aria-controls="thursday" role="tab" data-toggle="tab"> Thursday</a></li>
                                      <li role="presentation"><a href="#Friday" aria-controls="friday" role="tab" data-toggle="tab"> Friday</a></li>
                                      <li role="presentation"><a href="#Saturday" aria-controls="saturday" role="tab" data-toggle="tab"> Saturday</a></li>
                                    </ul>

                                    <div id="my-tab-content" class="tab-content">
                                    <br>
                                      <div role="tabpanel" class="tab-pane active" id="Monday">
                                        <div class="col-sm-10 col-md-10">
                                             <div class="caption text-center">
                                              <div class="caption-location">
                                                 <div class="col-lg-20">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
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
                                                                              Description
                                                                            </th>
                                                                            <th>
                                                                              Faculty
                                                                            </th>
                                                                            <th>
                                                                              Time
                                                                            </th>
                                                                            <th>
                                                                              Room
                                                                            </th>
                                                                            <th>
                                                                              Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php

                                                                      $result = mysql_query("SELECT * FROM class_faculty where Days='Monday'");

                                                                      while ($row = mysql_fetch_array($result)) {

                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$row['Subject'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['Description'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.userID ='".$row['userID']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($row['startClass'])).' - '.date("h:i:s a", strtotime($row['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['locationDescr'].
                                                                                '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?edit='.$row['Subject'].'"><span class="glyphicon glyphicon-edit"></span> </a>
                                                                                  <a href="show-sched.php?delete='.$row['Subject'].'" onclick="return confirm("Are you sure?") "><span class="glyphicon glyphicon-trash"></span> </a>
                                                                                </td>
                                                                              </tr>
                                                                           
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
                                          </div>
                                        </div>
                                      </div>
                                      <div role="tabpanel" class="tab-pane fade" id="Tuesday">
                                        <div class="col-sm-10 col-md-10">
                                             <div class="caption text-center">
                                              <div class="caption-location">
                                                 <div class="col-lg-20">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
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
                                                                              Description
                                                                            </th>
                                                                            <th>
                                                                              Faculty
                                                                            </th>
                                                                            <th>
                                                                              Time
                                                                            </th>
                                                                            <th>
                                                                              Room
                                                                            </th>
                                                                            <th>
                                                                              Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php

                                                                      $result = mysql_query("SELECT * FROM class_faculty where Days='Tuesday'");

                                                                      while ($row = mysql_fetch_array($result)) {

                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$row['Subject'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['Description'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.userID ='".$row['userID']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($row['startClass'])).' - '.date("h:i:s a", strtotime($row['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['locationDescr'].
                                                                                '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?edit='.$row['Subject'].'"><span class="glyphicon glyphicon-edit"></span> </a>
                                                                                  <a href="show-sched.php?delete='.$row['Subject'].'"><span class="glyphicon glyphicon-trash"></span> </a>
                                                                                </td>
                                                                              </tr>
                                                                           
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
                                            </div>
                                          </div>
                                      </div>
                                      <div role="tabpanel" class="tab-pane fade" id="Wednesday">
                                        <div class="col-sm-10 col-md-10">
                                             <div class="caption text-center">
                                              <div class="caption-location">
                                                 <div class="col-lg-20">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
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
                                                                              Description
                                                                            </th>
                                                                            <th>
                                                                              Faculty
                                                                            </th>
                                                                            <th>
                                                                              Time
                                                                            </th>
                                                                            <th>
                                                                              Room
                                                                            </th>
                                                                            <th>
                                                                              Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php

                                                                      $result = mysql_query("SELECT * FROM class_faculty where Days='Wednesday'");

                                                                      while ($row = mysql_fetch_array($result)) {

                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$row['Subject'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['Description'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.userID ='".$row['userID']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($row['startClass'])).' - '.date("h:i:s a", strtotime($row['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['locationDescr'].
                                                                                '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?edit='.$row['Subject'].'"><span class="glyphicon glyphicon-edit"></span> </a>
                                                                                  <a href="show-sched.php?delete='.$row['Subject'].'"><span class="glyphicon glyphicon-trash"></span> </a>
                                                                                </td>
                                                                              </tr>
                                                                           
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
                                            </div>
                                          </div> 
                                      </div>
                                      <div role="tabpanel" class="tab-pane fade" id="Thursday">
                                          <div class="col-sm-10 col-md-10">
                                             <div class="caption text-center">
                                              <div class="caption-location">
                                                 <div class="col-lg-20">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
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
                                                                              Description
                                                                            </th>
                                                                            <th>
                                                                              Faculty
                                                                            </th>
                                                                            <th>
                                                                              Time
                                                                            </th>
                                                                            <th>
                                                                              Room
                                                                            </th>
                                                                            <th>
                                                                              Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php

                                                                      $result = mysql_query("SELECT * FROM class_faculty where Days='Thursday'");

                                                                      while ($row = mysql_fetch_array($result)) {

                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$row['Subject'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['Description'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.userID ='".$row['userID']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($row['startClass'])).' - '.date("h:i:s a", strtotime($row['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['locationDescr'].
                                                                                '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?edit='.$row['Subject'].'"><span class="glyphicon glyphicon-edit"></span> </a>
                                                                                  <a href="show-sched.php?delete='.$row['Subject'].'"><span class="glyphicon glyphicon-trash"></span> </a>
                                                                                </td>
                                                                              </tr>
                                                                           
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
                                            </div>
                                          </div>
                                      </div>
                                      <div role="tabpanel" class="tab-pane fade" id="Friday">
                                        
                                        <div class="col-sm-10 col-md-10">
                                             <div class="caption text-center">
                                              <div class="caption-location">
                                                 <div class="col-lg-20">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
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
                                                                              Description
                                                                            </th>
                                                                            <th>
                                                                              Faculty
                                                                            </th>
                                                                            <th>
                                                                              Time
                                                                            </th>
                                                                            <th>
                                                                              Room
                                                                            </th>
                                                                            <th>
                                                                              Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php

                                                                      $result = mysql_query("SELECT * FROM class_faculty where Days='Friday'");

                                                                      while ($row = mysql_fetch_array($result)) {

                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$row['Subject'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['Description'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.userID ='".$row['userID']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($row['startClass'])).' - '.date("h:i:s a", strtotime($row['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['locationDescr'].
                                                                                '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?edit='.$row['Subject'].'"><span class="glyphicon glyphicon-edit"></span> </a>
                                                                                  <a href="show-sched.php?delete='.$row['Subject'].'"><span class="glyphicon glyphicon-trash"></span> </a>
                                                                                </td>
                                                                              </tr>
                                                                           
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
                                            </div>
                                          </div>
                                      </div>
                                      <div role="tabpanel" class="tab-pane fade" id="Saturday">
                                        
                                        <div class="col-sm-10 col-md-10">
                                             <div class="caption text-center">
                                              <div class="caption-location">
                                                 <div class="col-lg-20">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> List of Schedules</h3>
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
                                                                              Description
                                                                            </th>
                                                                            <th>
                                                                              Faculty
                                                                            </th>
                                                                            <th>
                                                                              Time
                                                                            </th>
                                                                            <th>
                                                                              Room
                                                                            </th>
                                                                            <th>
                                                                              Action
                                                                            </th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php

                                                                      $result = mysql_query("SELECT * FROM class_faculty where Days='Saturday'");

                                                                      while ($row = mysql_fetch_array($result)) {

                                                                        echo '
                                                                           
                                                                              <tr colspan="3">
                                                                                <td>'
                                                                                  .$row['Subject'].
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['Description'].
                                                                                '</td>';
                                                                                    $getName = mysql_query("Select * from class_faculty, user_faculty where user_faculty.userID=class_faculty.userID and class_faculty.userID ='".$row['userID']."'");
                                                                                    $ro = mysql_fetch_array($getName);
                                                                        echo    '<td>'
                                                                                  .$ro['lastName'] . "," .$ro['firstName']. " " .$ro['mi']. 
                                                                                '</td>
                                                                                <td>'
                                                                                  .date("h:i:s a", strtotime($row['startClass'])).' - '.date("h:i:s a", strtotime($row['endClass'])).
                                                                                '</td>
                                                                                <td>'
                                                                                  .$row['locationDescr'].
                                                                                '</td>
                                                                                <td>
                                                                                  <a href="create-schedule.php?edit='.$row['Subject'].'"><span class="glyphicon glyphicon-edit"></span> </a>
                                                                                  <a href="show-sched.php?delete='.$row['Subject'].'"><span class="glyphicon glyphicon-trash"></span> </a>
                                                                                </td>
                                                                              </tr>
                                                                           
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
                                            </div>
                                          </div>
                                      </div>
                                    </div>