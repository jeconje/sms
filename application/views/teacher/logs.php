
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
     <?php $home = 'teacher/profile'; ?>
     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
            <li><a href="<?php echo base_url(); ?>teacher/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li class="active"><a href="<?php echo base_url(); ?>teacher/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>teacher/calendar_teacher/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
          </ul>&nbsp;<ul class="nav navbar-nav navbar-right navbar-user">
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
            <li><a href="<?php echo base_url(); ?>teacher/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>teacher/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>teacher/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>teacher/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
<br>
<?php echo form_open('teacher/logs/'.$date); ?>
        <div class="table-responsive">
        <center>
            <!-- <select class="select-style select" id="months" name="subject">
                <option value="" selected="selected">--- ALL ---</option>                
                <?php foreach($classes as $value)  { 
                  ?>
                   <option value="<?php echo $value['subject_description']; ?>"><?php echo $subject = $value['subject_description']; ?></option>
                <?php } ?>

            </select>

            <input class="btn btn-primary" name ="submit" type="submit" value="Filter Subject"/> -->
        </center>
            <br><br><br><br>
              <table class="table table-hover tablesorter"  style="width=20px;">
                <thead>
                  <tr>
                    <th><center>Subject</th>
                    <th><center>Date</th>
                    <th><center>Name</th>
                    <th><center>Status</th>
                    <th><center></th>
                  </tr>
                </thead>                
                <tbody  align="center">                                     
                  <?php foreach($viewLogs as $value) {                         
                     
                  ?>
                  <tr>
                    <?php $date = $value['date']; $attendance_id = $value['attendance_id'] ?>                    
                    <td><?php echo $value['subject_description']; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $value['first_name']. " ". $value['last_name']; ?></td>
                    <td><?php echo $value['attendance']; ?></td>                                                                                
                    <input type = "hidden" name = "attendance_id" value="<?php echo $value['attendance_id']; ?>" />                    
                    <td><a href="<?php echo base_url(); ?>teacher/logs/<?php echo $date;?>?id=<?php echo $value['attendance_id']; ?>"><input class="btn btn-primary" name="submit" type="submit" value="Excused"/><a/></td>                    

                    
                  </tr>
                  <?php }
                      echo form_close();
                   ?>

                </tbody>
              </table>
            </div>
          </div>
  </body>
</html>
  