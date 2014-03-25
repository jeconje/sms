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
     <?php echo form_open("teacher/brd2/$id_code"); ?>
<center><br>
     Review Attendance
     <br>
 <!--     <button 
                   <?php 
                  if($onlyonce != ""){
                 echo "disabled"; } ?>   

                type="submit" name ="submit" class="btn btn-primary" onClick = "return confirm('Are you sure you want to submit because you can only submit once?')" >Submit Attendance</button><br><br> -->
      <div class="table-responsive">
       <table style="width: 1070px; height: 632px" class="table table-bordered">
  <tr>

    <td colspan="2" style="height: 119px"></td>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 1)
        { ?>                                                     
        <input name="1" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">1</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?></td>

	   <!---SEPARATOR DESIGN -->	
    <td colspan="2" style="height: 119px"></td>
    <td rowspan="7"></td>
    <td colspan="2" style="height: 119px"></td>
    <!---SEPARATOR DESIGN END-->
    
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 9)
        { ?>                                                     
        <input name="9" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">9</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td colspan="2"></td>
    <td rowspan="7"></td>
    <td colspan="2"></td>
    

    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 17)
        { ?>                                                     
        <input name="17" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">17</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td colspan="2"></td>
    <td rowspan="7"></td>
    <td style="width: 120px; height: 160px;"></td>
    <td colspan="2">

     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 25)
        { ?>                                                     
        <input name="25" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">25</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>
    <td style="width: 120px; height: 160px;"></td>
  </tr>


  <tr>
    <td style="width: 120px; height: 160px;">
       <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 2)
        { ?>                                                     
        <input name="2" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">2</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
		</td>
		
		
    <td colspan="3"></td>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 3)
        { ?>                                                     
        <input name="3" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">3</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 10)
        { ?>                                                     
        <input name="10" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">10</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td colspan="3"></td>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 11)
        { ?>                                                     
        <input name="11" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">11</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 18)
        { ?>                                                     
        <input name="18" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">18</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="3"></td>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 19)
        { ?>                                                     
        <input name="19" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">19</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 26)
        { ?>                                                     
        <input name="26" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">26</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>

    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 27)
        { ?>                                                     
        <input name="27" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">27</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>
  </tr>


  <tr>
    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 4)
        { ?>                                                     
        <input name="4" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">4</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 12)
        { ?>                                                     
        <input name="12" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">12</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td colspan="2"></td>
    
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 20)
        { ?>                                                     
        <input name="20" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">20</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>


    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;"></td>
    <td colspan="2">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 32)
        { ?>                                                     
        <input name="32" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">32</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>
    <td style="width: 120px; height: 160px;"></td>
  </tr>
  
  <tr>
    <td colspan="3"></td>
    <td colspan="3"></td>
    <td colspan="3"></td>
    <td colspan="3"></td>
  </tr>
  
  <tr>
    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 5)
        { ?>                                                     
        <input name="5" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">5</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td colspan="2"></td>

    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 13)
        { ?>                                                     
        <input name="13" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">13</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;"></td>
    <td colspan="3">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 21)
        { ?>                                                     
        <input name="21" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">21</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td style="width: 120px; height: 160px;"></td>
    <td style="width: 120px; height: 160px;"></td>
    
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 28)
        { ?>                                                     
        <input name="28" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">28</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>
    <td colspan="2"></td>
  </tr>

  <tr>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 6)
        { ?>                                                     
        <input name="6" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">6</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="3"></td>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 7)
        { ?>                                                     
        <input name="7" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">7</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 14)
        { ?>                                                     
        <input name="14" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">14</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="3"></td>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 15)
        { ?>                                                     
        <input name="15" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">15</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 12)
        { ?>                                                     
        <input name="12" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">12</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="3"></td>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 23)
        { ?>                                                     
        <input name="23" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">23</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 29)
        { ?>                                                     
        <input name="29" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">29</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 30)
        { ?>                                                     
        <input name="30" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">30</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
  
    </td>
  </tr>

  <tr>
    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 8)
        { ?>                                                     
        <input name="8" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">8</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td colspan="2"></td>

    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 16)
        { ?>                                                     
        <input name="16" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">16</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td colspan="2"></td>
    <td style="width: 120px; height: 160px;"></td>
    <td colspan="3">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 24)
        { ?>                                                     
        <input name="24" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">24</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>

    <td style="width: 120px; height: 160px;"></td>
    <td style="width: 120px; height: 160px;"></td>
    
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 31)
        { ?>                                                     
        <input name="31" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">31</p>                          
        <center>       
        <?php if($status == 'A' and $student_number == $value['student_number']) { ?>          
        <span class="label label-danger">Absent</span><br>  
        <?php } 
        else if($status == 'L' and$student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>
    <td colspan="2"></td>
  </tr>
</table>
<center>
<div class="platform" style="width: 500 px" align="center">
   
 <td rowspan="6" style="width: 10px">Platform</div><br>
        </div><!-- /.row -->
        <?php  echo form_close(); ?>
  </body>
</html>