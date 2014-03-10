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
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Header -->
  <?php 
    $home = 'sms/profile'; 
    include ('/application/views/templates/header.php'); 
  ?>
<!-- Nagivation -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
  <ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo base_url(); ?>sms/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
    <li><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name; ?> <b class="icon icon-color icon-triangle-s"></b></a>
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
            <h1>Attendance</h1>
              <ol class="breadcrumb">
              <li class="active"><i class="fa fa-desktop"></i>  Stop being so tardy! Think about your parents money and effort! :( </li>
            </ol>
        </div><!-- /.row -->

<br><br>
<center>
            <div class="table-responsive" style="width:1000px;">
              <table class="table table-bordered table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="active">Subject Listing</th>
                    <th class="warning">Lates</th>
                    <th class="danger">Absences</th>
                  </tr>
                </thead>
                <tbody align="center">
                  <?php
                    foreach ($info as $value) 
                    {
                      $late = 0;
                      $absences = 0;
                  ?>    
                      <?php foreach($lates as $viewLates){
                            
                              if($viewLates['attendance'] == 'L' && $viewLates['offer_code'] == $value['offer_code'] ){
                                $late++;
                              }                              
                              if($viewLates['attendance'] == 'A' && $viewLates['offer_code'] == $value['offer_code'] ){
                                $absences++;
                              }
                      }
                       ?>
                    <tr>
                      <td>
                          <?php echo $value['subject_description']; ?>
                      </td>  
                      <td>                        
                          <?php  echo $late; ?>
                      </td>     

                      <td>
                          <?php echo $absences?>
                      </td>
                    </tr>
                   <?php } ?>
                   
                  
                </tbody>
              </table>
            </div>
          </div>
          </div>
          </div>
  </body>
</html>