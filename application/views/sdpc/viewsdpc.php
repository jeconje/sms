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
            <li class="active"><a href="<?php echo base_url(); ?>sdpc/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li ><a href="<?php echo base_url(); ?>sdpc/calendar_sdpc"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
            <li><a href="<?php echo base_url(); ?>sdpc/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $info['first_name'].' '.$info['last_name']; ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>sdpc/view_changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>sdpc/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
<br>  
 <?php echo form_open("sdpc/view_candidates"); ?>
 <div>
    <table align="center">
            <tr>      
                <td></td><td></td>
                <td>
                      <input type="text" class="form-control" name="student_number" id="student_number" placeholder="Enter Student Number"></p>
                      <center><div id="divCheckPasswordMatch" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></div></center><br>
                      <center><input class="btn btn-primary" id="submitbtn" type="submit" value="Search"/></center><br>
                </td>
            </tr>
    </table>
  </div> 
  <?php echo form_close(); ?>
<br>
   <div class="table-responsive">
              <table class="table table-hover tablesorter">
                <thead>                
                  <tr>
                    <th><center>Name of Student</th>
                    <th><center>Subject</center></i></th>
                    <th><center>Number of Lates</i></th>
                    <th><center>Number of Absences</th>
                  </tr>                  
                </thead>

                <tbody  align="center">
                  <?php
                    foreach ($viewSubjects as $value) 
                    {
                         $late = 0;
                         $absences = 0;
                  ?>    
                      <?php foreach($viewCandidates as $viewAttendance)
                      {
                           
                              if($viewAttendance['attendance'] == 'L' && $viewAttendance['offer_code'] == $value['offer_code']){
                                $late++;
                              }                              
                              if($viewAttendance['attendance'] == 'A' && $viewAttendance['offer_code'] == $value['offer_code']){
                                $absences++;
                              }
                      }
                       ?>
                  <?php if(($absences >= '5' && $value['days'] == 'MWF') || ($absences >= '3' && $value['days'] == 'TTH') ){ ?>

                  <tr>
                      <td>
                          <?php echo $viewAttendance['last_name'].', '.$viewAttendance['first_name']; ?>
                      </td>
                      <td>
                          <?php echo $value['subject_description']; ?>
                      </td>  
                      <td>                        
                          <?php  echo $late; ?>
                      </td>     

                      <td>
                          <?php echo $absences?>
                      </td>
                    </tr>
                  <?php }} ?>
                </tbody>
              </table>
            </div>
          </div>

<script type="text/javascript">
 $(document).ready(function(){
    $("#student_number").keyup(function() {
      var student_number = $('#student_number').val();
        if(student_number=="") {
          $("#divCheckPasswordMatch").empty();
            .css('border-color','');
            $('#submitbtn').attr("disabled",true);
          } else {
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>sdpc/check_student_number",
              data: "student_number=" + student_number,
              success: function(result) {
                  if($.trim(result) == 'Invalid') {
                    $('#student_number').css('border-color','#FF0000');
                    $("#divCheckPasswordMatch").html("Student number does not have any issues on tardiness.").css("color","red");
                    $('#submitbtn').attr("disabled",true);
                  } else {
                    $('#student_number').css('border-color','#00CC00');
                    $("#divCheckPasswordMatch").html("Submit to view student\s record.").css("color","green");
                    $('#submitbtn').removeAttr("disabled");
                  }
              }
            });
            return false;
          }
    });
  });
</script>

  </body>
</html>
