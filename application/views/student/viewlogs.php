<?php header("refresh: 3;"); ?>
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
  <?php foreach($studentinfo as $value) { } ?>
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
        <li><a href="<?php echo base_url(); ?>sms/viewstudyload"><i class="icon32 icon-color icon-compose"></i> Study Load</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewlasent"><i class="icon32 icon-red icon-clock"></i> Lates and Absences</a></li>
        <li><a href="<?php echo base_url(); ?>sms/viewParents"><i class="icon32 icon-color icon-users"></i> Trackers</a></li>
        <li><a href="<?php echo base_url(); ?>sms/calendarforstudent/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right navbar-user">
        <li class="dropdown messages-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li class="dropdown-header"><div id="notification"></div></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $value['first_name'].' '.$value['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>sms/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sms/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
    </div><!-- /.navbar-collapse -->
  </nav><!-- /.navbar navbar-inverse navbar-fixed-top--> 
    
     <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>
                  <tr>
                    <th class="warning"><center>Date</th>
                    <th class="warning">Time In/Out</th>                    
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($viewLogs as $in){     ?>                  
                  <tr>
                      <?php if($in['time_in'] != '00:00:00'){?>
                        <td><?php echo$in['date']; ?></td>
                        <td><b><?php echo "Time-in: ".$in['time_in'] ?></b></td>                                              
                        <?php } ?>
                  </tr>                                                                   
                            <tr>
                              <?php if($in['time_out'] != '00:00:00'){?>
                                <td><?php echo$in['date']; ?></td>
                                <td><b><?php echo "Time-out: ".$in['time_out'] ?></b></td>                                              
                              <?php } ?>

                            </tr>                                                                                                                        
                  <?php  }?>
                </tbody>
              </table>
               <center><?php echo $pagination; ?>
              </div>
  </body>
</html>
