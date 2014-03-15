<?php //error_reporting(0); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php include ('/application/views/templates/nav.php'); ?>  
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/calendar/jquery-ui.css">
    <script src="<?php echo base_url(); ?>css/calendar/jquery-1.9.1.js"></script>
    <script src="<?php echo base_url(); ?>css/calendar/jquery-ui.js"></script>
    <script>
    $(function() {
                   $("#datepicker").datepicker({ dateFormat: 'yy-mm-dd'});
                 });
    </script> 
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
            <li><a href="<?php echo base_url(); ?>dean/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>dean/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li  class="active"><a href="<?php echo base_url(); ?>dean/calendar_dean/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
            <li><a href="<?php echo base_url(); ?>dean/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>dean/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>dean/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>dean/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    <?php echo form_open("dean/edit_calendar"); ?>

         <div class="table-responsive" align="center">
            <select class="select-style select" id="months" name="months">
                <option value="" selected="selected">--- ALL ---</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <input class="btn btn-primary" name ="submit" type="submit" value="Filter Month"/>
            <br><br><br><br>
              
              <table class="table table-hover tablesorter">
                  <thead>
                    <tr>
                      <th class="warning"><center>Date</th>
                      <th class="warning">Event</th>  
                      <th class="warning"></th>   
                      <th class="warning"></th>                  
                    </tr>
                  </thead>

                  <tbody> 
                                  
                  <?php foreach ($info as $value) { $i++;
                    ?>        
                    <tr><input type="hidden" name='id<?php echo $i; ?>' value="<?php echo $value['calendar_id']; ?>" >
                      <td><input name="date<?php echo $i; ?>" class="datepicker" value="<?php echo $value['date']; ?>" id="datepicker<?php echo $i; ?>"></td>
                      <td><input name="event<?php echo $i; ?>" value="<?php echo $value['event']; ?>" class="form-control"></td>
                      <td><input type="submit" name="update" value="Update" class="btn btn-primary"></td>
                      <td><?php echo anchor('dean/deleteEvent?id='.$value['calendar_id'], 'Delete', 'name="delete" id="$value->calendar_id" class="btn btn-danger"'); ?></td>
                    </tr>
                  <?php } ?>                               
                  </tbody>
              </table>
          <?php echo form_close(); ?>
        </div>

<script>
$('#dp5').datepicker()
  .on('changeDat  e', function(ev){
    if (ev.date.valueOf() < startDate.valueOf()){
      ....
    }
  });
</script>

  </body>
</html>