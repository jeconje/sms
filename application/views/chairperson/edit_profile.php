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

        <?php $home = 'chairperson/profile'; ?>
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
            <li class="active"><a href="<?php echo base_url(); ?>chairperson/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>chairperson/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>chairperson/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>chairperson/calendar_chairperson"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
            <li><a href="<?php echo base_url(); ?>chairperson/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>chairperson/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>chairperson/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>chairperson/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
      
      <?php echo form_open("chairperson/edit_profile"); ?>   
      <table class="registration_form" align="center">
        <?php foreach($collegeinfo as $college) { 

          } ?>
          <?php if($college['college_id'] == $college_id) { ?>
      <br><br><br><br>
          <tr>          
          <td>Username</td>
          <td><input name="username" value="<?php echo $info['username']; ?>"  class="form-control" disabled = "true"></td>
        </tr>
        <tr>  
          <td>Name</td>
          <td>
           
            <input name="first_name" value="<?php echo $info['first_name'].' '.$info['middle_name'].' '.$info['last_name']; ?>" class="form-control" disabled = "true">
          </td>
        </tr>
 
        <td>Department</td>
            <td>               
                <input name="college" value="<?php echo $college['college_name'] ?>" class="form-control" disabled="true">
               
            </td>
        </tr> 

        <tr>
          <td>Address</td>
          <td>
            <input name="address" value="<?php echo $info['address']; ?>" class="form-control" placeholder="">
          </td>
        </tr>

        <tr>
          <td>Contact Number</td>
          <td><input name="contact_number" value="<?php echo $info['contact_number']; ?>" class="form-control" placeholder="<?php foreach($info as $row) { echo $row->contact_number;}?>"></td>
        </tr>
        
        <tr>
          <td>Date of Birth</td>
          <td>
              <?php  
              $date = $info['date_of_birth'];
              ?>
              <input name="address" value="<?php echo $date; ?>" class="form-control" disabled = "true">
          </td>
        </tr>

        <tr>
          <td></td>
          <td><?php echo validation_errors(); ?></td>
        </tr>
      <br>  
        <tr>
          <td></td>
          <td><button name = "submit" type="submit" class="btn btn-primary">Save Changes</button></td>
        </tr>
        <?php } ?>
        </table>
      <?php echo form_close(); ?>
  </div><!-- /.page-wrapper -->
</div><!-- /.wrapper -->
</body>
</html>