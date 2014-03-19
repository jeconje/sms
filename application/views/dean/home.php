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
            <li class="active"><a href="<?php echo base_url(); ?>dean/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>dean/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
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

        <div id="page-wrapper">
        <div class="row">
          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="upload">
                   <img style="height:180px;width:240px" src="<?php echo $image_path; ?>"></img>
                   <br>
                  </div>
                </div>
              </div>
                <div class="panel-footer announcement-bottom">
                  <center>
                    <?php echo form_open_multipart('dean/profile'); ?>
                          <input  type = "file" name = "userfile" /> <br>
                          <?php //echo $error; ?> 
                          <input class="btn btn-primary" type="submit" value="Upload Photo"/>
                    <?php echo form_close();?>    
                  </center>
                  <div class="row">
                  </div>
                </div>
            </div>        
          </div>
          
          <div class="col-lg-3">
           <div class="panel panel-warning" style="width:312px; height:200px;">
            
               <div class="panel-heading" style="width:310px; height:200px;">
                <?php echo "<b>Faculty ID: </b>".$faculty_id; ?><br>
                <?php echo "<b>Name: </b>".$first_name." ".$middle_name." ".$last_name; ?><br>
                <?php echo "<b>Department: </b>" .$college_desc; ?><br>
                <?php echo "<b>Address: </b>".$address; ?><br>
                <?php echo "<b>Contact Number: </b>".$contact_number; ?><br>
                <?php echo "<b>Date of Birth: </b>".$date_of_birth; ?>
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

  <div class="col-lg-4" style="right: 13px; top: -10px; width: 1100px;">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money"></i> Class Schedule </h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                     <thead>
                      <tr>
                        <th> Offer Code </th>
                        <th> Subject Description </th>
                        <th> Start Time </th>
                        <th> End Time </th>
                        <th> Day </th>
                        <th> Room </th>
                        <th> Enrollees </th>
                        <th>  </th>
                        <th>  </th>
                      </tr>
                    </thead>
                    <tbody>                                       
                   <?php                                  
                    foreach($classes as $value) {
                      $count = 0;
                          foreach($students_load as $load)
                          {
                              if($load['offer_code'] == $value['offer_code'])                             
                                $count++;
                          };       
                    ?>
                  <tr>
                    <td><?php echo $value['offer_code']; ?></td>  
                    <td><?php echo $value['subject_description']; ?></td>
                    <td><?php echo $value['start_time']; ?></td>
                    <td><?php echo $value['end_time']; ?></td>
                    <td><?php echo $value['days']; ?></td>   
                    <td><?php echo $value['room']; ?></td>  
                    <td><?php echo $count; ?></td>

                  <?php if($value['room'] == 'BCL 1' || $value['room'] == 'BCL 2' || $value['room'] == 'BCL 3' || $value['room'] == 'BCL 4' || $value['room'] == 'BCL 5' || $value['room'] == 'BCL 6' || $value['room'] == 'BCL 7' || $value['room'] == 'BCL 8' || $value['room'] == 'BCL 9') 
                        {
                            $room = "laboratory";
                            $check = "assign_laboratory";
                        }
                        else if($value['room'] == 'BRD 1')
                        { 
                            $room = "brd1";
                            $check = "assign_brd1";

                        }
                        else if ($value['room'] == 'BRD 2')
                        {
                            $room = "brd2";
                            $check = "assign_brd2";
                        }
                        else
                        {
                            $room = "classroom";
                            $check = "assign_classroom";
                        }
                    ?>
                    
                    <td><a href='http://localhost/sms/dean/<?php echo $check ?>/<?php echo $value['offer_code']; ?>'><input class="btn btn-primary" type="submit" value="Assign Seats"/></a></td>
                    <td><a href='http://localhost/sms/dean/<?php echo $room ?>/<?php echo $value['offer_code']; ?>'><input class="btn btn-primary" type="submit" value="Check Attendance"/></a></td>                                     
                  </tr>
                  <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </body>
</html>
