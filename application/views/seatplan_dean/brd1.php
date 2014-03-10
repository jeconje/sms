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
  		background-color: #FFFFCC;
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
  <div class="platform" style="width: 1150px" align="center">
    <?php echo form_open("teacher/brd1"); ?>
 <td rowspan="6" style="width: 50px">Platform</div><br>
      <div class="table-responsive">
       <table style="width: 1070px; height: 632px" class="table table-bordered">
  <tr>
    <td></td>
    <td style="width: 136px">
    <input name="one" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">1</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance1" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance1" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance1" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    
    <td></td>
    <td></td>
    <td>
    <input name="two" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">2</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance2" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance2" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance2" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td></td>
    
    <!-- SEPARATOR -->
    <td rowspan="15" style="width: 25px">&nbsp;</td>
    <!-- SEPARATOR END -->
  
    <td style="width: 73px">&nbsp;</td>
  
    <td>
    <input name="three" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">3</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance3" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance3" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance3" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    
    <td>
    <input name="four" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">4</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance4" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance4" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance4" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>

    <td style="width: 55px">&nbsp;</td>
  </tr>
  
  <tr>
    <td>
    <input name="five" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">5</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance5" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance5" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance5" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    
    <td colspan="4" style="height: 54px">&nbsp;</td>
    
    
    <td>
    <input name="six" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">6</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance6" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance6" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance6" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    <td>
    <input name="seven" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">7</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance7" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance7" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance7" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
   
    <td colspan="4" style="height: 54px">&nbsp;</td>
    
    <td>
    <input name="eight" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">8</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance8" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance8" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance8" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
  </tr>
  
  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">

    <input name="nine" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">9</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance9" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance9" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance9" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    <td></td>
    <td></td>
    <td>
    <input name="ten" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">10</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance10" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance10" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance10" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td>&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">

    <input name="eleven" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">11</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance11" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance11" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance11" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">


    <input name="twelve" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">12</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance12" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance12" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance12" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="6" style="height: 5px"></td>
    <td colspan="6" style="height: 5px"></td>
  </tr>

  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">

    <input name="thirteen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">13</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance13" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance13" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance13" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>  
    </td>
    <td></td>
    <td></td>

    <td style="width: 84px">
    <input name="fourteen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">14</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance14" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance14" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance14" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">

    <input name="fifteen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">15</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance15" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance15" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance15" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">

    <input name="sixteen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">16</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance16" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance16" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance16" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

  <tr>
    <td>
    <input name="seventeen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">17</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance17" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance17" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance17" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td colspan="4" style="height: 51px">&nbsp;</td>
    <td style="width: 71px; height: 51px">

    <input name="eighteen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">18</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance18" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance18" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance18" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    <td style="width: 73px; height: 51px">
    <input name="nineteen" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">19</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance19" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance19" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance19" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td colspan="4" style="height: 51px">&nbsp;</td>
    <td style="height: 51px; width: 55px;">

    <input name="twenty" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">20</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance20" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance20" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance20" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
  </tr>

  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">

    <input name="twenty_one" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">1</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance21" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance21" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance21" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>  
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="width: 84px">

    <input name="twenty_two" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">22</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance22" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance22" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance22" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">

    <input name="twenty_three" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">23</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance23" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance23" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance23" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">

    <input name="twenty_four" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">24</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance24" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance24" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance24" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="6" style="height: 14px"></td>
    <td colspan="6" style="height: 14px"></td>
  </tr>

  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">

    <input name="twenty_five" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">25</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance25" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance25" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance25" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>   
    </td>

    <td style="width: 64px">&nbsp;</td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 84px">

    <input name="twenty_six" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">26</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance26" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance26" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance26" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>

    <td style="width: 90px">
    <input name="twenty_seven" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">1</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance27" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance27" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance27" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>

    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">


    <input name="twenty_eight" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">28</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance28" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance28" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance28" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

  <tr>
    <td>
    <input name="twenty_nine" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">29</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance29" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance29" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance29" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>   
    </td>

    <td colspan="4" style="height: 52px"></td>
    <td style="width: 71px; height: 52px">

    <input name="thirty" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">30</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance30" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance30" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance30" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 73px; height: 52px">

    <input name="thirty_one" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">31</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance31" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance31" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance31" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>

    <td colspan="4" style="height: 52px">&nbsp;</td>
    <td style="height: 52px; width: 55px;">

    <input name="thirty_two" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">32</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance32" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance32" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance32" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
  </tr>

  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">

    <input name="thirty_three" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">33</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance33" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance33" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance33" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>   
    </td>
    <td style="width: 64px">&nbsp;</td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 84px">

    <input name="thirty_four" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">34</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance34" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance34" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance34" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">

    <input name="thirty_five" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">35</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance35" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance35" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance35" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">

    <input name="thirty_five" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">35</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance36" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance36" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance36" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

<!-- SEPARATOR -->
  <tr>
    <td colspan="6" style="height: 10px"></td>
    <td colspan="6" style="height: 10px"></td>
  </tr>
<!-- SEPARATOR END -->
  
  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">

    <input name="thirty_seven" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">37</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance37" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance37" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance37" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>    
    </td>
    <td style="width: 64px">&nbsp;</td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 84px">

    <input name="thirty_eight" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">38</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance38" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance38" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance38" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">

    <input name="thirty_nine" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">39</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance39" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance39" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance39" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">

    <input name="forty" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">40</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance40" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance40" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance40" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>
  
  <tr>
    <td>

    <input name="forty_one" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">41</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance41" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance41" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance41" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>  
    </td>

    <td colspan="4" style="height: 53px">&nbsp;</td>
    <td style="width: 71px; height: 53px">

    <input name="forty_two" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">42</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance42" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance42" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance42" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 73px; height: 53px">

    <input name="forty_three" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">43</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance43" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance43" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance43" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td colspan="4" style="height: 50px">&nbsp;</td>
    <td style="height: 53px; width: 55px;">

    <input name="forty_four" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">44</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance44" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance44" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance44" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>
    </td>
  </tr>
  
  <tr>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 136px">

    <input name="forty_five" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">45</p>
          <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
               <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
           <div class="bs-example" align="right">
                    <input checked="true" name="attendance45" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
              <input name="attendance45" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
                    <input name="attendance45" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
               </div>
               <div class="auto-style2">Status: <?php echo $value['status'] ?></div>    
    </td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">

    <input name="forty_six" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">46</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance46" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance46" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance46" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">

    <input name="forty_seven" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">47</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance47" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance47" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance47" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">

    <input name="forty_eight" value="<?php echo $value['last_name'].' '.$value['first_name']; ?>" class="form-control" disabled = "true" style="width: 120px">
    <p align="right">48</p>
		      <div class="auto-style2" style="width: 49px; height: 10px">Lates: <?php echo $value['attendance'] ?></div>
		           <div class="auto-style2" style="width: 70px; height: 8px">Absences: <?php echo $value['attendance'] ?></div>
		       <div class="bs-example" align="right">
		                <input checked="true" name="attendance48" type="radio" value="present" style="width: 25px"><span class="label label-success">..</span><br>
		          <input name="attendance48" type="radio" value="late" style="width: 25px"><span class="label label-warning">..</span><br>
		                <input name="attendance48" type="radio" value="absent" style="width: 25px"><span class="label label-danger">..</span><br>
		           </div>
		           <div class="auto-style2">Status: <?php echo $value['status'] ?></div>

    </td>
    <td style="width: 70px">&nbsp;</td>
  </tr>
</table>
<center>
<button type="button" class="btn btn-primary">Submit Attendance</button>
        </div><!-- /.row -->

  </body>
</html>