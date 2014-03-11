<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php $home = 'teacher/profile'; ?>
    <?php include ('/application/views/templates/nav.php'); ?>
    <style type="text/css">
    .auto-style1 
    {
      font-size: x-small;
    }
    .auto-style2 
    {
      font-size: x-small;
      text-align: left;
    }
    .platform
    {
      background-color: #CC9966;
      height: 20px;
      width: 700px;
      border: 0px;
      border-radius: 2px;
    }
    </style>
  </head>

<body>
    <div id="wrapper">
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
          <a class="navbar-brand" href="<?php echo base_url(); ?><?php echo $home; ?>">University Of San Jose Recoletos - Student Monitoring System</a></div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="<?php echo base_url(); ?>teacher/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>teacher/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>teacher/calendar_teacher"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
            <i><img src="<?php echo base_url(); ;?>images/legend.png"></i>  
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
            <li><a href="<?php echo base_url(); ?>teacher/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>teacher/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>teacher/changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>teacher/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
<center>
<div>
 <td rowspan="6" style="width: 50px"></td>
    <td colspan="5" style="height: 13px" align="left" valign="top">
  <div>
    <div class="platform"> Platform 
       <?php echo form_open("teacher/classroom"); ?>
    </div>
    <br>
  </div>
    </td>
</div>
      <div class="table-responsive">
       <table style="width: 1070px; height: 632px" class="table table-bordered">
  <tr>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 1){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" /> 
    <input name="1" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">1</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
           <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
       <div class="bs-example" align="right">
                <input checked="true" name="attendance1" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
          <input name="attendance1" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                <input name="attendance1" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
           </div>
           <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
     <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px" >
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 2){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="2" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">2</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
         <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
     <div class="bs-example" align="right">
              <input checked="true" name="attendance2" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
        <input name="attendance2" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance2" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
         </div>
         <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>     
    </td>


    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 3){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="3" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">3</p>
        <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
         <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
     <div class="bs-example" align="right">
              <input checked="true" name="attendance3" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
        <input name="attendance3" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance3" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
         </div>
         <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>     
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 4){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="4" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">4</p>
        <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
         <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
     <div class="bs-example" align="right">
              <input checked="true" name="attendance4" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
        <input name="attendance4" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance4" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
         </div>
         <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>     
    </td>

    <!--SEPARATOR -->
    <td colspan="3" rowspan="6" style="width: 155px"></th>
    
    <td style="width: 50px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 5){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="5" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">5</p>
        <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
         <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
     <div class="bs-example" align="right">
              <input checked="true" name="attendance5" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
        <input name="attendance5" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance5" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
         </div>
         <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>     
    </td>


    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 6){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="6" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">6</p>
        <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
        <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance6" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
          <input name="attendance6" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance6" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
        </div>
        <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
     <?php }} ?>   
    </td>


    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                }
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }    
                if($value['seat_number'] == 7){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" /> 
    <input name="7" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">7</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance7" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance7" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance7" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>


    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 8){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="8" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">8</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance8" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance8" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
     <?php }} ?>     
    </td>
    </tr>

  <tr>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                }
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }    
                if($value['seat_number'] == 16){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="16" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">16</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
         <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

     <div class="bs-example" align="right">
              <input checked="true" name="attendance16" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
        <input name="attendance16" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance16" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
         </div>
         <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>     
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 15){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="15" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">15</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance15" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance15" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance15" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 7){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="7" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">7</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance7" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance7" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance7" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                }
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 13){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="13" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">13</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance13" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance13" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance13" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>


    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 12){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="12" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">12</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance12" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance12" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance12" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 11){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="11" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">11</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance11" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance11" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance11" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>   
    <?php }} ?>           
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 10){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="10" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">10</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance10" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance10" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance10" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>      
    <?php }} ?>        
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 9){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="9" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">9</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance9" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance9" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance9" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
  </tr>
  
  <tr>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 17){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="17" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">17</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance17" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance17" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance17" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 18){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="18" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">18</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance18" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance18" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance18" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 19){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="19" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">19</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance19" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance19" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance19" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>   
    <?php }} ?>         
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 20){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="20" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">20</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance20" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance20" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance20" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>   
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 21){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="21" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">21</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance21" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance21" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance21" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>     
    <?php }} ?>       
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 22){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="22" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">22</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance22" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance22" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance22" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 23){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="23" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">23</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance23" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance23" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance23" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>    
    <?php }} ?>        
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 24){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="24" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">24</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance24" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance24" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance24" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
  </tr>

  <tr>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 25){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="25" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">25</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance25" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance25" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance25" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                }
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }    
                if($value['seat_number'] == 26){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="26" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">26</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance26" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance26" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance26" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
     <?php }} ?>     
    </td>

    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 27){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />
    <input name="27" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">27</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance27" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance27" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance27" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 28){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="28" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">28</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance28" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance28" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance28" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>      
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 29){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="29" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">29</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance29" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance29" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance29" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
          <?php }} ?>
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 30){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="30" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">30</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance30" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance30" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance30" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
      <?php }} ?>    
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 31){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="31" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">31</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance31 " type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance31" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance31" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 32){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="32" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">32</p>
    <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance32" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance32" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance32" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>        
    <?php }} ?>      
    </td>
  </tr>

  <tr>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 40){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />      
    <input name="40" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">40</p>
    <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance40" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance40" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance40" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 39){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="39" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">39</p>
          <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance39" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance39" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance39" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>      
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 38){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="38" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">38</p>   
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance38" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance38" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance38" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 37){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="37" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">37</p> 
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance37" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance37" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance37" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 36){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="36" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">36</p>  
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance36" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance36" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance36" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 35){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="35" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">35</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance35" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance35" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance35" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 34){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="34" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">34</p>   
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance34" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance34" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance34" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>

    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 33){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="33" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">33</p> 
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance33" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance33" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance33" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
  </tr>
  <tr>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 41){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="41" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">41</p>   
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance41" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance41" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance41" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 42){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="42" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">42</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance42" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance42" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance42" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 43){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="43" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">43</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance43" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance43" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance43" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 44){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="44" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">44</p> 
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance44" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance44" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance44" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 45){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="45" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">45</p>  
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance45" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance45" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance45" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 46){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="46" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">46</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance46" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance46" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance46" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 47){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="47" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">47</p>
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance47" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance47" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance47" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value){
      $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance)
                {                  
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['attendance'] == 'A')
                     $absent++;
                } 
                foreach($logins as $login)
                {                    
                         
                    if($login['student_number'] == $value['student_number'])
                    {           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }                                     
                }   
                if($value['seat_number'] == 48){
       ?>
    <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />  
    <input name="48" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">48</p> 
      <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
          <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>
          <div class="bs-example" align="right">
              <input checked="true" name="attendance48" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance48" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
              <input name="attendance48" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
          </div>
          <?php if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp == $value['student_number'] && $timein == '00:00:00'){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
      <?php } ?>
      <?php if($temp != $value['student_number']){?>
      <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div> 
      <?php } ?>  
    <?php }} ?>      
    </td>
  </tr>
</table>
<button type="button" class="btn btn-primary">Submit Attendance</button>

        </div><!-- /.row -->
    </div>
  </body>
</html>
