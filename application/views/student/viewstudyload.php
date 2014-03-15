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
    <li><a href="<?php echo base_url(); ?>sms/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
    <li><a href="<?php echo base_url(); ?>sms/calendarforstudent/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
           <li><a href="<?php echo base_url(); ?>sms/viewprofile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url(); ?>sms/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
</div><!-- /.navbar-collapse -->
</nav>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Study Load</h1>
              <ol class="breadcrumb">
              <li class="active"><i class="fa fa-desktop"></i> Lost your study load...again? Hmmm HAHAHA</li>
            </ol>
          </div>
          <div class="col-lg-4" style="width:300px;">
            <div class="well well-sm">
               <?php
                    echo 'Student Number: '.$student_number; 
                ?>
            </div>
          </div>

          <div class="col-lg-4" style="right: -520px; width:300px;">
            <div class="well well-sm">
              Term: 2nd Sem. 2013 - 2014
            </div>
          </div>

        </div><!-- /.row -->
        <div>
          <div class="col-lg-4" style="right: 15px; width:300px; top:-12px;">
            <div class="well well-sm">
              <?php echo 'Course & Year: '.$course. '- ' .$year ?>
            </div>
          </div>
        </div>

<br><br>
            <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th>Course No.</th>
                    <th>Units</th>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Room</th>
                    <th>Offer Code</th>
                    <th>Teacher</th>
                  </tr>
                </thead>

                <tbody align="center">
                  <?php 
                      foreach($studentInfo as $value) {
                  ?>
                  <tr>
                    <td>
                      <?php echo $value['subject_code']; ?>
                    </td>        
                    <td>
                      <?php echo $value['units']; ?>
                    </td>    
                    <td>
                      <?php echo $value['days']; ?>
                    </td>    
                    <td>
                      <?php echo $value['time']; ?>
                    </td>    
                    <td>
                      <?php echo $value['room']; ?>
                    </td>    
                    <td>
                      <?php echo $value['offer_code']; ?>
                    </td>    
                    <td>
                      <?php echo $value['teacher']; ?>
                    </td>              
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div><!-- table-responsive -->
          </div> <!-- end page-wrapper -->
</div> <!-- end wrapper -->
  </body>
</html>
