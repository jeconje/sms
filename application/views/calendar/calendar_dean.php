<?php error_reporting(0); ?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php include ('/application/views/templates/nav.php'); ?>
    <!-- Date Picker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script>
    $(function() {
                   $("#datepicker").datepicker({ minDate: 0, dateFormat: 'yy-mm-dd'});
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
<center>
  <?php echo form_open('dean/calendar_dean'); ?>
  <table>
    <tr align="center">
      <td><br><select id="options">
        <option name="suspension" class="form-control" value="suspension">Suspend Classes</option>
        <option name="no_class" class="form-control" value="no_class">No Class</option>
        <option name="others" class="form-control" value="others">Others</option>
      </select></td>
    </tr>
<br>
    <tr>
      <td><input name ="date" type="text" id="datepicker" placeholder="Pick Date" class="form-control"><br></td>
    </tr>

    <tr>
      <td align="center">
      <?php
            $start = '08:00AM';
            $end = '8:59PM';
            $interval = '+1 hour';

            $start_str = strtotime($start);
            $end_str = strtotime($end);
            $now_str = $start_str;

            echo '<select name="start_time" id="start_time">';
            while($now_str <= $end_str)
            {
                echo '<option value="' . date('h:i A', $now_str) . '">' . date('h:i A', $now_str) . '</option>';
                $now_str = strtotime($interval, $now_str);
            }
            echo '</select>'; ?>
      <?php
            $start = '08:00AM';
            $end = '8:59PM';
            $interval = '+1 hour';

            $start_str = strtotime($start);
            $end_str = strtotime($end);
            $now_str = $start_str;

            echo '<select name="end_time" name="end_time">';
            while($now_str <= $end_str){
                echo '<option value="' . date('h:i A', $now_str) . '">' . date('h:i A', $now_str) . '</option>';
                $now_str = strtotime($interval, $now_str);
            }
            echo '</select>'; ?>
      </td>
    </tr>
    <br>
    <tr>
      <td><br><textarea id="event" name="event" placeholder="Enter Event" class="form-control" value="" resizable="false"></textarea></td>
    </tr>
  </table>
    <br>
    <button type="submit" id="add" name="add" class="btn btn-default">Add Event</button>
    <button type="submit" id="suspend" class="btn btn-warning">Update Event</button>
    <a href='<?php echo base_url(); ?>dean/edit_calendar'><button type="button" id="edit" class="btn btn-primary">Edit Calendar</button></a>
    <!---<button type="submit" id="delete" name="delete" class="btn btn-default">Delete Event</button>-->
</div>
      <?php echo $viewCalendar;?>
      <?php echo form_close(); ?>


<script>
$('#dp5').datepicker()
  .on('changeDate', function(ev){
    if (ev.date.valueOf() < startDate.valueOf()){
      ....
    }
  });
</script>

<script type="text/javascript">
    $('#datepicker').hide();
    $('#start_time').hide();
    $('#end_time').hide();
    $('#suspend').hide();
    $('#add').hide();
    $('#edit').hide();
    $('#event').hide();

    $('#options').on('change', function () {
      if('#options' == 'suspension') {
        $('#datepicker').show();
        $('#start_time').show();
        $('#end_time').show();
        $('#suspend').show();
        $('#add').hide();
        $('#edit').hide();
        $('#event').hide();
      }
    });
</script>

</body>
</html>