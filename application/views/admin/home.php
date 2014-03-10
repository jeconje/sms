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

<style>
.upload
{
  width: 10px;
  height: 180px;
}
</style>

<body>
    <div id="wrapper">
       <?php $home = 'profile'; ?>
      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $home ?>">University Of San Jose Recoletos - Student Monitoring System</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active"><a href="<?php echo $home ?>"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>admin/add_account"><i class="icon32 icon-color icon-book-empty"></i> Add Account</a></li>
            <li><a href="<?php echo base_url(); ?>admin/calendar"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">

            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $info['first_name'].' '.$info['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>admin/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>admin/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="upload">
                    <img style="height:190px;width:249px" src="<?php echo $image_path; ?>"></img>
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
                <?php echo "<b>Admin ID: </b>".$account_type; ?><br>
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
