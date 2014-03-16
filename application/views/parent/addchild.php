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

        <!-- Brand and toggle get grouped for better mobile display -->
        <?php $home = 'parents/profile'; ?>

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
            <li><a href="<?php echo base_url(); ?>parents/profile"><i class="icon32 icon-color icon-home"></i> Dashboard</a></li>      
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon32 icon-color icon-document"></i><b class="caret"></b>Grades</a>
                      <ul class="dropdown-menu">
                           <?php foreach($result as $value){ ?>
                          <li><a href="<?php echo base_url(); ?>parents/viewgrades?id=<?php echo base64_encode($value['account_id']); ?>"> <?php echo $value['last_name'].', '.$value['first_name']; ?></a></li>          
                          <?php } ?>
                      </ul>
            </li>
            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon32 icon-color icon-compose"></i><b class="caret"></b> Study Load</a>
                      <ul class="dropdown-menu">
                          <?php foreach($result as $value){ ?>
                          <li><a href="<?php echo base_url(); ?>parents/viewstudyload?id=<?php echo base64_encode($value['account_id']); ?>"> <?php echo $value['last_name'].', '.$value['first_name']; ?></a></li>          
                          <?php } ?>
                       </ul>
            </li>
             <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon32 icon-red icon-clock"></i><b class="caret"></b> Attendance</a>
                      <ul class="dropdown-menu">
                          <?php foreach($result as $value){ ?>
                          <li><a href="<?php echo base_url(); ?>parents/viewlasent?id=<?php echo base64_encode($value['student_number']); ?>"> <?php echo $value['last_name'].', '.$value['first_name']; ?></a></li>          
                          <?php } ?>
                      </ul>
            </li>
          <li  class="active"><a href="<?php echo base_url(); ?>parents/viewaddchild"><i class="icon32 icon-color icon-users"></i>   Add Child</a></li>
          <li><a href="<?php echo base_url(); ?>parents/calendarforparents/2014/03"><i class="icon32 icon-color icon-calendar"></i> Calendar</a></li>
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
            <li><a href="<?php echo base_url(); ?>parents/message">View Inbox <span class="icon icon-color icon-envelope-closed"></span></a></li>
          </ul>
        </li><!-- /.dropdown messages-dropdown -->

        <li class="dropdown user-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-color icon-gear"></i> <?php echo $first_name.' '.$last_name ?> <b class="icon icon-color icon-triangle-s"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo base_url(); ?>parents/edit_profile"><i class="icon icon-color icon-user"></i> Edit Profile</a></li>
            <li><a href="<?php echo base_url(); ?>parents/view_change_password"><i class="icon icon-color icon-key"></i> Change Password</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>parents/logout"><i class="icon icon-color icon-cancel"></i> Logout</a></li>
          </ul>
        </li><!-- /.dropdown user-dropdown -->
      </ul><!-- /.nav navbar-nav navbar-right navbar-user -->
    </div><!-- /.navbar-collapse -->
  </nav><!-- /.navbar navbar-inverse navbar-fixed-top-->

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Add Child</h1>
            <ol class="breadcrumb">
              <li class="active"><i class="fa fa-dashboard"></i> Enter the referral code found in your email. </li>
            </ol>
          </div>
        </div><!-- /.row -->

          <br><br>
          <?php echo form_open("parents/viewAddChild"); ?>
            <table align="center">
              <tr>
                <td><input class="form-control" type="text" size="20" name="student_number" id="student_number" placeholder="student number"/></td>              
              </tr>
              <tr>
                <td align="center"><input class="form-control" type="text" size="20" name="referral_key" id="referral_key" placeholder="Enter referral code"/></td>              
              </tr>
              <tr>
                <td><?php echo validation_errors(); ?></td>
              </tr>
              <tr>
                <td align="center"><div id="divCheckReferralKey" style="color: rgb(255, 0, 0); font: normal 10px/12px Arial,Helvetica,sans-serif; opacity: 50;"></div></td>
              </tr>
              <tr>
                <td align="center"><br><input class="btn btn-primary" name="submit" id="submitbtn" type="submit" value="Submit"/></td>
              </tr>
            </table>    
            <?php echo form_close(); ?>

<script type="text/javascript">
  $(document).ready(function() {
     $('#submitbtn').attr("disabled",true);
  });
</script>

<!-- Verifies the inputted referral_key if it exist in the database and matches with the student number -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#referral_key").keyup(function() {
      var referral_key = $('#referral_key').val();
      var student_number = $('#student_number').val();

        if(referral_key == "") {
              $('#submitbtn').attr("disabled",true);
        } else {
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>parents/check_referral_key",
              data: {referral_key: referral_key, student_number: student_number},
              success: function(data) {
                  if($.trim(data) == 'Invalid') {
                    $('#referral_key').css('border-color','#FF0000');
                    $('#submitbtn').attr("disabled",true); 
                    $("#divCheckReferralKey").html("Referral key & Student number does not match.").css("color","red");
                  } else {
                    $('#referral_key').css('border-color','#00CC00');
                    $('#submitbtn').removeAttr("disabled");
                    $("#divCheckReferralKey").html("Referral key & Student number matched.").css("color","green");
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
