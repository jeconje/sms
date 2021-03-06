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
        <?php $home = 'sdpc/profile'; ?>

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
            <li><a href="<?php echo base_url(); ?>sdpc/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>sdpc/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li class="active"><a href="<?php echo base_url(); ?>sdpc/calendar_sdpc/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header"></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo "Student Development Placement Center" ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>sdpc/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>sdpc/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
<center>
  <?php echo form_open('sdpc/calendar_sdpc'); ?>
  <table>
    <tr>
      <td><input name ="date" type="text" id="datepicker" placeholder="Pick Date" class="form-control"></td>
    </tr>
    <tr>
      <td><textarea id="event" name="event" placeholder="Enter Event" class="form-control" value="" resizable="false"></textarea></td>
    </tr>
  </table>
    <br>
    <button type="submit" id="add" name="add" class="btn btn-default">Add Event</button>
    <a href='<?php echo base_url(); ?>sdpc/edit_calendar'><button type="button" class="btn btn-primary">Edit Calendar</button></a>
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

</body>
</html>