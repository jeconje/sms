<?php header("refresh: 10;"); ?>
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
<style>
.upload
{
  width: 10px;
  height: 180px;
}
</style>
<body>
<div id="wrapper">
  <!-- Sidebar -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Header -->
  <?php $home = 'sms/profile'; ?>
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">    
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?><?php echo $home; ?>">University Of San Jose Recoletos - Student Monitoring System</a>
    </div>

    <!-- Nagivation -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav side-nav">
        <li class="active"><a href="<?php echo base_url(); ?>sms/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
        <li><a href="<?php echo base_url(); ?>sms/calendarforstudent"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
      </ul>

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
            <li><a href="<?php echo base_url(); ?>sms/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $info['first_name'].' '.$info['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>sms/viewprofile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url(); ?>sms/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
<div id="page-wrapper">

<div class="row">

        <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="upload">
                   <img style="height:180px;width:240px" src="<?php echo $image_path; ?>"></img>
                   <br>
                  </div>
                </div>
              </div>
                <div class="panel-footer announcement-bottom">
                  <center>
                    <?php echo form_open_multipart('sms/profile'); ?>
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
      <div class="panel-heading">
          <?php echo "<b>Student Number: </b>".$student_number; ?><br>
          <?php echo "<b>Name: </b>".$first_name." ".$middle_name." ".$last_name; ?><br>
          <?php echo "<b>College: </b>" .$college; ?><br>
          <?php echo "<b>Course & Year: </b>".$course." - ".$year; ?><br>
          <?php echo "<b>Address: </b>".$address; ?><br>
          <?php echo "<b>Email Address: </b>".$email_address; ?><br>
          <?php echo "<b>Contact Number: </b>".$contact_number; ?><br>
          <?php echo "<b>Gender: </b>".$gender; ?><br>
          <?php echo "<b>Date of Birth: </b>".$date_of_birth; ?>
      </div><!-- /.panel-heading -->
    </div><!-- /.panel panel-warning -->
  </div><!-- /.col-lg-3 -->

</div><!-- /.row -->
<div class="row">
  <div class="col-lg-12" style="left: 0px; top: 0px">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="icon icon-white icon-clock"></i>
        <?php 
          date_default_timezone_set('Asia/Manila');
          $datestring = "%D %M %d, %Y - %h:%i:%s %A";
          $time = time();
        ?>
        Today&#39;s Date : <?php echo mdate($datestring, $time);?></h3>
      </div><!-- /.panel-heading" -->
      <div class="panel-body">
        <div id="morris-chart-area"></div>
      </div>
    </div><!-- /.panel panel-primary -->
  </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<div class="col-lg-4" style="right: 10px; top: -10px; width: 700px;">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="icon icon-white icon-attachment"></i> Subjects Enrolled</h3>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped tablesorter">
          <thead>
            <tr>
              <th>Subject ID </th>
              <th>Subject Description</th>
              <th>Time</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($viewStudyLoad as $value){ ?>
            <tr>
              <td><?php echo $value['offer_code']; ?></td>
              <td><?php echo $value['subject_description']; ?></td>
              <td><?php echo $value['time']; ?></td>
            </tr>       
            <?php }?>
          </tbody>
        </table>
      </div><!-- /.table-responsive -->
    </div><!-- /.panel-body -->
  </div><!-- /.panel panel-primary -->
</div><!-- /.col-lg-4 -->
</div><!-- /.page-wrapper -->

<div class="col-lg-4" style="left: 10px; top: -25px">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-clock-o"></i> Recent Activity</h3>
    </div>
    <div class="panel-body">
      <div class="list-group">
              <?php foreach($logs as $value) {   ?>

                <?php if($value['time_in'] != '00:00:00') { ?>
                  <a class="list-group-item">Login Time: <b><?php echo $value['time_in']; ?> </b></a>
                <?php } ?>   

                <?php if($value['time_out'] != '00:00:00'){?>
                  <a class="list-group-item">Logout Time: <b><?php echo $value['time_out']; ?> </b></a>
                <?php } ?>
               <?php } ?>
      <div class="text-right">
        <a href="<?php echo base_url(); ?>sms/viewlogs">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
      </div><!-- /.text-right -->
    </div><!-- /.panel-body -->
  </div><!-- /.panel panel-primary -->
</div><!-- /.col-lg-4 -->
</div><!-- /.page-wrapper -->

  </body>
</html>
