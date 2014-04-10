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
      .auto-style3 
      {
        border-style: none;
        border-color: inherit;
        border-width: 0px;
        background-color: #CC9966;
        height: 20px;
        width: 700px;
        border-radius: 2px;
        text-align: center;
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
            <!-- <i><img src="<?php echo base_url(); ;?>images/legend.png"></i>  --> 
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-messages"></i> Notification <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>teacher/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>teacher/changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>teacher/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
<center>        
      <div class="table-responsive">
         <?php echo form_open("teacher/laboratory/$id_code"); ?>
       <table style="width: 1070px; height: 632px" class="table table-bordered">  
  <tr>
<!-- 1 -->
  <td  style="width: 120px">     
      <?php foreach($viewStudents as $value)
      {         

        foreach($viewAttendance as $attendance)
        {
          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                                 
            }
          
        }  

        if($value['seat_number'] == 1)
        {        
         ?>                                                     
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
    <?php }}
   } ?>    
    </td>

<center>
<!-- 12 -->
    <td  style="width: 120px">
          <?php foreach($viewStudents as $value)
      {         

        foreach($viewAttendance as $attendance)
        {
          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }
          
        }  

        if($value['seat_number'] == 12)
        {          
         ?>                                                     
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

    <!-- PLATFORM-->
     <td rowspan="6" style="width: 50px"></td>
       <td colspan="5" style="height: 13px" valign="top" >
           <center><br><br><br>
            Review Attendance
       </td>
    <!-- END PLATFORM -->
    
    <!-- separator --> <td rowspan="6" style="width: 50px"></td> <!-- separator -->

<!-- 29 -->
    <td style="width: 120px; height: 160px;">
           <?php foreach($viewStudents as $value)
      {         

        foreach($viewAttendance as $attendance)
        {
          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }
          
        }  

        if($value['seat_number'] == 29)
        {          
         ?>                                                     
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

<!-- 40 -->
    <td style="width: 120px">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 40)
        { ?>                                                     
        <input name="40" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">40</p>                          
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
<!-- 2 -->    
    <td  style="width: 120px; height: 100px;">     
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
        if($status == 'L' and $student_number == $value['student_number']) { ?>          
        <span class="label label-warning">Late</span><br>
        <?php } else { ?>                                       
        <span class="label label-success">Present</span><br>
    <?php }}} ?>
    </td>
<!-- 11 -->
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

<!-- 13 -->
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

<!-- 20 -->    
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
    
    <!-- LEGEND SPACE --> <td style="width: 2px">&nbsp;</td>  <!-- LEGEND SPACE -->

<!-- 21 -->
    <td style="width: 120px; height: 160px;">
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
<!-- 28 -->  
    <td  style="width: 120px">
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
<!-- 30 -->  
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
    </td >  

<!-- 39 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 39)
        { ?>                                                     
        <input name="39" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">39</p>                          
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

<!-- 3 -->
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
 <!-- 10 -->  
    <td  style="width: 120px">
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
    
<!-- 14 -->    
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
<!-- 19 -->    
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
    
    <!-- SEPARATOR --> <td style="width: 2px">&nbsp;</td> <!-- SEPARATOR -->

<!-- 22 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 22)
        { ?>                                                     
        <input name="22" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">22</p>                          
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
<!-- 27 -->
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
    
<!-- 31 -->
<td>
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

<!-- 38 -->  
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 38)
        { ?>                                                     
        <input name="38" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">38</p>                          
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
<!-- 4 -->    
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
    
<!-- 9 -->
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

 <!-- 15 -->  
    <td  style="width: 120px">
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

<!-- 18 -->
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
  
    <!-- SEPARATOR --> <td style="width: 2px">&nbsp;</td>
  
 <!-- 23 -->   
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
   
<!-- 26 -->
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
    
<!-- 32 -->
    <td style="width: 120px; height: 160px;">
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
<!-- 37 -->
    <td style="width: 120px; height: 160px;">
   <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 37)
        { ?>                                                     
        <input name="37" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">37</p>                          
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
<!-- 5 -->
    <td  style="width: 120px">
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
   
<!-- 8 -->
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
    
<!-- 16 -->
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

<!-- 17 -->
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
    

    <!-- SEPARATOR --> <td style="width: 2px">&nbsp;</td> <!-- SEPARATOR -->

<!-- 24 -->    
    <td style="width: 120px; height: 160px;">
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

<!-- 35 -->   
    <td style="width: 120px; height: 160px;">
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
<!-- 33 -->    
    <td style="width: 120px; height: 160px;">
    <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 33)
        { ?>                                                     
        <input name="33" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">33</p>                          
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
<!-- 36 -->
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 36)
        { ?>                                                     
        <input name="36" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">36</p>                          
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
<!-- 6 -->  
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
    
<!-- 7 -->
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
   
    <!-- PARA MA FORM SA UBOS --> 
    <td colspan="5">
          <center>
              <br><br><br>Platform
          </center>
    </td>

<!-- 34 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 34)
        { ?>                                                     
        <input name="34" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">34</p>                          
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
 
 <!-- 35 --> 
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value)
      {         
        foreach($viewAttendance as $attendance)
        {          
         if($value['student_number'] == $attendance['student_number']){
            $student_number = $attendance['student_number'];   
            $status = $attendance['status'];                              
            }}  
        if($value['seat_number'] == 35)
        { ?>                                                     
        <input name="35" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">  
        <p align="right">35</p>                          
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
</table>
        </div><!-- /.row -->
<?php echo form_close(); ?>
  </body>
</html>