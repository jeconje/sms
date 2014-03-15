<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - parents</title>
    <?php include ('/application/views/templates/nav.php'); ?>
  </head>

<body>
<div id="wrapper">
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Header -->
  <?php 
    $home = 'parents/profile'; 
    include ('/application/views/templates/header.php'); 
  ?>
<!-- Nagivation -->
<div class="collapse navbar-collapse navbar-ex1-collapse">
  <ul class="nav navbar-nav side-nav">
    <li><a href="<?php echo base_url(); ?>parents/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
    <li><a href="<?php echo base_url(); ?>parents/viewgrades"><i class="icon32 icon-color icon-document"></i> Grades</a></li>
    <li><a href="<?php echo base_url(); ?>parents/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
    <li class="active"><a href="<?php echo base_url(); ?>parents/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
    <li><a href="<?php echo base_url(); ?>parents/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
    <li><a href="<?php echo base_url(); ?>parents/calendarforparent/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
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
            <li><a href="<?php echo base_url(); ?>parents/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name; ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
           <li><a href="<?php echo base_url(); ?>parents/viewprofile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url(); ?>parents/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>parents/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
</div><!-- /.navbar-collapse -->
         
         

</nav>
      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-12">
            <h1>Attendance Logs</h1>
        </div><!-- /.row -->
  <?php print_r($viewLogs); ?>
<br><br>
<center>
      <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="warning">Subject</th>
                    <th class="warning"><center>Day</th>    
                    <th class="warning"><center>Date</th>
                    <th class="warning">Status</th>                                     
                  </tr>
                </thead>
                <tbody>
                
                  <?php foreach($viewLogs as $view){     ?>                  
                  <tr>
                      <td><?php echo $view['subject_description']; ?></td> 
                      <td><?php echo $view['days']; ?></td>      
                      <td><?php echo $view['date']; ?></td>    
                      <td><?php echo $view['attendance']; ?></td>                            
                  </tr>                                                                                                                        
                  <?php  }?>
                </tbody>
              </table>
                               <center>
                  <?php echo $pagination; ?>
              </div>
  </body>
</html>