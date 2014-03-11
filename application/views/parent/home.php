<!DOCTYPE html>
<?php //header("refresh: 3;") ?>
<?php error_reporting(0); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php include ('/application/views/templates/nav.php'); ?>
  </head>

<body>
    <div id="wrapper">
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <?php $home = 'parents/profile'; ?>

        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url(); ?><?php echo $home; ?>">University Of San Jose Recoletos - Student Monitoring System</a></div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <!-- <ul class="nav navbar-nav side-nav">
            <li  class="active"><a href="<?php echo base_url(); ?>parents/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>      
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon32 icon-color icon-document"></i><b class="caret"></b>Grades</a>
                      <ul class="dropdown-menu">

                           <?php foreach($result as $value){ ?>
                          <li><a href="<?php echo base_url(); ?>parents/viewgrades?id=<?php echo $value['account_id']; ?>"> <?php echo $value['last_name'].', '.$value['first_name']; ?></a></li>          
                          <?php } ?>
                      </ul>
            </li>
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon32 icon-color icon-compose"></i><b class="caret"></b> Study Load</a>
                      <ul class="dropdown-menu">
                          <?php foreach($result as $value){ ?>
                          <li><a href="<?php echo base_url(); ?>parents/viewstudyload?id=<?php echo $value['account_id']; ?>"> <?php echo $value['last_name'].', '.$value['first_name']; ?></a></li>          
                          <?php } ?>
                       </ul>
            </li>
             <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon32 icon-red icon-clock"></i><b class="caret"></b> Attendance</a>
                      <ul class="dropdown-menu">
                          <?php foreach($result as $value){ ?>
                          <li><a href="<?php echo base_url(); ?>parents/viewlasent?id=<?php echo $value['student_number']; ?>"> <?php echo $value['last_name'].', '.$value['first_name']; ?></a></li>          
                          <?php } ?>
                      </ul>
            </li>
          <li><a href="<?php echo base_url(); ?>parents/viewaddchild"><i class="icon32 icon-color icon-users"></i> Add Child</a></li>
          <li><a href="<?php echo base_url(); ?>parents/calendarforparents"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
        </ul> -->

            <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown messages-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header">8 New Messages</li>
            <li class="message-preview">
              <a href="#">
                <span class="name">John Smith:</span>
                <span class="message">Hey there, I wanted to ask you something... ASA NI DAPITA</span>
                <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
              </a>
            </li>
            <li class="divider"></li>
            <li class="message-preview">
              <a href="#">
                <span class="name">John Smith:</span>
                <span class="message">Hey there, I wanted to ask you something...</span>
                <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
              </a>
            </li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>parents/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>parents/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url(); ?>parents/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>parents/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
    </div><!-- /.navbar-collapse -->
  </nav> <!--/.navbar navbar-inverse navbar-fixed-top -->

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="upload">
                   <img style="height:180px;width:244px" src="<?php echo $image_path; ?>"></img>
                   <br>
                  </div>
                </div>
              </div>
                <div class="panel-footer announcement-bottom">
                  <center>
                    <?php echo form_open_multipart('parents/profile'); ?>
                          <input  type = "file" name = "userfile" /> <br>
                          <?php //echo $error; ?> 
                          <input class="btn btn-primary" type="submit" value="Upload Photo"/>
                    <?php echo form_close();?>    
                  </center>
                  <div class="row">
                  </div>
                </div>
            </div>        
          </div>
          
          <div class="col-lg-3">
            <div class="panel panel-warning" style="width:312px; height:200px;">
              <div class="panel-heading" style="width:310px; height:200px;">
                <?php echo "<b>Name: </b>".$first_name." ".$middle_name." ".$last_name; ?><br>
                <?php echo "<b>Address: </b>".$address; ?><br>
                <?php echo "<b>Contact Number: </b>".$contact_number; ?><br>
                <?php echo "<b>Email Address: </b>".$email_address; ?><br>
                <?php echo "<b>Gender: </b>".$gender; ?><br>
                <?php echo "<b>Date of Birth: </b>".$date_of_birth; ?>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12" style="left: 0px; top: 0px">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o">&nbsp;&nbsp;&nbsp;&nbsp; </i>
               <?php 
                  date_default_timezone_set('Asia/Manila');
                  $datestring = "%D %M %d, %Y - %h:%i:%s %A";
                  $time = time();
                ?> Today's Date : <?php echo mdate($datestring, $time);?></h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

        <div class="col-lg-4" style="right: 10px; top: -10px; width: 700px;">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Child </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">           
                  <?php echo form_open("parents/profile"); ?>
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th>Student ID</th>
                        <th>Name of Child</th>
                        <th>Course</th>
                        <th>Year</th>
                      </tr>
                    </thead>                    
                    <tbody>                      
                    <?php                
                    foreach($result as $value){ ?>                      
                      <tr>
                        <td><?php echo $value['student_number']; ?></td>        
                        <td><?php echo $value['last_name'].', '.$value['first_name']; ?></td>     
                        <td><?php echo $value['course']; ?></td>   
                        <td><?php echo $value['year']; ?></td>      
                      </tr>
                      <?php }?>
                    </tbody>
                  </table>
                  <?php  echo form_close(); ?>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->

        <div class="col-lg-4" style="left: 10px; top: -25px">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Activity</h3>
              </div>
              <div class="panel-body">
                <div class="list-group">
                  
                  <?php foreach($viewLogs as $value) {   ?>

                    <?php if($value['time_in'] != '00:00:00') { ?>
                      <a class="list-group-item"> <?php echo $value['first_name'];?> / Login Time: <?php echo $value['time_in']; ?></a>
                    <?php } ?>   

                    <?php if($value['time_out'] != '00:00:00'){?>
                      <a class="list-group-item"> <?php echo $value['first_name'];?> / Logout Time: <?php echo $value['time_in']; ?></a>
                    <?php } ?>
                   <?php } ?>
                </div>
                <div class="text-right">
                  <a href="<?php echo base_url(); ?>parents/viewLogs">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
    </div>
-
<script>
  var es = new EventSource("<?php echo base_url(); ?>sdpc/notification_of_parent");
  var listener = function (event) {
    var div = document.createElement("div");
    var type = event.type;
    div.appendChild(document.createTextNode(type + ": " + (type === "message" ? event.data : es.url)));
    document.body.appendChild(div);
  };
  es.addEventListener("open", listener);
  es.addEventListener("message", listener);
  es.addEventListener("error", listener);
</script>

  </body>
</html>
