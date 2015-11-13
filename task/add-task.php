<?php include("../design/links.php");
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
                    Add Task <br />
                </h1>
            </div>
        </div>
          <div>
            <form name="task" method="post" action="task-save.php">   
        <!-- <div id="choicesDisplay">
                {{ choices }}
             </div> -->
                  <div class="col-md-12">
                    <div class="col-md-12">
                    </div>
                    <div class="col-md-12">
                      <div class="form-group" >
                        <label>Student Name</label>
                        <select class="form-control selector-options" name="student">
                          <<?php
                            include("../configure/config.php");

                             $result = mysql_query("SELECT * FROM user_student");

                              while ($row = mysql_fetch_array($result)) {
                          ?>
                                <option value="<?php echo $row['userID'] ?>"><?php echo $row['firstName'].' '.$row['lastName']?></option>
                          <?php
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Area / Location</label>
                        <input type="text" class="form-control" name="area" placeholder="Location">
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


 <!--     SEARCHING DATA REFERENCE
    <div ng-init="friends = [{name:'John', phone:'555-1276'},
                         {name:'Mary', phone:'800-BIG-MARY'},
                         {name:'Mike', phone:'555-4321'},
                         {name:'Adam', phone:'555-5678'},
                         {name:'Julie', phone:'555-8765'},
                         {name:'Juliette', phone:'555-5678'}]"></div>

          <label>Search: <input ng-model="searchText"></label>
          <table id="searchTextResults">
            <tr><th>Name</th><th>Phone</th></tr>
            <tr ng-repeat="friend in friends | filter:searchText">
              <td>{{friend.name}}</td>
              <td>{{friend.phone}}</td>
            </tr>
          </table>
          <hr>
-->