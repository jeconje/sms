<!DOCTYPE html>
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

        <?php $home = 'dean/profile'; ?>
        <!-- Brand and toggle get grouped for better mobile display -->
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
            <li><a href="<?php echo base_url(); ?>dean/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li  class="active"><a href="<?php echo base_url(); ?>dean/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>dean/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>dean/calendar_dean/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">

                <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>dean/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>dean/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>dean/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
<br>
        <div class="table-responsive">
              <table class="table table-hover tablesorter"  style="width=20px;">
                <thead>
                  <tr>
                    <th><center>Dates</th>
                    <th><center></th>
                   </tr>
                </thead>

                <tbody  align="center">                  

                  <?php foreach($viewDistinctLogs as $value) {                            
                    ?>
                  <tr>                    
                    <?php $id = $value['date']; ?>
                    <td><?php echo $value['date']; ?></td>                    
                    <td><a href="<?php echo base_url(); ?>dean/logs/<?php echo $id; ?>"><input class="btn btn-primary" type="submit" value="View logs"/><a/></td>                    
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
  </body>
</html>