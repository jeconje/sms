<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php $home = 'dean/profile'; ?>
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
            <i><img src="<?php echo base_url(); ;?>images/legend.png"></i>  
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
         <?php echo form_open("dean/laboratory/$id_code"); ?>
       <table style="width: 1070px; height: 632px" class="table table-bordered">  
  <tr>
<!-- 1 -->
  <td  style="width: 120px">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 1){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />
                <input name="1" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">1</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance1" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance1" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance1" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance1" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance1" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance1" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance1" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance1" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance1" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance1" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance1" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance1" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<center>
<!-- 12 -->
    <td  style="width: 120px">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 12){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number12" value = "<?php echo $value['student_number'];  ?>" />
                <input name="12" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">12</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance12" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance12" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance12" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance12" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance12" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance12" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance12" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance12" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance12" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance12" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance12" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance12" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

    <!-- PLATFORM-->
     <td rowspan="6" style="width: 50px"></td>
       <td colspan="5" style="height: 13px" valign="top" >
            <center><br><br><br>
                  <button type="submit" name ="submit" class="btn btn-primary">Submit Attendance</button>
            </center>
       </td>
    <!-- END -->
    
    <!-- separator --> <td rowspan="6" style="width: 50px"></td> <!-- separator -->

<!-- 29 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 29){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number29" value = "<?php echo $value['student_number'];  ?>" />
                <input name="29" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">29</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance29" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance29" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance29" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance29" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance29" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance29" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance29" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance29" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance29" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance29" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance29" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance29" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
</td>

<!-- 40 -->
    <td style="width: 120px">
       <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 40){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number40" value = "<?php echo $value['student_number'];  ?>" />
                <input name="40" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">40</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance40" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance40" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance40" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance40" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance40" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance40" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance40" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance40" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance40" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance40" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance40" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance40" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
</tr>

  <tr>
<!-- 2 -->    
    <td  style="width: 120px; height: 100px;">     
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 2){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number2" value = "<?php echo $value['student_number'];  ?>" />
                <input name="2" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">2</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance2" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance2" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance2" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance2" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance2" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance2" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance2" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance2" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance2" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance2" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance2" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance2" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<!-- 11 -->
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 11){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number11" value = "<?php echo $value['student_number'];  ?>" />
                <input name="11" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">11</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance11" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance11" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance11" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance11" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance11" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance11" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance11" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance11" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance11" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance11" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance11" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance11" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 13 -->
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 13){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number13" value = "<?php echo $value['student_number'];  ?>" />
                <input name="13" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">13</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance13" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance13" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance13" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance13" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance13" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance13" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance13" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance13" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance13" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance13" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance13" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance13" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 20 -->    
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 20){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number20" value = "<?php echo $value['student_number'];  ?>" />
                <input name="20" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">20</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance20" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance20" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance20" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance20" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance20" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance20" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance20" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance20" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance20" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance20" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance20" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance20" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
    <!-- LEGEND SPACE --> <td style="width: 2px">&nbsp;</td>  <!-- LEGEND SPACE -->

<!-- 21 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 21){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number21" value = "<?php echo $value['student_number'];  ?>" />
                <input name="21" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">21</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance21" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance21" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance21" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance21" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance21" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance21" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance21" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance21" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance21" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance21" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance21" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance21" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<!-- 28 -->  
    <td  style="width: 120px">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 28){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number28" value = "<?php echo $value['student_number'];  ?>" />
                <input name="28" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">28</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance28" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance28" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance28" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance28" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance28" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance28" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance28" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance28" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance28" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance28" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance28" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance28" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<!-- 30 -->  
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 30){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number30" value = "<?php echo $value['student_number'];  ?>" />
                <input name="30" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">30</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance30" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance30" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance30" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance30" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance30" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance30" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance30" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance30" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance30" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance30" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance30" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance30" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td >  

<!-- 39 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 39){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number39" value = "<?php echo $value['student_number'];  ?>" />
                <input name="39" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">39</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance39" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance39" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance39" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance39" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance39" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance39" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance39" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance39" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance39" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance39" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance39" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance39" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
</tr>

<!-- 3 -->
  <tr>
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 3){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number3" value = "<?php echo $value['student_number'];  ?>" />
                <input name="3" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">3</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance3" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance3" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance3" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance3" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance3" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance3" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance3" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance3" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance3" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance3" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance3" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance3" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
 <!-- 10 -->  
    <td  style="width: 120px">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 10){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number10" value = "<?php echo $value['student_number'];  ?>" />
                <input name="10" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">10</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance10" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance10" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance10" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance10" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance10" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance10" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance10" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance10" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance10" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance10" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance10" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance10" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
<!-- 14 -->    
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 14){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number1" value = "<?php echo $value['student_number'];  ?>" />
                <input name="14" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">14</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance14" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance14" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance14" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance14" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance14" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance14" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance14" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance14" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance14" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance14" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance14" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance14" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<!-- 19 -->    
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 19){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number19" value = "<?php echo $value['student_number'];  ?>" />
                <input name="19" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">19</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance19" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance19" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance19" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance19" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance19" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance19" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance19" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance19" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance19" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance19" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance19" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance19" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
    <!-- SEPARATOR --> <td style="width: 2px">&nbsp;</td> <!-- SEPARATOR -->

<!-- 22 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 22){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number22" value = "<?php echo $value['student_number'];  ?>" />
                <input name="22" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">22</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance22" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance22" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance22" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance22" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance22" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance22" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance22" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance22" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance22" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance22" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance22" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance22" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<!-- 27 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 27){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number27" value = "<?php echo $value['student_number'];  ?>" />
                <input name="27" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">27</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance27" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance27" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance27" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance27" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance27" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance27" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance27" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance27" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance27" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance27" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance27" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance27" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
<!-- 31 -->
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 31){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number31" value = "<?php echo $value['student_number'];  ?>" />
                <input name="31" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">31</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance31" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance31" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance31" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance31" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance31" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance31" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance31" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance31" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance31" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance31" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance31" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance31" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 38 -->  
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 38){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number38" value = "<?php echo $value['student_number'];  ?>" />
                <input name="38" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">1</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance38" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance38" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance38" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance38" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance38" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance38" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance38" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance38" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance38" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance38" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance38" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance38" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
</tr>

  <tr>
<!-- 4 -->    
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 4){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number4" value = "<?php echo $value['student_number'];  ?>" />
                <input name="4" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">4</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance4" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance4" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance4" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance4" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance4" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance4" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance4" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance4" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance4" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance4" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance4" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance4" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
<!-- 9 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 9){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number9" value = "<?php echo $value['student_number'];  ?>" />
                <input name="9" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">1</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance9" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance9" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance9" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance9" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance9" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance9" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance9" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance9" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance9" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance9" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance9" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance9" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

 <!-- 15 -->  
    <td  style="width: 120px">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 15){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number15" value = "<?php echo $value['student_number'];  ?>" />
                <input name="15" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">15</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance15" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance15" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance15" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance15" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance15" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance15" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance15" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance15" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance15" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance15" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance15" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance15" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 18 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 18){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number18" value = "<?php echo $value['student_number'];  ?>" />
                <input name="18" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">18</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance18" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance18" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance18" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance18" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance18" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance18" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance18" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance18" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance18" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance18" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance18" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance18" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
  
    <!-- SEPARATOR --> <td style="width: 2px">&nbsp;</td>
  
 <!-- 23 -->   
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 23){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number23" value = "<?php echo $value['student_number'];  ?>" />
                <input name="23" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">23</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance23" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance23" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance23" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance23" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance23" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance23" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance23" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance23" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance23" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance23" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance23" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance23" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
   
<!-- 26 -->
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 26){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number26" value = "<?php echo $value['student_number'];  ?>" />
                <input name="26" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">26</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance26" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance26" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance26" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance26" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance26" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance26" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance26" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance26" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance26" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance26" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance26" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance26" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
<!-- 32 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 32){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number32" value = "<?php echo $value['student_number'];  ?>" />
                <input name="32" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">32</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance32" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance32" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance32" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance32" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance32" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance32" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance32" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance32" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance32" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance32" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance32" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance32" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
<!-- 37 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 37){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number37" value = "<?php echo $value['student_number'];  ?>" />
                <input name="37" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">37</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance37" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance37" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance37" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance37" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance37" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance37" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance37" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance37" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance37" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance37" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance37" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance37" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
</tr>

  <tr>
<!-- 5 -->
    <td  style="width: 120px">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 5){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number5" value = "<?php echo $value['student_number'];  ?>" />
                <input name="5" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">5</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance5" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance5" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance5" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance5" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance5" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance5" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance5" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance5" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance5" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance5" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance5" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance5" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
   
<!-- 8 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 8){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number8" value = "<?php echo $value['student_number'];  ?>" />
                <input name="8" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">1</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance8" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance8" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance8" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance8" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance8" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance8" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance8" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance8" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance8" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance8" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance8" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance8" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
<!-- 16 -->
<td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 16){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number16" value = "<?php echo $value['student_number'];  ?>" />
                <input name="16" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">16</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance16" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance16" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance16" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance16" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance16" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance16" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance16" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance16" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance16" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance16" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance16" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance16" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 17 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 17){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number17" value = "<?php echo $value['student_number'];  ?>" />
                <input name="17" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">17</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance17" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance17" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance17" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance17" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance17" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance17" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance17" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance17" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance17" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance17" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance17" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance17" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    

    <!-- SEPARATOR --> <td style="width: 2px">&nbsp;</td> <!-- SEPARATOR -->

<!-- 24 -->    
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 24){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number24" value = "<?php echo $value['student_number'];  ?>" />
                <input name="24" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">24</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance24" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance24" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance24" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance24" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance24" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance24" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance24" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance24" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance24" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance24" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance24" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance24" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 35 -->   
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 35){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number35" value = "<?php echo $value['student_number'];  ?>" />
                <input name="35" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">35</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>

<!-- 36 -->
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 36){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number36" value = "<?php echo $value['student_number'];  ?>" />
                <input name="36" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">36</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance36" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance36" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance36" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance36" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance36" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance36" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance36" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance36" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance36" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance36" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance36" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance36" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
</tr>

<tr>
<!-- 6 -->  
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 6){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number6" value = "<?php echo $value['student_number'];  ?>" />
                <input name="6" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">6</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance6" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance6" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance6" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance6" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance6" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance6" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance6" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance6" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance6" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance6" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance6" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance6" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
    
<!-- 7 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 7){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number7" value = "<?php echo $value['student_number'];  ?>" />
                <input name="7" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">7</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance7" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance7" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance7" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance7" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance7" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance7" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance7" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance7" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance7" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance7" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance7" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance7" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
   
    <!-- PARA MA FORM SA UBOS --> 
    <td colspan="5">
          <center>
              <br><br><br>Platform
          </center>
    </td>

<!-- 34 -->
    <td style="width: 120px; height: 160px;">
     <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 34){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number34" value = "<?php echo $value['student_number'];  ?>" />
                <input name="34" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">34</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance34" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance34" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance34" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance34" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance34" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance34" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance34" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance34" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance34" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance34" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance34" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance34" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
 
 <!-- 35 --> 
    <td style="width: 120px; height: 160px;">
      <?php foreach($viewStudents as $value){
        $late = 0;
        $absent = 0;
                foreach($viewAttendance as $attendance){                        
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'L')
                     $late++;
                    if($attendance['student_number'] == $value['student_number'] && $attendance['status'] == 'A')
                     $absent++;                   
                }              
                foreach($logins as $login){                    
                    if($login['student_number'] == $value['student_number']){           
                       $temp= $login['student_number'];                                                         
                       $timeout = $login['time_out'];
                       $timein = $login['time_in'];
                    }   
                }       
                foreach($violation as $row){
                    if($row['student_number'] == $value['student_number']){                                             
                      $violate_number = $row['student_number'];
                      $status = $row['status'];                                 
                    }                                     
                }
                foreach($suspension as $suspend){
                    if($suspend['student_number'] == $value['student_number']){                                             
                      $suspend_number = $suspend['student_number'];
                      $statuss = $suspend['status'];                                 
                    }                                     
                }
               if($value['seat_number'] == 35){                              
                ?>

                <?php                                                 
                      $temp_late = $late / 3;
                      $absent = $absent + number_format($temp_late);
                ?>
                <input type = "hidden" name = "student_number35" value = "<?php echo $value['student_number'];  ?>" />
                <input name="35" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">      
                <p align="right">35</p> 
                <div class="auto-style1" style="width: 49px; height: 10px">Lates: <?php echo $late; ?></div>
                <div class="auto-style1" style="width: 70px; height: 8px">Absences: <?php echo $absent; ?></div>

                 <?php if($statuss == "Suspended" && $suspend_number == $value['student_number']){ ?>
                 <div class="bs-example" align="right">
                          <input name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Suspended"; ?></div>      
                  </div> <?php }                

                   else if($status == "In campus with violation" && $violate_number == $value['student_number']){ ?>
                  <div class="bs-example" align="right">
                          <input name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true"  name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "With Violation"; ?></div>      
                  </div>  <?php }

                  else if($temp == $value['student_number'] && $timeout == '00:00:00'){?>
                  <div class="bs-example" align="right">
                          <input checked="true"  name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "In Campus"; ?></div>      
                  </div>  
                  <?php }    

                  else if($temp == $value['student_number'] && $timein == '00:00:00' || $temp != $value['student_number'] ){?>
                  <div class="bs-example" align="right">
                          <input name="attendance35" type="radio" value=" " style="width: 25px"><span class="label label-success">..</span><br>
                          <input name="attendance35" type="radio" value="L" style="width: 25px"><span class="label label-warning">..</span><br>
                          <input checked="true" name="attendance35" type="radio" value="A" style="width: 25px"><span class="label label-danger">..</span><br>
                          <div class="auto-style2">Status: <?php echo "Not In Campus"; ?></div>      
                  </div>  <?php } ?>                                           
    <?php } 
  } ?>
    </td>
  </tr>
</table>
        </div><!-- /.row -->
<?php echo form_close(); ?>
  </body>
</html>