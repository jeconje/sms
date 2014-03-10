<?php error_reporting(0); ?>
<?php header("refresh: 3;"); ?>
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
      <div id="wrapper">
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php $home = 'sao/profile'; ?>

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
            <li  class="active"><a href="<?php echo base_url(); ?>sao/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>sao/add_violation_view"><i class="icon32 icon-color icon-add"></i> Add Violation</a></li>
            <li><a href="<?php echo base_url(); ?>sao/violators"><i class="icon32 icon-color icon-alert"></i> Violators</a></li>
            <li ><a href="<?php echo base_url(); ?>sao/calendar_sao"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
                <li class="message-preview">
                  <a href="#">
                    <span class="name">John Smith:</span>
                    <span class="message">Hey there, I wanted to ask you something...</span>
                    <span class="time"><i class="fa fa-clock-o"></i> 4:34 PM</span>
                  </a>
                </li>
                <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>sao/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $info['first_name'].' '.$info['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>sao/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>sao/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>

        </div><!-- /.navbar-collapse -->      

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="upload">
                      <img style="height:190px;width:250px" src="<?php echo $image_path; ?>"></img>
                  </div>
                </div>
              </div>
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                  </div>
                </div>
            </div>        
          </div>
          
          <div class="col-lg-3">
                      <div class="panel panel-warning" style="width:312px; height:200px;">
               <div class="panel-heading" style="width:310px; height:200px;">
                <?php echo "<b>Name: </b>".$first_name." ".$middle_name." ".$last_name; ?><br>
              </div>
  
            </div>
          </div>
        </div><!-- /.row -->        
        <div class="row">
          <div class="col-lg-12" style="left: 0px; top: 0px">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bar-chart-o">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </i>
                     <?php 
                  date_default_timezone_set('Asia/Manila');
                  $datestring = "%D %M %d, %Y - %h:%i:%s %A";
                  $time = time();
                ?>
                Today&#39;s Date : <?php echo mdate($datestring, $time);?></h3>
              </div>
              <div class="panel-body">
                <div id="morris-chart-area"></div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
  </body>
</html>
