<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>USJR - SMS</title>
    <?php $home = 'chairpeson/profile'; ?>
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
            <li><a href="<?php echo base_url(); ?>chairpeson/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>
                <li><a href="<?php echo base_url(); ?>chairpeson/view_logs"><i class="icon32 icon-color icon-book-empty"></i> Attendance Logs</a></li>
            <li><a href="<?php echo base_url(); ?>chairpeson/view_candidates"><i class="icon32 icon-color icon-contacts"></i> SDPC Candidates </a></li>
            <li><a href="<?php echo base_url(); ?>chairpeson/calendar_chairpeson"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>    
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
            <li><a href="<?php echo base_url(); ?>chairpeson/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
              </ul>
            </li>
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>chairpeson/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
                <li><a href="<?php echo base_url(); ?>chairpeson/changepassword"><i class="icon icon-color icon-key"></i> Change Password</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo base_url(); ?>chairpeson/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      
<center>
  <div class="platform" style="width: 1150px" align="center">
    <?php echo form_open("chairpeson/assign_brd1/$id_code"); ?>
 <td rowspan="6" style="width: 50px">Platform</div><br>
      <div class="table-responsive">
       <table style="width: 1070px; height: 632px" class="table table-bordered">
  <tr>
    <td></td>
    <td style="width: 136px">
    	<select name="1" style="width: 120px">
  			<?php foreach ($viewStudents as $value){ ?>
				  <option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>1
    </td>
    
    <td></td>
    <td></td>
    <td>
        <select name="2" style="width: 120px">
  			    		   <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>2
    </td>
    <td></td>
    
    <!-- SEPARATOR -->
    <td rowspan="15" style="width: 25px">&nbsp;</td>
    <!-- SEPARATOR END -->
  
    <td style="width: 73px">&nbsp;</td>
  
    <td>
        <select name="3" style="width: 120px">
            		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>3
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    
    <td>
          <select name="4" style="width: 120px">
            		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>4
    </td>

    <td style="width: 55px">&nbsp;</td>
  </tr>
  
  <tr>
    <td>
       	<select name="5" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>5
    </td>
    
    <td colspan="4" style="height: 54px">&nbsp;</td>
    
    
    <td>
        	<select name="6" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>6
    </td>
    <td>
            	<select name="7" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>7
    </td>
    
    
    <td colspan="4" style="height: 54px">&nbsp;</td>
    
    <td>
            	<select name="8" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>8
    </td>
  </tr>
  
  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">
        	<select name="9" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>9
    </td>
    <td></td>
    <td></td>
    <td>
        	<select name="10" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>10
    </td>

    <td>&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">
             	<select name="11" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>11
    </td>

    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">
             	<select name="12" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>12
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
          <select name="13" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>13
    </td>
    <td></td>
    <td></td>

    <td style="width: 84px">
       	<select name="14" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>14
    </td>

    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">
             	<select name="15" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>15
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">

             	<select name="16" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>16
    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

  <tr>
    <td>
      <select name="17" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>17
    </td>

    <td colspan="4" style="height: 51px">&nbsp;</td>
    <td style="width: 71px; height: 51px">
           	<select name="18" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>18
    </td>

    <td style="width: 73px; height: 51px">
             	<select name="19" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>19
    </td>

    <td colspan="4" style="height: 51px">&nbsp;</td>
    <td style="height: 51px; width: 55px;">
             	<select name="20" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>20
    </td>
  </tr>

  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">
          <select name="21" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>21
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td style="width: 84px">
             	<select name="22" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>22
    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">
             	<select name="23" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>23
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">
             	<select name="24" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>24
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
       <select name="25" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>25
    </td>
    <td style="width: 64px">&nbsp;</td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 84px">
             	<select name="26" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
			  <option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>26
    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">
             	<select name="27" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>27
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">
             	<select name="28" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>28
    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>

  <tr>
    <td>
       <select name="29" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>29
    </td>

    <td colspan="4" style="height: 52px"></td>
    <td style="width: 71px; height: 52px">
             	<select name="30" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>30
    </td>
    <td style="width: 73px; height: 52px">
             	<select name="31" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>31
    </td>
    <td colspan="4" style="height: 52px">&nbsp;</td>

    <td style="height: 52px; width: 55px;">
             	<select name="32" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>32
    </td>
  </tr>

  <tr>
    <td style="width: 65px">&nbsp;</td>
    <td style="width: 136px">
       <select name="33" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>33
    </td>
    <td style="width: 64px">&nbsp;</td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 84px">
             	<select name="34" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>34
    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>

    <td style="width: 90px">
             	<select name="35" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>35

    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">
             	<select name="36" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>36
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
         <select name="37" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>37
   </td>
    <td style="width: 64px">&nbsp;</td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 84px">
             	<select name="38" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>38
    </td>
    <td style="width: 71px">&nbsp;</td>
    <td style="width: 73px">&nbsp;</td>
    <td style="width: 90px">
             	<select name="39" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>39
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 98px">&nbsp;</td>
    <td style="width: 94px">
             	<select name="40" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>40
    </td>
    <td style="width: 55px">&nbsp;</td>
  </tr>
  
  <tr>
    <td>
       <select name="41" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>41
    </td>

    <td colspan="4" style="height: 53px">&nbsp;</td>
    <td style="width: 71px; height: 53px">
             	<select name="42" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>42
    </td>
    <td style="width: 73px; height: 53px">
             	<select name="43" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>43
    </td>
    <td colspan="4" style="height: 50px">&nbsp;</td>
    <td style="height: 53px; width: 55px;">
             	<select name="44" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>44
    </td>
  </tr>
  
  <tr>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 136px">
          <select name="45" style="width: 120px">
           		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
        </select>45
    </td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">
             	<select name="46" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>46
   </td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">
             	<select name="47" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>47
    </td>
    <td style="width: 113px">&nbsp;</td>
    <td style="width: 70px">&nbsp;</td>
    <td style="width: 70px">
             	<select name="48" style="width: 120px">
  			    		    <?php foreach ($viewStudents as $value){ ?>
				<option value ="<?php echo $value['student_number']; ?>"><?php echo $value['last_name'].', '.$value['first_name']; ?></option>    
		    <?php } ?>
  			</select>48
    </td>
    <td style="width: 70px">&nbsp;</td>
  </tr>
</table>
<center>
<button type="submit" name ="submit" class="btn btn-primary">Submit Attendance</button>
        </div><!-- /.row -->
      <?php echo form_close(); ?>
  </body>
</html>