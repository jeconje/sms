<!DOCTYPE html>
<?php header("refresh: 3;") ?>
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
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?php echo base_url(); ?>parents/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>      
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
          <li><a href="<?php echo base_url(); ?>parents/calendarforparents/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
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
<div class="table-responsive">
  <table class="table table-hover tablesorter">
    <thead>
      <tr>
        <th class="warning"><center>Date</th>
        <th class="warning"><center>Name</th>
        <th class="warning">Time In/Out</th>                    
      </tr>
    </thead>
    <tbody>      
      <?php foreach($logs as $in){ ?>                  
      <tr>
        <?php if($in['time_in'] != '00:00:00'){?>
          <td><?php echo$in['date']; ?></td>
          <td><?php echo $in['last_name'].' '.$in['first_name']; ?></td>
          <td><?php echo "Time-in: ".$in['time_in'] ?></td>                                              
        <?php } ?>
      </tr>                                                                   
      <tr>
        <?php if($in['time_out'] != '00:00:00'){?>
          <td><?php echo$in['date']; ?></td>
          <td><?php echo $in['last_name'].' '.$in['first_name']; ?></td>
          <td><?php echo "Time-out: ".$in['time_out'] ?></td>                                              
        <?php } ?>
      </tr>                                                                                                     
      <?php  } ?>
    </tbody>
  </table>
          <center>
                  <?php echo $pagination; ?>

</div>
  </body>
</html>
